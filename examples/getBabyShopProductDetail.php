<?php

require __DIR__ . '/../vendor/autoload.php';

$permalink = $_SERVER['QUERY_STRING'];
$BabyShopProductDetailController = new \Bissolli\TwitterScraper\BabyShopProductDetailController($permalink);
echo json_encode(array('products' => $BabyShopProductDetailController->getDetailCard()));

