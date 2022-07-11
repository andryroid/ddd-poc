<?php

namespace Infrastructure\Resolver\Booking;

use Application\Booking\Command\CreateBookingCommand;
use Application\Booking\Query\PreCheckoutBookingQuery;
use Infrastructure\Common\Identifier\Uuid\Booking\BookingIdentifier;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

#[AutoconfigureTag(name: 'controller.argument_value_resolver', attributes: ['priority' => 100])]
class PreCheckoutBookingResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === PreCheckoutBookingQuery::class;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $data = json_decode($request->getContent());
        yield CreateBookingCommand::fromArray(BookingIdentifier::generate(), $data);
    }

}
