<?php

namespace Sumer5020\ZohoBooks\DTOs\Arguments;

/**
 * Class SalesOrderDto
 * Data Transfer Object for a Sales Order.
 */
class SalesOrderDto
{
    /** @var array Inputs data */
    private array $_data;

    /** @var string ID of the Sales Order */
     private string $salesorder_id;

    /** @var array Documents related to the Sales Order */
     private array $documents;

    /** @var bool Applicable for transactions that fall before July 1, 2017 (India only) */
     private bool $is_pre_gst;

    /** @var string GST identification number of the customer (India only) */
     private string $gst_no;

    /** @var string GST treatment (India only) */
     private string $gst_treatment;

    /** @var string Place where goods/services are supplied (India, GCC only) */
     private string $place_of_supply;

    /** @var string VAT treatment (UK only) */
     private string $vat_treatment;

    /** @var string VAT treatment for the sales order (GCC, Mexico, Kenya, South Africa only) */
     private string $tax_treatment;

    /** @var string ZCRM potential ID */
     private string $zcrm_potential_id;

    /** @var string ZCRM potential name */
     private string $zcrm_potential_name;

    /** @var string Sales order number (mandatory if auto number generation is disabled) */
     private string $salesorder_number;

    /** @var string Date the sales order is created */
     private string $date;

    /** @var string Status of the Sales Order */
     private string $status;

    /** @var string Shipment date of the sales order */
     private string $shipment_date;

    /** @var string Reference number of the Sales Order */
     private string $reference_number;

    /** @var string ID of the customer */
     private string $customer_id;

    /** @var string Name of the customer */
     private string $customer_name;

    /** @var array Contact persons for the Sales Order */
     private array $contact_persons;

    /** @var string Currency ID */
     private string $currency_id;

    /** @var string Currency code */
     private string $currency_code;

    /** @var string Currency symbol */
     private string $currency_symbol;

    /** @var float Exchange rate of the currency */
     private float $exchange_rate;

    /** @var float Discount amount */
     private float $discount_amount;

    /** @var string Discount applied to the Sales Order */
     private string $discount;

    /** @var int Discount applied on amount */
     private int $discount_applied_on_amount;

    /** @var bool Whether the discount is applied before tax */
     private bool $is_discount_before_tax;

    /** @var string How the discount is specified (entity_level or item_level) */
     private string $discount_type;

    /** @var string ID of the estimate from which the Sales Order is created */
     private string $estimate_id;

    /** @var string Delivery method */
     private string $delivery_method;

    /** @var string ID of the delivery method */
     private string $delivery_method_id;

    /** @var bool Whether tax is inclusive */
     private bool $is_inclusive_tax;

    /** @var array Line items of the Sales Order */
     private array $line_items;

    /** @var float Shipping charge */
     private float $shipping_charge;

    /** @var float Adjustment amount */
     private float $adjustment;

    /** @var string Description of the adjustment */
     private string $adjustment_description;

    /** @var float Subtotal of the Sales Order */
     private float $sub_total;

    /** @var float Total tax amount */
     private float $tax_total;

    /** @var float Total amount of the Sales Order */
     private float $total;

    /** @var array Taxes applied */
     private array $taxes;

    /** @var int Price precision */
     private int $price_precision;

    /** @var bool Whether the Sales Order is emailed */
     private bool $is_emailed;

    /** @var object Billing address */
     private object $billing_address;

    /** @var object Shipping address */
     private object $shipping_address;

    /** @var string Notes for the Sales Order */
     private string $notes;

    /** @var string Terms for the Sales Order */
     private string $terms;

    /** @var array Custom fields */
     private array $custom_fields;

    /** @var string ID of the PDF template */
     private string $template_id;

    /** @var string Name of the PDF template */
     private string $template_name;

    /** @var string Page width */
     private string $page_width;

    /** @var string Page height */
     private string $page_height;

    /** @var string Page orientation */
     private string $orientation;

    /** @var string Type of the template */
     private string $template_type;

    /** @var string Creation time of the Sales Order */
     private string $created_time;

    /** @var string Last modified time of the Sales Order */
     private string $last_modified_time;

    /** @var string ID of the user who created the Sales Order */
     private string $created_by_id;

    /** @var string Name of the attachment */
     private string $attachment_name;

    /** @var bool Whether the file can be sent in mail */
     private bool $can_send_in_mail;

    /** @var string ID of the salesperson */
     private string $salesperson_id;

    /** @var string Name of the salesperson */
     private string $salesperson_name;

    /** @var string ID of the merchant */
     private string $merchant_id;

    /** @var string Name of the merchant */
     private string $merchant_name;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->_data = array_keys($data);

        $this->salesorder_id = $data['salesorder_id'] ?? '';
        $this->documents = $data['documents'] ?? [];
        $this->is_pre_gst = $data['is_pre_gst'] ?? false;
        $this->gst_no = $data['gst_no'] ?? '';
        $this->gst_treatment = $data['gst_treatment'] ?? '';
        $this->place_of_supply = $data['place_of_supply'] ?? '';
        $this->vat_treatment = $data['vat_treatment'] ?? '';
        $this->tax_treatment = $data['tax_treatment'] ?? '';
        $this->zcrm_potential_id = $data['zcrm_potential_id'] ?? '';
        $this->zcrm_potential_name = $data['zcrm_potential_name'] ?? '';
        $this->salesorder_number = $data['salesorder_number'] ?? '';
        $this->date = $data['date'] ?? '';
        $this->status = $data['status'] ?? '';
        $this->shipment_date = $data['shipment_date'] ?? '';
        $this->reference_number = $data['reference_number'] ?? '';
        $this->customer_id = $data['customer_id'] ?? '';
        $this->customer_name = $data['customer_name'] ?? '';
        $this->contact_persons = $data['contact_persons'] ?? [];
        $this->currency_id = $data['currency_id'] ?? '';
        $this->currency_code = $data['currency_code'] ?? '';
        $this->currency_symbol = $data['currency_symbol'] ?? '';
        $this->exchange_rate = $data['exchange_rate'] ?? 0.0;
        $this->discount_amount = $data['discount_amount'] ?? 0.0;
        $this->discount = $data['discount'] ?? '';
        $this->discount_applied_on_amount = $data['discount_applied_on_amount'] ?? 0;
        $this->is_discount_before_tax = $data['is_discount_before_tax'] ?? false;
        $this->discount_type = $data['discount_type'] ?? '';
        $this->estimate_id = $data['estimate_id'] ?? '';
        $this->delivery_method = $data['delivery_method'] ?? '';
        $this->delivery_method_id = $data['delivery_method_id'] ?? '';
        $this->is_inclusive_tax = $data['is_inclusive_tax'] ?? false;
        $this->line_items = $data['line_items'] ?? [];
        $this->shipping_charge = $data['shipping_charge'] ?? 0.0;
        $this->adjustment = $data['adjustment'] ?? 0.0;
        $this->adjustment_description = $data['adjustment_description'] ?? '';
        $this->sub_total = $data['sub_total'] ?? 0.0;
        $this->tax_total = $data['tax_total'] ?? 0.0;
        $this->total = $data['total'] ?? 0.0;
        $this->taxes = $data['taxes'] ?? [];
        $this->price_precision = $data['price_precision'] ?? 0;
        $this->is_emailed = $data['is_emailed'] ?? false;
        $this->billing_address = $data['billing_address'] ?? (object)[];
        $this->shipping_address = $data['shipping_address'] ?? (object)[];
        $this->notes = $data['notes'] ?? '';
        $this->terms = $data['terms'] ?? '';
        $this->custom_fields = $data['custom_fields'] ?? [];
        $this->template_id = $data['template_id'] ?? '';
        $this->template_name = $data['template_name'] ?? '';
        $this->page_width = $data['page_width'] ?? '';
        $this->page_height = $data['page_height'] ?? '';
        $this->orientation = $data['orientation'] ?? '';
        $this->template_type = $data['template_type'] ?? '';
        $this->created_time = $data['created_time'] ?? '';
        $this->last_modified_time = $data['last_modified_time'] ?? '';
        $this->created_by_id = $data['created_by_id'] ?? '';
        $this->attachment_name = $data['attachment_name'] ?? '';
        $this->can_send_in_mail = $data['can_send_in_mail'] ?? false;
        $this->salesperson_id = $data['salesperson_id'] ?? '';
        $this->salesperson_name = $data['salesperson_name'] ?? '';
        $this->merchant_id = $data['merchant_id'] ?? '';
        $this->merchant_name = $data['merchant_name'] ?? '';
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_reduce($this->_data, function ($result, $key) {
            if (property_exists($this, $key)) {
                $result[$key] = $this->$key;
            }
            return $result;
        }, []);
    }
}
