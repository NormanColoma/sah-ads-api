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
        $this->client->hSet('ads', $ad->getId(), serialize($ad));
    }

    public function findAll(): array
    {
        $ads = $this->client->hGetAll('ads');
        return array_map(function ($data) {
            return unserialize($data);
        }, $ads);
    }
}