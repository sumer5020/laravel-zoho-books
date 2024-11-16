<?php

namespace Sumer5020\ZohoBooks\Rules\Estimate;

class GetEstimateEmailContentEstimateRule
{
    public static function rules(): array
    {
        return [
            'estimate_id' => 'required|string',
            'email_template_id' => 'required|string',
        ];
    }
}