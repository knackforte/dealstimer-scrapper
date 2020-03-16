<?php

namespace Bissolli\TwitterScraper;
use Bissolli\TwitterScraper\Models\BabyShopProductDetail;
use Bissolli\TwitterScraper\Traits\HelpersTrait;
use Carbon\Carbon;
use PHPHtmlParser\Dom;

class BabyShopProductDetailController extends BabyShopProductDetailControllerAbstract
{
    use HelpersTrait;

    public function __construct($permalink)
    {
        $dom = new Dom();
        $dom->load($permalink); 
        //echo $dom;
        $this->setDomHtml($dom);
       

        $this->extractProductDetail();
        return $this;
    }
    protected function extractProductDetail()
    {     
        $detailCard_array = [];  
        $abc = $this->domHtml->find('.product-list.row');

        foreach($abc->find('.product') as $dom)
        {
            $src = $dom->find('img')->getAttribute('srcset');
            $price = $dom->find('.price')->find('.lowest');
            array_push(
                $detailCard_array,
                BabyShopProductDetail::create([
                    'name'      => $this->sanitizeNodeText( $dom->find('.name')),
                    'image_url' =>  substr($src,0,strpos($src,' ')),
                    'permalink' => 'https://www.babyshop.com'. $dom->find('a')->getAttribute('href'),
                    'price' => $this->sanitizeNodeText($price)
                ])
            );
        }
 
        $this->setDetailCard($detailCard_array);
    }
}