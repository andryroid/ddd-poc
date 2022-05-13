<?php

namespace Infrastructure\Controller\Booking\Command;

use Application\Booking\CreateBooking\Command\CreateBookingCommand;
use Infrastructure\Common\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/booking', name: "api_booking_create", methods: ['POST'])]
final class CreateBookTripController extends AbstractController
{
    public function __invoke(Request $request, CreateBookingCommand $command): Response
    {
        $bookingId = $this->command($command);
        return $this->responseManager->success(['bookingId' => $bookingId]);
    }
}
