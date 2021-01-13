<?php

use PageSpeedCrawler\PageCrawler;
use PageSpeedCrawler\PageSpeedCrawler;

require_once "vendor/autoload.php";

$crawler = new PageSpeedCrawler();

$router = "http://sanphamcongnghiep.net/shops/Luoi-thep/Luoi-thep-han-chap-lam-hang-rao-224/";
$data = $crawler->getData(new PageCrawler(__DIR__."/data/thep.html",null,__DIR__."/data/thep1.html"));

var_dump($data);