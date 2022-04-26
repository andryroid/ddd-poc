<?php

namespace Infrastructure\Common;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ActionController {
    public function __construct(
        private Request $request
    )
    {
        
    }

    protected function json(array $response, int $statusCode, array $headers = []) : JsonResponse {
        $response =  new JsonResponse(
            json_encode($response),
            $statusCode,
            $headers
        );
        if (count($headers) === 0)
            $response->headers->set('Content-Type','application/json');
        return $response;
    }
}
