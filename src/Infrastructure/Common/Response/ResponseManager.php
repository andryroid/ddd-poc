<?php

namespace Infrastructure\Common\Response;

use Infrastructure\Common\Response\ResponseManagerInterface;
use JsonSerializable;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ResponseManager implements ResponseManagerInterface {

    public function success(JsonSerializable|array $data): JsonResponse {
        return new JsonResponse(
            [
                'status' => 200,
                'payload' => $data
            ],
            200);
    }

    public function error(JsonSerializable|array $data): JsonResponse {
        return new JsonResponse(
            [
                'status' => 500,
                'payload' => $data
            ],
            200);
    }

}