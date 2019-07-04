<?php


namespace App\Application;


use App\Domain\AdRepository;

class FindAllAdsService
{
    private $adRepository;
    private $adDataTransformer;

    public function __construct(AdRepository $adRepository, AdDataTransformer $adDataTransformer)
    {
        $this->adRepository = $adRepository;
        $this->adDataTransformer = $adDataTransformer;
    }

    public function execute(): array {
        $ads = $this->adRepository->findAll();
        $this->adDataTransformer->write($ads);
        return $this->adDataTransformer->read();
    }

}