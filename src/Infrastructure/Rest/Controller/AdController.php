<?php


namespace App\Infrastructure\Rest\Controller;


use App\Application\CreateAdRequest;
use App\Application\CreateAdService;
use App\Application\DownloadAdsAsJsonService;
use App\Application\DownloadAdsAsJsonRequest;
use App\Application\FindAllAdsService;
use App\Application\FindAllAdsServiceRequest;
use App\Infrastructure\Rest\Response\ErrorResponse;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="add_ads", methods={"POST"})
     * @param Request $request
     * @param CreateAdService $createAdService
     * @return Response
     */
    public function createAdd(Request $request, CreateAdService $createAdService): Response {
        $decoded_request = json_decode($request->getContent(), true);
        $createAdRequest = new CreateAdRequest($decoded_request['id'], $decoded_request['title'], $decoded_request['link'], $decoded_request['city'], $decoded_request['image']);

        try {
            $createAdService->execute($createAdRequest);
            return new Response(null, Response::HTTP_CREATED, ['Access-Control-Allow-Origin' => '*']);
        } catch (Exception $er) {
            return new ErrorResponse($er->getMessage());
        }
    }


    /**
     * @Route("/ads", name="find_adds", methods={"GET"})
     * @param Request $request
     * @param FindAllAdsService $findAllAdsService
     * @return JsonResponse
     */
    public function findAdds(Request $request, FindAllAdsService $findAllAdsService): JsonResponse {
        $page = $request->query->get('page');
        $sortedBy = $request->query->get('sortedBy');
        $direction = $request->query->get('direction');

        if (is_null($page)) {
            return new ErrorResponse('Parameter page is missing');
        } else if(is_null($sortedBy)) {
            return new ErrorResponse('Parameter sortedBy is missing');
        } else if(is_null($direction)) {
            return new ErrorResponse('Parameter direction is missing');
        }

        try {
            $findAllAdsServiceRequest = new FindAllAdsServiceRequest($sortedBy, (int)$direction, $page);
            return new JsonResponse($findAllAdsService->execute($findAllAdsServiceRequest), Response::HTTP_OK, ['Access-Control-Allow-Origin' => '*']);
        }catch (Exception $er) {
            echo $er->getMessage();
            return new ErrorResponse($er->getMessage());
        }
    }

    /**
     * @Route("/ads/json", name="download_ads_as_json", methods={"GET"})
     * @param Request $request
     * @param DownloadAdsAsJsonService $downloadAdsAsJson
     * @return ErrorResponse|JsonResponse
     */
    public function downloadAdsAsJson(Request $request, DownloadAdsAsJsonService $downloadAdsAsJson) {
        $untilPage = $request->query->get('untilPage');
        $sortedBy = $request->query->get('sortedBy');
        $direction = $request->query->get('direction');

        if (is_null($untilPage)) {
            return new ErrorResponse('Parameter untilPage is missing');
        } else if(is_null($sortedBy)) {
            return new ErrorResponse('Parameter sortedBy is missing');
        } else if(is_null($direction)) {
            return new ErrorResponse('Parameter direction is missing');
        }


        $downloadAdsAsJsonRequest = new DownloadAdsAsJsonRequest($sortedBy, (int) $direction, $untilPage);

        try {
            $response = JsonResponse::fromJsonString(json_encode($downloadAdsAsJson->execute($downloadAdsAsJsonRequest), JSON_UNESCAPED_SLASHES));

            $disposition = HeaderUtils::makeDisposition(
                HeaderUtils::DISPOSITION_ATTACHMENT,
                'ads.json'
            );

            $response->headers->set('Content-Disposition', $disposition);
            $response->headers->set('Access-Control-Allow-Origin', '*');

            return $response;
        }catch (Exception $er) {
            return new ErrorResponse($er->getMessage());
        }
    }
}