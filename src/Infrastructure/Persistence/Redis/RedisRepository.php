<?php


namespace App\Infrastructure\Persistence\Redis;

use App\Domain\Ad;
use App\Domain\AdRepository;

class RedisRepository implements AdRepository
{

    private $client;

    public function __construct(RedisClient $redisClient)
    {
        $this->client = $redisClient->client();
    }

    public function save(Ad $ad): void
    {
        $this->client->lpush('ads', serialize($ad));
    }

    public function findAll($sortBy, $direction, $page): array
    {
        $start = $page*10;
        $stop  = $start+9;
        $ads = $this->client->lrange('ads', $start, $stop);
        return array_map(function ($data) {
            return unserialize($data);
        }, $ads);
    }
}