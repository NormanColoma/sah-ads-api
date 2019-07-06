<?php


namespace App\Tests\Application;


use App\Application\DownloadAdsAsJsonRequest;
use App\Application\DownloadAdsAsJsonService;
use App\Application\JsonAdDataTransformer;
use App\Domain\Ad;
use App\Domain\AdRepository;
use PHPUnit\Framework\TestCase;

class DownloadAdsAsJsonServiceTest extends TestCase
{
    public function testThatCanDownloadAdsCorrectly() {
        $adRepository = $this->createMock(AdRepository::class);
        $dataTransformer = new JsonAdDataTransformer();

        $findAllAdsServiceRequest = new DownloadAdsAsJsonRequest('id', 1, 0);
        $ad = new Ad(5, 'tes', 'https://test.com', 'test', 'https://test.com');

        $adRepository->expects($this->once())
            ->method('findAllUntil')
            ->with('id', 1, 0)
            ->willReturn(array($ad));

        $downloadAdsAsJsonService = new DownloadAdsAsJsonService($adRepository, $dataTransformer);
        $actual = $downloadAdsAsJsonService->execute($findAllAdsServiceRequest);
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