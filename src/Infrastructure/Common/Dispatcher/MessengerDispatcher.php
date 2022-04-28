<?php

namespace Infrastructure\Common\Dispatcher;

use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class MessengerDispatcher implements MessageDispatcherInterface
{

    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    public function dispatchMessage(object $message): mixed
    {
        $envelop = $this->messageBus->dispatch($message);
        /** @var HandledStamp $stamp */
        $stamp = $envelop->last(HandledStamp::class);
        return $stamp->getResult();
    }

}
