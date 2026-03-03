<?php

declare(strict_types=1);

namespace Sumer5020\ZohoBooks\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Sumer5020\ZohoBooks\Contracts\AuthenticationInterface;
use Sumer5020\ZohoBooks\Models\ZohoTokens;

/**
 * Class AuthenticationService
 * 
 * This class handles Zoho Books authentication, including generating, refreshing, 
 * and revoking access tokens using Zoho Books OAuth2 API.
 * 
 * Implements the AuthenticationInterface.
 */
class AuthenticationService implements AuthenticationInterface
{
    /**
     * @return string The generated access token.
     * 
     * @throws Exception If the token creation fails or if the response is invalid.
     */
    public function createAccessToken(): string
    {
        $data = [
            "code" => (string) config('zohoBooks.access_code'),
            "client_id" => (string) config('zohoBooks.client_id'),
            "client_secret" => (string) config('zohoBooks.client_secret'),
            "redirect_uri" => (string) config('zohoBooks.redirect_uri'),
            "grant_type" => 'authorization_code',
        ];

        $url = config('zohoBooks.auth_url') . 'oauth/v2/token';

        try {
            $response = Http::asForm()->post((string) $url, $data);

            if ($response->successful() && $response->json('access_token')) {
                $zohoToken = $response->json();

                ZohoTokens::create([
                    'code' => config('zohoBooks.access_code'),
                    'access_token' => Arr::get($zohoToken, 'access_token', ''),
                    'refresh_token' => Arr::get($zohoToken, 'refresh_token', ''),
                    'expires_in' => Arr::get($zohoToken, 'expires_in', 0),
                ]);

                return (string) $zohoToken['access_token'];
            }

            throw new Exception('invalid');
        } catch (Exception $e) {
            throw new Exception('Failed to create access token. Exception Message: ' . $e->getMessage());
        }
    }

    /**
     * @param string $refreshToken The refresh token used to generate a new access token.
     * 
     * @return string The newly generated access token.
     * 
     * @throws Exception If the refresh fails or if the response is invalid.
     */
    public function refreshAccessToken(string $refreshToken): string
    {
        $data = [
            "refresh_token" => $refreshToken,
            "client_id" => (string) config('zohoBooks.client_id'),
            "client_secret" => (string) config('zohoBooks.client_secret'),
            "redirect_uri" => (string) config('zohoBooks.redirect_uri'),
            "grant_type" => 'refresh_token',
        ];

        $url = config('zohoBooks.auth_url') . 'oauth/v2/token';

        try {
            $response = Http::asForm()->post((string) $url, $data);

            if ($response->successful() && $response->json('access_token')) {
                $zohoToken = $response->json();

                ZohoTokens::where('refresh_token', $refreshToken)
                    ->update(['access_token' => Arr::get($zohoToken, 'access_token', '')]);

                return (string) $zohoToken['access_token'];
            }

            throw new Exception('invalid');
        } catch (Exception $e) {
            throw new Exception('Failed to refresh access token. Response: ' . $e->getMessage());
        }
    }

    /**
     * @param string $token The current access token used for authorization.
     * @param string $refreshToken The refresh token to revoke.
     * 
     * @return bool True if the refresh token was successfully revoked and deleted, false otherwise.
     * 
     * @throws Exception If the revocation fails or if the response is invalid.
     */
    public function revokeRefreshAccessToken(string $token, string $refreshToken): bool
    {
        $data = [
            "token" => $refreshToken,
        ];

        $url = config('zohoBooks.auth_url') . 'oauth/v2/token/revoke';

        try {
            $response = Http::withHeaders(['Authorization' => "Zoho-oauthtoken " . $token])->post((string) $url, $data);

            if ($response->successful() && $response->json('status') === "success") {
                return (bool) ZohoTokens::where('refresh_token', $refreshToken)->delete();
            }

            return false;
        } catch (Exception $e) {
            throw new Exception('Failed to revoke refresh token. Response: ' . $e->getMessage());
        }
    }
}
