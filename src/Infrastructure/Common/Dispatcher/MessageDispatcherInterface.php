<?php

namespace Infrastructure\Common\Dispatcher;

interface MessageDispatcherInterface
{
    public function dispatchMessage(object $message): mixed;

}
