<?php

namespace Bissolli\TwitterScraper;
use Bissolli\TwitterScraper\Models\ProductPrice;
use Bissolli\TwitterScraper\Traits\HelpersTrait;
use Carbon\Carbon;
use PHPHtmlParser\Dom;

class ProductPriceController extends ProductPriceControllerAbstract
{
    use HelpersTrait;

    public function __construct($permalink)
    {
        $this->setHandle($permalink);
        $url = $permalink;

        $header[0]  = "Accept: text/xml,application/xml,application/xhtml+xml,"; 
        $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";

        $header[] = "Cache-Control: max-age=0"; 
        $header[] = "Connection: keep-alive"; 
        $header[] = "Keep-Alive: 300"; 
        $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7"; 
        $header[] = "Accept-Language: en-us,en;q=0.5"; 
        $header[] = "Pragma: "; 

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url); 
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'); 
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate'); 
        curl_setopt($curl, CURLOPT_AUTOREFERER, true); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($curl, CURLOPT_TIMEOUT, 10); 
        curl_setopt($curl, CURLOPT_VERBOSE, 1); 

        $response = curl_exec($curl);

        //echo $response;

        $dom = new Dom();
        $dom->load($response);
        $this->setDomHtml($dom);
        $this->extractProductPrice();
        return $this;
    }
    protected function extractProductPrice()
    {
        $priceDiv = $this->domHtml->find('.priceBlockBuyingPriceString');
        $productPriceObj = ProductPrice::create([
            'price' => $this->sanitizeNodeText($priceDiv)
        ]);
        $this->setProductPrice($productPriceObj);
    }
}