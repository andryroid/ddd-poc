<?php

namespace Infrastructure\Controller\Booking\Query;

use Application\Booking\Query\PreCheckoutBookingQuery;
use Infrastructure\Common\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/booking/pre_checkout', name: "api_booking_pre_checkout", methods: ['POST'])]
final class PreCheckoutBookController extends AbstractController
{
    public function __invoke(Request $request, PreCheckoutBookingQuery $query): Response
    {
        return $this->responseManager->success(['bookingId' => $this->query($query)]);
    }
}
