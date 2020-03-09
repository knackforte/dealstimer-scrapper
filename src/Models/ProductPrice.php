<?php

namespace Bissolli\TwitterScraper\Models;

class ProductPrice extends ModelAbstract implements \JsonSerializable
{
    /**
     * Product Price
     * @var float
     */
    protected $price = 0;

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    public function initProperties($value, $prop)
    {
        switch ($prop) {
            case 'price':
                $this->price = $value;
                break;
        }
    }
    /**
     * Implements JsonSerializable
     *
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return
        [
            'price' => $this->getPrice()
        ];
    }
}