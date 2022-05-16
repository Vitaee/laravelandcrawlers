<?php

require 'vendor/autoload.php';

class crawler {

    private $reqClient;
    private $prices;

    function __construct()
    {
        $this->reqClient = new \Goutte\Client();
        $this->data = [ array("items") ];
        
    }

    function showData() {
        echo json_encode($this->data, JSON_UNESCAPED_UNICODE)."\n";
        //echo json_encode(array('items' => $this->prices), JSON_UNESCAPED_UNICODE);
    }

    function start() {
        $res = $this->reqClient->request('GET', 'https://books.toscrape.com/');
        
        return $res;
        
    }

    function scrape(): array|bool{
        $response = $this->start();
        

        $response->filter('.row article')->each( function ($node){
            $this->data[] =  array(
                "price" =>$node->filter('div.product_price p.price_color')->text(), 
                "title" => $node->filter('h3 a')->text(),
                "image" => "https://books.toscrape.com/".$node->filter('div.image_container a img')->attr('src')
            );
        });

        


        return ( count($this->data) >= 1 ) ? $this->data : false;
    }
}

$first = new crawler();
$first->scrape();
$first->showData();
?>
