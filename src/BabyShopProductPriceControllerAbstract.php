<?php

namespace Bissolli\TwitterScraper;

use stdClass;

abstract class BabyShopProductPriceControllerAbstract
{
    /**
     * Twitter account handle
     *
     * @var string
     */
    protected $handle;

    /**
     * Parsed HTML from the Twitter account
     *
     * @var \PHPHtmlParser\Dom
     */
    protected $domHtml;

    /**
     * Twitter data profile
     *
     * @var stdClass
     */
    protected $productPrice;

    /**
     * @return stdClass
     */
    public function getProductPrice()
    {
        return $this->productPrice;
    }

    /**
     * @param $handle
     */
    protected function setHandle($handle)
    {
        $this->handle = $handle;
    }

    /**
     * @param $domHtml
     */
    protected function setDomHtml($domHtml)
    {
        $this->domHtml = $domHtml;
    }


    /**
     * @param $tweets
     */
    protected function setProductPrice($productPrice)
    {
        $this->productPrice = $productPrice;
    }

    /**
     * Load profile data from the Twitter account
     *
     * @return void
     */
    abstract protected function extractProductPrice();
}
