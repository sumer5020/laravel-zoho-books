<?php

namespace Sumer5020\ZohoBooks\DTOs\Invoice;

use Sumer5020\ZohoBooks\DTOs\Dto;
use Sumer5020\ZohoBooks\Traits\WithToQueryString;

class CreateInvoiceQpDto extends Dto
{
    use WithToQueryString;

    /** @var bool Send the invoice to the contact person(s) associated with the invoice */
    private bool $send;

    /** @var bool Ignore auto invoice number generation for this invoice */
    private bool $ignore_auto_number_generation;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setKeys($data);
        $this->send = $data['send'] ?? false;
        $this->ignore_auto_number_generation = $data['ignore_auto_number_generation'] ?? false;
    }
}
