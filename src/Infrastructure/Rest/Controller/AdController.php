<?php


namespace App\Infrastructure\Rest\Controller;


use App\Application\CreateAdRequest;
use App\Application\CreateAdService;
use App\Application\FindAllAdsService;
use App\Application\FindAllAdsServiceRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

        $createAdService->execute($createAdRequest);
        return new Response(null,201, ['Access-Control-Allow-Origin' => '*']);
    }


    /**
     * @Route("/ads", name="find_adds", methods={"GET"})
     * @param Request $request
     * @param FindAllAdsService $findAllAdsService
     * @return JsonResponse
     */
    public function findAdds(Request $request, FindAllAdsService $findAllAdsService): JsonResponse {
        $page = $request->query->get('page');
        $findAllAdsServiceRequest = new FindAllAdsServiceRequest('id', 1, $page);
        return new JsonResponse($findAllAdsService->execute($findAllAdsServiceRequest), Response::HTTP_OK);
    }


}