<?php
namespace PoP\AccessControl;

class Environment
{
    public const DISABLE_ACCESS_CONTROL = 'DISABLE_ACCESS_CONTROL';
    public const USE_PRIVATE_SCHEMA_MODE = 'USE_PRIVATE_SCHEMA_MODE';
    public const ENABLE_INDIVIDUAL_CONTROL_FOR_PUBLIC_PRIVATE_SCHEMA_MODE = 'ENABLE_INDIVIDUAL_CONTROL_FOR_PUBLIC_PRIVATE_SCHEMA_MODE';

    public static function disableAccessControl(): bool
    {
        return isset($_ENV[self::DISABLE_ACCESS_CONTROL]) ? strtolower($_ENV[self::DISABLE_ACCESS_CONTROL]) == "true" : false;
    }
    public static function usePrivateSchemaMode(): bool
    {
        return isset($_ENV[self::USE_PRIVATE_SCHEMA_MODE]) ? strtolower($_ENV[self::USE_PRIVATE_SCHEMA_MODE]) == "true" : false;
    }
    public static function enableIndividualControlForPublicPrivateSchemaMode(): bool
    {
        return isset($_ENV[self::ENABLE_INDIVIDUAL_CONTROL_FOR_PUBLIC_PRIVATE_SCHEMA_MODE]) ? strtolower($_ENV[self::ENABLE_INDIVIDUAL_CONTROL_FOR_PUBLIC_PRIVATE_SCHEMA_MODE]) == "true" : false;
    }
}
