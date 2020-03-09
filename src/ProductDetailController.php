<?php

namespace Bissolli\TwitterScraper;
use Bissolli\TwitterScraper\Models\ProductDetail;
use Bissolli\TwitterScraper\Traits\HelpersTrait;
use Carbon\Carbon;
use PHPHtmlParser\Dom;

class ProductDetailController extends ProductDetailControllerAbstract
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

        $dom = new Dom();
        $dom->load($response); 
        $this->setDomHtml($dom);
        $this->extractProductDetail();
        return $this;
    }
    protected function extractProductDetail()
    {     
        $detailCard_array = []; 
                                  
        foreach($this->domHtml->find('.sg-col-4-of-24.sg-col-4-of-12.sg-col-4-of-36.s-result-item.sg-col-4-of-28.sg-col-4-of-16.sg-col.sg-col-4-of-20.sg-col-4-of-32') as $dom)
        {
            $single_product = $dom -> find('.s-expand-height.s-include-content-margin.s-border-bottom');
            $image = $single_product -> find('.a-section.aok-relative.s-image-square-aspect');
            $permalink = $single_product -> find('.a-size-mini.a-spacing-none.a-color-base.s-line-clamp-4 ');

            array_push(
                $detailCard_array,
                ProductDetail::create([
                    'name'      =>  $this->sanitizeNodeText($single_product -> find('.a-size-base-plus.a-color-base.a-text-normal')),
                    'image_url' =>  $image -> find('img')->getAttribute('src'),
                    'permalink' => 'https://amazon.com'. $permalink -> find('a')->getAttribute('href')
                ])
            );
        }
 
        $this->setDetailCard($detailCard_array);
    }
}