<?php

require __DIR__ . '/../vendor/autoload.php';

$username = $_GET['username'];
$account = new \Bissolli\TwitterScraper\Twitter($username);

echo json_encode( $account->getProfile());
