<?php


namespace App\Tests\Application;


use App\Application\FindAllAdsService;
use App\Application\FindAllAdsServiceRequest;
use App\Application\JsonAdDataTransformer;
use App\Domain\Ad;
use App\Domain\AdRepository;
use PHPUnit\Framework\TestCase;

class FindAllAdsServiceTest extends TestCase
{
    public function testThatCanFindAllAdsCorrectly() {
        $adRepository = $this->createMock(AdRepository::class);
        $dataTransformer = new JsonAdDataTransformer();

        $findAllAdsServiceRequest = new FindAllAdsServiceRequest('id', 1, 0);
        $ad = new Ad(5, 'tes', 'https://test.com', 'test', 'https://test.com');

        $adRepository->expects($this->once())
            ->method('findAll')
            ->with('id', 1, 0)
            ->willReturn(array($ad));

        $findAllAdsService = new FindAllAdsService($adRepository, $dataTransformer);
        $actual = $findAllAdsService->execute($findAllAdsServiceRequest);
        $expected = array(
            array(
                'id' => 5,
                'title' => 'tes',
                'link' => 'https://test.com',
                'city' => 'test',
                'main_image' => 'https://test.com')
        );
        $this->assertEquals($expected, $actual);
    }
}