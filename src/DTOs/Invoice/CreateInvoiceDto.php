<?php

namespace Sumer5020\ZohoBooks\DTOs\Invoice;

use Sumer5020\ZohoBooks\DTOs\Dto;
use Sumer5020\ZohoBooks\Traits\WithToArray;

class CreateInvoiceDto extends Dto
{
    use WithToArray;

    /** @var string ID of the customer the invoice has to be created */
    private string $customer_id;

    /** @var string The currency id of the currency */
    private string $currency_id;

    /** @var array Array of contact person(s) for whom invoice has to be sent */
    private array $contact_persons;

    /** @var string Search invoices by invoice number */
    private string $invoice_number;

    /** @var string Place where the goods/services are supplied to */
    private string $place_of_supply;

    /** @var string (Optional) VAT treatment for the invoices */
    private string $vat_treatment;

    /** @var string VAT treatment for the invoice */
    private string $tax_treatment;

    /** @var bool (Required if customer tax treatment is vat_registered) */
    private bool $is_reverse_charge_applied;

    /** @var string Choose whether the contact is GST registered/unregistered/consumer/overseas */
    private string $gst_treatment;

    /** @var string 15 digit GST identification number of the customer */
    private string $gst_no;

    /** @var string Choose CFDI Usage */
    private string $cfdi_usage;

    /** @var string The reference number of the invoice */
    private string $reference_number;

    /** @var string ID of the pdf template associated with the invoice */
    private string $template_id;

    /** @var string Search invoices by invoice date. Default date format is yyyy-mm-dd */
    private string $date;

    /** @var int Payment terms in days e.g. 15, 30, 60. Invoice due date will be calculated based on this */
    private int $payment_terms;

    /** @var string Used to override the default payment terms label. Default value for 15 days is "Net 15 Days" */
    private string $payment_terms_label;

    /** @var string Search invoices by due date. Default date format is yyyy-mm-dd */
    private string $due_date;

    /** @var float Discount applied to the invoice. It can be either in % or in amount. e.g. 12.5% or 190 */
    private float $discount;

    /** @var bool Used to specify how the discount has to applied. Either before or after the calculation of tax */
    private bool $is_discount_before_tax;

    /** @var string How the discount is specified */
    private string $discount_type;

    /** @var bool Used to specify whether the line item rates are inclusive or exclusivr of tax */
    private bool $is_inclusive_tax;

    /** @var float Exchange rate of the currency */
    private float $exchange_rate;

    /** @var string ID of the recurring invoice from which the invoice is created */
    private string $recurring_invoice_id;

    /** @var string ID of the invoice from which the invoice is created */
    private string $invoiced_estimate_id;

    /** @var string Name of the salesperson */
    private string $salesperson_name;

    /** @var array Custom fields for an invoice */
    private array $custom_fields;

    /** @var array */
    private array $line_items;

    /** @var object Payment options for the invoice, online payment gateways and bank accounts */
    private object $payment_options;

    /** @var bool Boolean to check if partial payments are allowed for the contact */
    private bool $allow_partial_payments;

    /** @var string */
    private string $custom_body;

    /** @var string */
    private string $custom_subject;

    /** @var string The notes added below expressing gratitude or for conveying some information */
    private string $notes;

    /** @var string The terms added below expressing gratitude or for conveying some information */
    private string $terms;

    /** @var string Shipping charges applied to the invoice */
    private string $shipping_charge;

    /** @var float Adjustments made to the invoice */
    private float $adjustment;

    /** @var string Customize the adjustment description. E.g. Rounding off */
    private string $adjustment_description;

    /** @var string reason note */
    private string $reason;

    /** @var string ID of the tax authority */
    private string $tax_authority_id;

    /** @var string ID of the tax exemption */
    private string $tax_exemption_id;

    /** @var string This is the ID of the billing address you want to apply to the invoice */
    private string $billing_address_id;

    /** @var string This is the ID of the shipping address you want to apply to the invoice */
    private string $shipping_address_id;

    /** @var string Used to group like customers for exemption purposes */
    private string $avatax_use_code;

    /** @var string Exemption certificate number of the customer */
    private string $avatax_exempt_no;

    /** @var string ID of the tax */
    private string $tax_id;

    /** @var string Add billable expense id which needs to be convert to invoice */
    private string $expense_id;

    /** @var string ID of the sales order line item which is invoices */
    private string $salesorder_item_id;

    /** @var string A tax code is a unique label used to group Items (products, services, or charges) together */
    private string $avatax_tax_code;

    /** @var array IDs of the time entries associated with the project */
    private array $time_entry_ids;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setKeys($data);
        $this->customer_id = $data['customer_id'] ?? '';
        $this->currency_id = $data['currency_id'] ?? '';
        $this->contact_persons = $data['contact_persons'] ?? [];
        $this->invoice_number = $data['invoice_number'] ?? '';
        $this->place_of_supply = $data['place_of_supply'] ?? '';
        $this->vat_treatment = $data['vat_treatment'] ?? '';
        $this->tax_treatment = $data['tax_treatment'] ?? '';
        $this->is_reverse_charge_applied = $data['is_reverse_charge_applied'] ?? false;
        $this->gst_treatment = $data['gst_treatment'] ?? '';
        $this->gst_no = $data['gst_no'] ?? '';
        $this->cfdi_usage = $data['cfdi_usage'] ?? '';
        $this->reference_number = $data['reference_number'] ?? '';
        $this->template_id = $data['template_id'] ?? '';
        $this->date = $data['date'] ?? '';
        $this->payment_terms = $data['payment_terms'] ?? 0;
        $this->payment_terms_label = $data['payment_terms_label'] ?? '';
        $this->due_date = $data['due_date'] ?? '';
        $this->discount = $data['discount'] ?? 0;
        $this->is_discount_before_tax = $data['is_discount_before_tax'] ?? false;
        $this->discount_type = $data['discount_type'] ?? '';
        $this->is_inclusive_tax = $data['is_inclusive_tax'] ?? false;
        $this->exchange_rate = $data['exchange_rate'] ?? 0;
        $this->recurring_invoice_id = $data['recurring_invoice_id'] ?? '';
        $this->invoiced_estimate_id = $data['invoiced_estimate_id'] ?? '';
        $this->salesperson_name = $data['salesperson_name'] ?? '';
        $this->custom_fields = $data['custom_fields'] ?? [];
        $this->line_items = $data['line_items'] ?? [];
        $this->payment_options = $data['payment_options'] ?? (object)[];
        $this->allow_partial_payments = $data['allow_partial_payments'] ?? false;
        $this->custom_body = $data['custom_body'] ?? '';
        $this->custom_subject = $data['custom_subject'] ?? '';
        $this->notes = $data['notes'] ?? '';
        $this->terms = $data['terms'] ?? '';
        $this->shipping_charge = $data['shipping_charge'] ?? '';
        $this->adjustment = $data['adjustment'] ?? 0;
        $this->adjustment_description = $data['adjustment_description'] ?? '';
        $this->reason = $data['reason'] ?? '';
        $this->tax_authority_id = $data['tax_authority_id'] ?? '';
        $this->tax_exemption_id = $data['tax_exemption_id'] ?? '';
        $this->billing_address_id = $data['billing_address_id'] ?? '';
        $this->shipping_address_id = $data['shipping_address_id'] ?? '';
        $this->avatax_use_code = $data['avatax_use_code'] ?? '';
        $this->avatax_exempt_no = $data['avatax_exempt_no'] ?? '';
        $this->tax_id = $data['tax_id'] ?? '';
        $this->expense_id = $data['expense_id'] ?? '';
        $this->salesorder_item_id = $data['salesorder_item_id'] ?? '';
        $this->avatax_tax_code = $data['avatax_tax_code'] ?? '';
        $this->time_entry_ids = $data['time_entry_ids'] ?? [];
    }
}
