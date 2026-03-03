<?php

declare(strict_types=1);

namespace Sumer5020\ZohoBooks\Traits;

trait WithToQueryString
{
    /**
     * Converts the input object properties to a query string format.
     */
    public function toQueryString(): string
    {
        return (string) array_reduce($this->getKeys(), function (string $result, string $key) {
            if (property_exists($this, $key)) {
                $result .= "&" . $key . "=" . (string) $this->$key;
            }
            return $result;
        }, "");
    }

    /**
     * Abstract method to get input keys.
     * The implementing class must define this method.
     *
     * @return array<int, string>
     */
    abstract protected function getKeys(): array;
}
