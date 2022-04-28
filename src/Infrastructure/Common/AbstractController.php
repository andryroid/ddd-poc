<?php

namespace Infrastructure\Common;

use Infrastructure\Common\Dispatcher\MessageDispatcherInterface;
use Infrastructure\Common\Response\ResponseManagerInterface;

abstract class AbstractController
{
    public function __construct(
        protected ResponseManagerInterface $responseManager,
        protected MessageDispatcherInterface $messengerDispatcher
    ) {
    }

    public function query(object $message): mixed
    {
        return $this->messengerDispatcher->dispatchMessage($message);
    }

    public function command(object $message): mixed
    {
        return $this->messengerDispatcher->dispatchMessage($message);
    }

}
