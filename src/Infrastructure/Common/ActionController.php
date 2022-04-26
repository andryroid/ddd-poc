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
        return new JsonResponse(
            json_encode($response),
            $statusCode,
            $$headers
        );
    }
}
