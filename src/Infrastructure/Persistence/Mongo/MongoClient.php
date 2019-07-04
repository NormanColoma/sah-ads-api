<?php


namespace App\Infrastructure\Persistence\Mongo;
use MongoDB;

class MongoClient
{
    private $db;
    private $connection_url;

    public function __construct($connection_url)
    {
        $this->connection_url=$connection_url;
        $conn = new MongoDB\Client($this->connection_url);
        $this->db = $conn->test;
    }

    public function db() {
        return $this->db;
    }
}