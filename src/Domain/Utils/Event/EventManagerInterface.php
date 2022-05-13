<?php

namespace Domain\Utils\Event;

use Domain\Utils\AggregateRoot\AggregateRoot;

interface EventManagerInterface
{

    public function persist(AggregateRoot $aggregateRoot): void;


}
