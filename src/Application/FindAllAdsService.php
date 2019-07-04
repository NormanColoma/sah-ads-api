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

    public function execute(FindAllAdsServiceRequest $findAllAdsServiceRequest): array {
        $ads = $this->adRepository->findAll($findAllAdsServiceRequest->getSortedBy(), $findAllAdsServiceRequest->getDirection(), $findAllAdsServiceRequest->getPage());
        $this->adDataTransformer->write($ads);
        return $this->adDataTransformer->read();
    }

}