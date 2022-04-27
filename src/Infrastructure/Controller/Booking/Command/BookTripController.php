<?php

namespace Infrastructure\Controller\Booking\Command;

use Infrastructure\Common\AbstractController;
use Infrastructure\Common\Response\ResponseManagerInterface;
use Infrastructure\Controller\Booking\Response\BookingResponseManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class BookTripController extends AbstractController
{
    #[Route('/booking', methods: ['POST'], name: "api_booking_create")]
    public function bookTripAction(Request $request) {
        return $this->responseManager->success(
            [
                'status' => 200,
                'payload' => "Success"
            ]);
    }
}
