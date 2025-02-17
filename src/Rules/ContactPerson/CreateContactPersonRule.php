<?php

namespace Sumer5020\ZohoBooks\Rules\ContactPerson;

class CreateContactPersonRule
{
    public static function rules(): array
    {
        return [
            'contact_id' => 'sometimes|string',
            'salutation' => 'sometimes|string|max:25',
            'first_name' => 'required|string|max:100',
            'last_name' => 'sometimes|string|max:100',
            'email' => 'sometimes|email|max:100',
            'phone' => 'sometimes|string|max:50',
            'mobile' => 'sometimes|string|max:50',
            'skype' => 'sometimes|string|max:50',
            'designation' => 'sometimes|string|max:50',
            'department' => 'sometimes|string|max:50',
            'enable_portal' => 'sometimes|boolean|in:true,false',
        ];
    }
}