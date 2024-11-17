<?php

namespace Sumer5020\ZohoBooks\Contracts;

use Sumer5020\ZohoBooks\DTOs\Invoice\CreateInvoiceDto;
use Sumer5020\ZohoBooks\DTOs\Invoice\CreateInvoiceQpDto;

interface InvoiceInterface
{
    /**
     * @param string $accessToken
     * @param string $organizationId
     * @param CreateInvoiceDto $createInvoiceDto
     * @param CreateInvoiceQpDto $createInvoiceQpDto
     *
     * @return array
     */
    public function create(string $accessToken, string $organizationId, CreateInvoiceDto $createInvoiceDto, CreateInvoiceQpDto $createInvoiceQpDto): array;
}
