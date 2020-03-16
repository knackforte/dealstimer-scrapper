<?php

require __DIR__ . '/../vendor/autoload.php';

$permalink = $_SERVER['QUERY_STRING'];
$productPriceController = new \Bissolli\TwitterScraper\ProductPriceController($permalink);

echo $productPriceController->getProductPrice()->getPrice();

