<?php

namespace Infrastructure\Common;

use Infrastructure\Common\Response\ResponseManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

abstract class AbstractController
{
    //todo add my dependencies (messenger bus,...)
   public function __construct(
       protected ResponseManagerInterface $responseManager
   )
   {
   }

}
