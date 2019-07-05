<?php


namespace App\Tests\Application;


use App\Application\CreateAdRequest;
use App\Application\CreateAdService;
use App\Domain\Ad;
use App\Domain\AdNotValidException;
use App\Domain\AdRepository;
use PHPUnit\Framework\TestCase;

class CreateAdServiceTest extends TestCase
{
    public function testThatCannotCreateAdWhenItHasInvalidId() {
        $this->expectException(AdNotValidException::class);
        $this->expectExceptionMessage('Ad has not valid id');
        $adRepository = $this->createMock(AdRepository::class);
        $adId = 'test';

        $createAdRequest = new CreateAdRequest($adId, 'test', 'test', 'test', 'test');
        $adRepository->expects($this->never())
            ->method('save');

        $createAdService = new CreateAdService($adRepository);
        $createAdService->execute($createAdRequest);
    }

    public function testThatCannotCreateAdWhenTitleIsInvalid() {
        $this->expectException(AdNotValidException::class);
        $this->expectExceptionMessage('Ad has no valid title');
        $adRepository = $this->createMock(AdRepository::class);

        $createAdRequest = new CreateAdRequest(5, 5, 'test', 'test', 'test');
        $adRepository->expects($this->never())
            ->method('save');

        $createAdService = new CreateAdService($adRepository);
        $createAdService->execute($createAdRequest);
    }

    public function testThatCannotCreateAdWhenLinkIsInvalid() {
        $this->expectException(AdNotValidException::class);
        $this->expectExceptionMessage('Ad has no valid link');
        $adRepository = $this->createMock(AdRepository::class);

        $createAdRequest = new CreateAdRequest(5, 'tes', 'test', 'test', 'test');
        $adRepository->expects($this->never())
            ->method('save');

        $createAdService = new CreateAdService($adRepository);
        $createAdService->execute($createAdRequest);
    }

    public function testThatCannotCreateAdWhenCityIsInvalid() {
        $this->expectException(AdNotValidException::class);
        $this->expectExceptionMessage('Ad has no valid link');
        $adRepository = $this->createMock(AdRepository::class);

        $createAdRequest = new CreateAdRequest(5, 'tes', 'test', 5, 'test');
        $adRepository->expects($this->never())
            ->method('save');

        $createAdService = new CreateAdService($adRepository);
        $createAdService->execute($createAdRequest);
    }

    public function testThatCannotCreateAdWhenImageIsInvalid() {
        $this->expectException(AdNotValidException::class);
        $this->expectExceptionMessage('Ad has no valid link');
        $adRepository = $this->createMock(AdRepository::class);

        $createAdRequest = new CreateAdRequest(5, 'tes', 'test', 'test', 'test');
        $adRepository->expects($this->never())
            ->method('save');

        $createAdService = new CreateAdService($adRepository);
        $createAdService->execute($createAdRequest);
    }


    public function testThatCanCreateAdCorrectly() {
        $adRepository = $this->createMock(AdRepository::class);

        $createAdRequest = new CreateAdRequest(5, 'tes', 'https://test.com', 'test', 'https://test.com');
        $ad = new Ad(5, 'tes', 'https://test.com', 'test', 'https://test.com');

        $adRepository->expects($this->once())
            ->method('save')
            ->with($ad)
            ->willReturn(null);

        $createAdService = new CreateAdService($adRepository);
        $createAdService->execute($createAdRequest);
    }

}