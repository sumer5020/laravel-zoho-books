<?php

namespace Sumer5020\ZohoBooks\Rules;


use Sumer5020\ZohoBooks\Rules\Invoice\CreateInvoiceRule;

class InvoiceRule
{
    /**
     * @return array
     */
    public static function toCreate(): array
    {
        return CreateInvoiceRule::rules();
    }
}
