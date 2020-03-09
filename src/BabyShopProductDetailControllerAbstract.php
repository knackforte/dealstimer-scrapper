<?php

namespace Bissolli\TwitterScraper;

use stdClass;

abstract class BabyShopProductDetailControllerAbstract
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
     * List of products found
     *
     * @var stdClass
     */
    protected $detailCard = [];

    protected $lastPageNumber;

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
     * @return stdClass
     */
    public function getDetailCard()
    {
        return $this->detailCard;
    }

    /**
     * @param $tweets
     */
    protected function setDetailCard($detailCard)
    {
        $this->detailCard = $detailCard;
    }

    protected function getLastPageNumber()
    {
        return $this->lastPageNumber;
    }

    protected function setLastPageNumber($pageNumber)
    {
        $this->lastPageNumber = $pageNumber;
    }

    

    /**
     * Load profile data from the Twitter account
     *
     * @return void
     */
    abstract protected function extractProductDetail();
}
