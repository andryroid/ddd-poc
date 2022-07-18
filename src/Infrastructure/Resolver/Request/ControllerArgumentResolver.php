<?php

namespace Infrastructure\Resolver\Request;

use Application\Shared\Message\FromArrayableInterface;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

#[AutoconfigureTag(name: 'controller.argument_value_resolver', attributes: ['priority' => 100])]
class ControllerArgumentResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        if (!is_subclass_of($argument->getType(), FromArrayableInterface::class)) {
            return false;
        }

        return true;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $message = $argument->getType();
        $data = json_decode($request->getContent(), true);
        yield $message::fromArray($data);
    }

}
