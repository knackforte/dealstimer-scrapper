<?php

require __DIR__ . '/../vendor/autoload.php';

$permalink = $_SERVER['QUERY_STRING'];
$productDetailController = new \Bissolli\TwitterScraper\ProductDetailController($permalink);
echo json_encode(array('products' => $productDetailController->getDetailCard()));

