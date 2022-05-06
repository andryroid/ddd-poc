<?php

namespace Infrastructure\Controller\Booking\Command;

use Application\Booking\CreateBooking\Command\CreateBookingCommand;
use Infrastructure\Common\AbstractController;
use Infrastructure\Common\Identifier\Uuid\UuidIdentifier;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/booking', methods: ['POST'], name: "api_booking_create")]
final class BookTripController extends AbstractController
{   
    public function __invoke(Request $request) {
        $this->command(
            CreateBookingCommand::createBooking(
                new UuidIdentifier(),
                (object)(json_decode($request->getContent()))
            )
        );
        return $this->responseManager->success(['success' => true]);
    }
}
