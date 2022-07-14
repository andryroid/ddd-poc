<?php

namespace Infrastructure\Controller\Booking\Query;

use Application\Booking\Query\CheckBookingQuery;
use Infrastructure\Common\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/booking/checkout', name: "api_booking_checkout", methods: ['POST'])]
final class CheckoutBookingController extends AbstractController
{
    public function __invoke(Request $request, CheckBookingQuery $query): Response
    {
        return $this->responseManager->success(['booking_details' => $this->query($query)]);
    }
}
