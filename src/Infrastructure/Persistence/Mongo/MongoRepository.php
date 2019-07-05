<?php


namespace App\Infrastructure\Persistence\Mongo;

use App\Domain\Ad;
use App\Domain\AdRepository;

class MongoRepository implements AdRepository
{

    private $db;

    public function __construct(MongoClient $mongoClient)
    {
        $this->db = $mongoClient->db();
    }

    public function save(Ad $ad): void
    {
        $document= array('id' => $ad->getId(), 'title' => $ad->getTitle(), 'link' => $ad->getLink(), 'city' => $ad->getCity(), 'image' => $ad->getImage());
        $this->db->ads->insertOne($document);
    }

    public function findAll($sortedBy, $direction, $page): array
    {
        $skip = $page*10;
        $limit  = 10;


        $documents = $this->db->ads->find([], ['skip' => $skip, 'limit' => $limit, 'sort' => array($sortedBy => $direction)]);
        $ads = [];

        foreach ($documents as $document) {
            $json = $document->jsonSerialize();
            array_push($ads, new Ad($json->id, $json->title, $json->link, $json->city, $json->image));
        }
        return $ads;
    }
}