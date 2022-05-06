<?php

namespace Infrastructure\Common\Identifier\Uuid;

use Domain\Utils\Identifier\IndentifierInterface;

final class UuidIdentifier implements IndentifierInterface {

    public function isValidIdentifier(string $identifier): bool
    {
        return strlen($identifier) > 10;
    }

    public function getIdentifier(): string 
    {
        return 
        sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
}