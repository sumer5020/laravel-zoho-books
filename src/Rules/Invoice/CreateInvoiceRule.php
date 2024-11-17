<?php

namespace Sumer5020\ZohoBooks\Rules\Invoice;

class CreateInvoiceRule
{
    public static function rules(): array
    {
        return [
            'customer_id' => 'required|string',
            'currency_id' => 'sometimes|string',
            'contact_persons' => 'sometimes|array',
            'invoice_number' => 'sometimes|string',
            'place_of_supply' => 'sometimes|string',
            'vat_treatment' => 'sometimes|string',
            'tax_treatment' => 'sometimes|string',
            'is_reverse_charge_applied' => 'sometimes|boolean|in:true,false',
            'gst_treatment' => 'sometimes|string',
            'gst_no' => 'sometimes|string',
            'cfdi_usage' => 'sometimes|string',
            'reference_number' => 'sometimes|string',
            'template_id' => 'sometimes|string',
            'date' => 'sometimes|string',
            'payment_terms' => 'sometimes|numeric',
            'payment_terms_label' => 'sometimes|string',
            'due_date' => 'sometimes|string',
            'discount' => 'sometimes|numeric',
            'is_discount_before_tax' => 'sometimes|boolean|in:true,false',
            'discount_type' => 'sometimes|string',
            'is_inclusive_tax' => 'sometimes|boolean|in:true,false',
            'exchange_rate' => 'sometimes|numeric',
            'recurring_invoice_id' => 'sometimes|string',
            'invoiced_estimate_id' => 'sometimes|string',
            'salesperson_name' => 'sometimes|string',
            'custom_fields' => 'sometimes|array',
            'line_items' => 'required|array',
            'payment_options' => 'sometimes',
            'allow_partial_payments' => 'sometimes|boolean|in:true,false',
            'custom_body' => 'sometimes|string',
            'custom_subject' => 'sometimes|string',
            'notes' => 'sometimes|string',
            'terms' => 'sometimes|string',
            'shipping_charge' => 'sometimes|string',
            'adjustment' => 'sometimes|numeric',
            'adjustment_description' => 'sometimes|string',
            'reason' => 'sometimes|string',
            'tax_authority_id' => 'sometimes|string',
            'tax_exemption_id' => 'sometimes|string',
            'billing_address_id' => 'sometimes|string',
            'shipping_address_id' => 'sometimes|string',
            'avatax_use_code' => 'sometimes|string',
            'avatax_exempt_no' => 'sometimes|string',
            'tax_id' => 'sometimes|string',
            'expense_id' => 'sometimes|string',
            'salesorder_item_id' => 'sometimes|string',
            'avatax_tax_code' => 'sometimes|string',
            'time_entry_ids' => 'sometimes|array',
        ];
    }
}
