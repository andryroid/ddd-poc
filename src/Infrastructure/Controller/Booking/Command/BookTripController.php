<?php

namespace Infrastructure\Controller\Booking\Command;

use Infrastructure\Common\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class BookTripController extends AbstractController
{
    public function __construct(
        private
    )
    {
        
    }
    #[Route('/booking', methods: ['POST'], name: "api_booking_create")]
    public function bookTripAction(Request $request) {
        return $this->responseManager->success(
            [
                'status' => 200,
                'payload' => "Success"
            ]);
    }
}
