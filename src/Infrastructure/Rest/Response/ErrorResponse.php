<?php


namespace App\Infrastructure\Rest\Response;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ErrorResponse extends JsonResponse
{
    public function __construct($data = null, int $status = Response::HTTP_INTERNAL_SERVER_ERROR, array $headers = [], bool $json = false)
    {
        parent::__construct(['error' => $data], $status, $headers, $json);
    }
}