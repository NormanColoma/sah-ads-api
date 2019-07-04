<?php


namespace App\Application;


use App\Domain\Ad;
use App\Domain\AdRepository;

class CreateAdService
{
    private $adRepository;

    public function __construct(AdRepository $adRepository)
    {
        $this->adRepository = $adRepository;
    }

    public function execute(CreateAdRequest $request) {
        $ad = new Ad($request->getId(), $request->getTitle(), $request->getLink(), $request->getCity(), $request->getImage());
        $this->adRepository->save($ad);
    }

}