<?php


namespace App\Application;


use App\Domain\AdRepository;

class DownloadAdsAsJsonService
{
    private $adsRepository;
    private $adDataTransformer;

    public function __construct(AdRepository $adsRepository, AdDataTransformer $adDataTransformer)
    {
        $this->adsRepository = $adsRepository;
        $this->adDataTransformer = $adDataTransformer;
    }

    public function execute(DownloadAdsAsJsonRequest $downloadAdsAsJsonRequest) {
        $ads = $this->adsRepository->findAllUntil($downloadAdsAsJsonRequest->getSortedBy(), $downloadAdsAsJsonRequest->getDirection(), $downloadAdsAsJsonRequest->getUntilPage());
        $this->adDataTransformer->write($ads);
        return $this->adDataTransformer->read();
    }

}