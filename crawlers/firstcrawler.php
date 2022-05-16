<?php

require 'vendor/autoload.php';
use Phpml\Clustering\DBSCAN;

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

//$first = new crawler();
//$first->scrape();
//$first->showData();

//$sample1 = [[1, 1], [8, 7], [1, 2], [7, 8], [2, 1], [8, 9]];
$samples = [ 'Label1' => [1, 1], 'Label2' => [8, 7], 'Label3' => [1, 2]];

//$array1 = array( "clusters" => array( 0=> array( "center"=>array("long"=>2,"lang"=>3), "size"=>9 ), 1=>array( "center"=>array("long"=>21.2,"lang"=>9), "size"=>2 ) ) );

//$kmeans = new KMeans(1);
//$data = $kmeans->cluster($samples);
//echo json_encode($data);


?>
