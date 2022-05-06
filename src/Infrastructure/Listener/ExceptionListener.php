<?php

namespace Infrastructure\Listener;

use Infrastructure\Common\Response\ResponseManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ExceptionListener
{
    public function __construct(private ResponseManagerInterface $responseManager)
    {
    }


    //todo implement me and bind me to kernel.request event
    public function onKernelException(): JsonResponse
    {
        return $this->responseManager->error();
    }

}
