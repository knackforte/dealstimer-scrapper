<?php

require __DIR__ . '/../vendor/autoload.php';

$permalink = $_SERVER['QUERY_STRING'];
$BabyShopProductPriceController = new \Bissolli\TwitterScraper\BabyShopProductPriceController($permalink);
echo $BabyShopProductPriceController->getProductPrice()->getPrice();

