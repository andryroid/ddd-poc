<?php

namespace Infrastructure\Resolver\Booking;

use Application\Booking\Command\CreateBookingCommand;
use Infrastructure\Common\Identifier\Uuid\Booking\BookingIdentifier;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

#[AutoconfigureTag(name: 'controller.argument_value_resolver', attributes: ['priority' => 100])]
class CreateBookingCommandResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        if ($argument->getType() !== CreateBookingCommand::class) {
            return false;
        }

        return true;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $data = json_decode($request->getContent());
        yield CreateBookingCommand::fromArray(BookingIdentifier::fromString($data->uuid), $data);
    }

}
