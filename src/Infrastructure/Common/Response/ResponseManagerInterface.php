<?php

namespace Infrastructure\Common\Response;

use JsonSerializable;
use Symfony\Component\HttpFoundation\JsonResponse;

interface ResponseManagerInterface
{
    //todo implement me
    public function success(JsonSerializable|array $data): JsonResponse;
    //todo implement me
    public function error(JsonSerializable|array $data): JsonResponse;

}
