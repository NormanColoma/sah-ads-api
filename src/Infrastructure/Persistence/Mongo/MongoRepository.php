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
        $limit  = 10+$skip;

        $keyToSort = $sortedBy === 'id' ? $sortedBy : 'length';
        $length = $sortedBy === 'id' ? null : array('$strLenCP' => '$'.$sortedBy);
        $documents = $this->db->ads->aggregate(
            array(
                array('$project' =>
                    array(
                        'id'=> 1,
                        'title' => 1,
                        'link' => 1,
                        'city' => 1,
                        'image' => 1,
                        'length' => $length
                    )
                ),
                array('$sort' => array($keyToSort => $direction)),
                array('$limit' => $limit),
                array('$skip' => $skip)
            )
        );

        $ads = [];
        foreach ($documents as $document) {
            $json = $document->jsonSerialize();
            array_push($ads, new Ad($json->id, $json->title, $json->link, $json->city, $json->image));
        }
        return $ads;
    }

    public function findAllUntil($sortedBy, $direction, $untilPage): array
    {
        $limit  = 10*$untilPage;

        $keyToSort = $sortedBy === 'id' ? $sortedBy : 'length';
        $length = $sortedBy === 'id' ? null : array('$strLenCP' => '$'.$sortedBy);
        $documents = $this->db->ads->aggregate(
            array(
                array('$project' =>
                    array(
                        'id'=> 1,
                        'title' => 1,
                        'link' => 1,
                        'city' => 1,
                        'image' => 1,
                        'length' => $length
                    )
                ),
                array('$sort' => array($keyToSort => $direction)),
                array('$limit' => $limit),
            )
        );

        $ads = [];
        foreach ($documents as $document) {
            $json = $document->jsonSerialize();
            array_push($ads, new Ad($json->id, $json->title, $json->link, $json->city, $json->image));
        }
        return $ads;
    }
}