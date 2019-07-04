<?php


namespace App\Application;


use App\Domain\Ad;

class JsonAdDataTransformer implements AdDataTransformer
{

    private $data = array();

    public function write(array $ads): void
    {
        foreach ($ads as $ad) {
            array_push($this->data, $this->adAsJson($ad));
        }
    }

    public function read(): array
    {
        return $this->data;
    }

    private function adAsJson(Ad $ad) {
        return array(
            'id' => $ad->getId(),
            'title' => $ad->getTitle(),
            'link' => $ad->getLink(),
            'city' => $ad->getCity(),
            'main_image' => $ad->getImage()
        );
    }
}