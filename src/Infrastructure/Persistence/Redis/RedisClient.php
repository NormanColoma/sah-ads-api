<?php


namespace App\Infrastructure\Persistence\Redis;


use Symfony\Component\Cache\Adapter\RedisAdapter;

class RedisClient
{
    private $client;
    private $connection_url;

    public function __construct($connection_url)
    {
        $this->connection_url=$connection_url;
        $this->client = RedisAdapter::createConnection($this->connection_url);
    }

    public function client() {
        return $this->client;
    }
}