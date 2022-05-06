<?php

namespace Infrastructure\Controller\Booking\Command;

use Infrastructure\Common\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/booking', methods: ['POST'], name: "api_booking_create")]
final class BookTripController extends AbstractController
{
    
    public function __invoke(Request $request) {
        $information = json_decode($request->getContent());
        return $this->responseManager->success($information);
    }
}
