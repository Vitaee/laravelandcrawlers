<?php

require "./vendor/autoload.php";

$dotenv = \Dotenv\Dotenv::createImmutable("./");
$dotenv->load();


class MysqlDb {
    protected $host,$username, $password, $db, $port,$conn;

    function __construct()
    {
        $this->host = $_ENV['mysql_host'];
        $this->username = $_ENV['mysql_username'] ;
        $this->password = $_ENV['mysql_password'] ;
        $this->db = $_ENV['mysql_database'] ;      
        $this->port = $_ENV['mysql_port'];
        $this->connect();
        
    }

    private function connect() {
        $this->conn = new mysqli($this->host, $this->username, $this->password,$this->db, $this->port);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        echo "connected to database: $this->db \n";
    }

    function getData($table, $where) {}

    function updateData($table, $update_value, $where){}

    function createData(){}

    function deleteData(){}


}


$db = new MysqlDb();

?>