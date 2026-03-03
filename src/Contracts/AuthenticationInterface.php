<?php

declare(strict_types=1);

namespace Sumer5020\ZohoBooks\Contracts;

interface AuthenticationInterface
{
    /**
     * @return string The generated access token.
     */
    public function createAccessToken(): string;

    /**
     * @param string $refreshToken The refresh token used to generate a new access token.
     *
     * @return string The newly generated access token.
     */
    public function refreshAccessToken(string $refreshToken): string;

    /**
     * @param string $token The current access token used for authorization.
     * @param string $refreshToken The refresh token to revoke.
     *
     * @return bool True if the refresh token was successfully revoked and deleted, false otherwise.
     */
    public function revokeRefreshAccessToken(string $token, string $refreshToken): bool;
}
