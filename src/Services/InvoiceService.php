<?php

namespace Sumer5020\ZohoBooks\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Sumer5020\ZohoBooks\Contracts\InvoiceInterface;
use Sumer5020\ZohoBooks\DTOs\Invoice\CreateInvoiceDto;
use Sumer5020\ZohoBooks\DTOs\Invoice\CreateInvoiceQpDto;
use Sumer5020\ZohoBooks\Rules\InvoiceRule;
use Sumer5020\ZohoBooks\Traits\WithDataValidate;

class InvoiceService implements InvoiceInterface
{
    use WithDataValidate;

    /**
     * @param string $accessToken
     * @param string $organizationId
     * @param CreateInvoiceDto $createInvoiceDto
     * @param CreateInvoiceQpDto $createInvoiceQpDto
     *
     * @return array
     * @throws Exception
     */
    public function create(string $accessToken, string $organizationId, CreateInvoiceDto $createInvoiceDto, CreateInvoiceQpDto $createInvoiceQpDto): array
    {
        try {
            $data = $createInvoiceDto->toArray();
            $this->validate($data, InvoiceRule::toCreate());
            $url = config('zohoBooks.url') . '/invoices?organization_id=' . $organizationId . $createInvoiceQpDto->toQueryString();

            return Http::withHeaders([
                'Authorization' => "Zoho-oauthtoken " . $accessToken,
                'content-type' => 'application/json',
            ])->post($url, $data)->json();
        } catch (Exception $e) {
            throw new Exception('Failed to create an invoice for your customer. Response: ' . $e->getMessage());
        }
    }
}
