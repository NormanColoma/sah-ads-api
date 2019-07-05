<?php


namespace App\Application;


use App\Domain\AdRepository;

class DownloadAdsAsJson
{
    private $adsRepository;
    private $adDataTransformer;

    public function __construct(AdRepository $adsRepository, AdDataTransformer $adDataTransformer)
    {
        $this->adsRepository = $adsRepository;
        $this->adDataTransformer = $adDataTransformer;
    }

    public function execute(DownloadAdsAsJsonRequest $downloadAdsAsJsonRequest) {
        $ads = $this->adsRepository->findAll($downloadAdsAsJsonRequest->getSortedBy(), $downloadAdsAsJsonRequest->getDirection(), $downloadAdsAsJsonRequest->getPage());
        $this->adDataTransformer->write($ads);
        return $this->adDataTransformer->read();
    }

}