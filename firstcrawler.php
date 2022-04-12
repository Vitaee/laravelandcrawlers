<?php

require 'vendor/autoload.php';

class crawler {

    private $reqClient;
    private $prices;

    function __construct()
    {
        $this->reqClient = new \Goutte\Client();
        $this->prices = [];
        
    }

    function showData() {
        print_r($this->prices)."\n";
        //echo json_encode(array('items' => $this->prices), JSON_UNESCAPED_UNICODE);
    }

    function start() {
        $res = $this->reqClient->request('GET', 'https://books.toscrape.com/');
        
        return $res;
        
    }

    function scrape(): array|bool{
        $response = $this->start();
        
        $response->filter('.row article div.product_price p.price_color')->each( function ($node) {
            $this->prices[] = $node->text();
        });

        return ( count($this->prices) >= 1 ) ? $this->prices : false;
    }
}

$first = new crawler();
$first->scrape();
$first->showData();


?>
