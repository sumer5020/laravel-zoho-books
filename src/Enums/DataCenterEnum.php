<?php

declare(strict_types=1);

namespace Sumer5020\ZohoBooks\Enums;

enum DataCenterEnum: string
{
    case UnitedStates = "https://www.zohoapis.com/books/";
    case Europe = "https://www.zohoapis.eu/books/";
    case India = "https://www.zohoapis.in/books/";
    case Australia = "https://www.zohoapis.com.au/books/";
    case Japan = "https://www.zohoapis.jp/books/";
    case Canada = "https://www.zohoapis.ca/books/";
    case China = "https://www.zohoapis.com.cn/books/";
    case SaudiArabia = "https://www.zohoapis.sa/books/";

    /**
     * Get the URL based on the DataCenter case
     */
    public function url(): string
    {
        return $this->value;
    }

    /**
     * Get the OAuth URL based on the DataCenter case
     */
    public function oAuthUrl(): string
    {
        return match ($this) {
            self::UnitedStates => "https://accounts.zoho.com/",
            self::Europe => "https://www.accounts.zoho.eu/",
            self::India => "https://www.accounts.zoho.in/",
            self::Australia => "https://www.accounts.zoho.com.au/",
            self::Japan => "https://www.accounts.zoho.jp/",
            self::Canada => "https://www.accounts.zoho.ca/",
            self::China => "https://www.accounts.zoho.com.cn/",
            self::SaudiArabia => "https://www.accounts.zoho.sa/",
        };
    }
}
