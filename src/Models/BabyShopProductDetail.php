<?php

namespace Bissolli\TwitterScraper\Models;

class BabyShopProductDetail extends ModelAbstract implements \JsonSerializable
{
    /**
     * Name
     * @var string
     */
    protected $name = null;

    /**
     * Name
     * @var string
     */
    protected $image_url = null;

    /**
     * Name
     * @var string
     */
    protected $permalink = null;

    protected $price = null;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPermalink()
    {
        return $this->permalink;
    }

    /**
     * @return string
     */
    public function getImage_url()
    {
        return $this->image_url;
    }

    public function getPrice()
    {
        return $this->price;
    }



    public function initProperties($value, $prop)
    {
        switch ($prop) {
            case 'name':
                $this->name = $value;
                break;
            case 'permalink':
                $this->permalink = $value;
                break;
            case 'image_url':
                $this->image_url = $value;
                break;
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
            'name' => $this->getName(),
            'permalink' => $this->getPermalink(),
            'image_url' => $this->getImage_url(),
            'price'     => $this->getPrice(),
        ];
    }
}