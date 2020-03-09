<?php

namespace Bissolli\TwitterScraper;
use Bissolli\TwitterScraper\Models\BabyShopProductPrice;
use Bissolli\TwitterScraper\Traits\HelpersTrait;
use Carbon\Carbon;
use PHPHtmlParser\Dom;

class BabyShopProductPriceController extends BabyShopProductPriceControllerAbstract
{
    use HelpersTrait;

    public function __construct($permalink)
    {
        $dom = new Dom();
        $dom->load($permalink); 
        $this->setDomHtml($dom);
       

        $this->extractProductPrice();
        return $this;
    }
    protected function extractProductPrice()
    {
        $priceDiv = $this->domHtml->find('.price-and-stock')->find('.lowest');
        $productPriceObj = BabyShopProductPrice::create([
            'price' => $this->sanitizeNodeText($priceDiv)
        ]);
        $this->setProductPrice($productPriceObj);
    }
}