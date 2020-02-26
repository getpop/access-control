<?php
namespace PoP\AccessControl;

class Environment
{
    public const DISABLE_ACCESS_CONTROL = 'DISABLE_ACCESS_CONTROL';

    public static function disableAccessControl(): bool
    {
        return isset($_ENV[self::DISABLE_ACCESS_CONTROL]) ? strtolower($_ENV[self::DISABLE_ACCESS_CONTROL]) == "true" : false;
    }
}

