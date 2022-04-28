<?php

namespace Infrastructure\Controller\Booking\Command;

use Infrastructure\Common\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class BookTripController extends AbstractController
{
    #[Route('/booking', methods: ['POST'], name: "api_booking_create")]
    public function bookTripAction(Request $request) {
        $information = json_decode($request->getContent());
        return $this->responseManager->success(
            [
                'status' => 200,
                'data' => $information
            ]);
    }
}
