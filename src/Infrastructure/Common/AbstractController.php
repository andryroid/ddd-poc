<?php

namespace Infrastructure\Common;

use Infrastructure\Common\Response\ResponseManagerInterface;

abstract class AbstractController
{
    //todo add my dependencies (messenger bus,...)
   public function __construct(
       protected ResponseManagerInterface $responseManager
   )
   {
   }

}
