<?php

declare(strict_types=1);

namespace PoP\AccessControl;

use PoP\ComponentModel\ComponentConfiguration\AbstractComponentConfiguration;

class ComponentConfiguration extends AbstractComponentConfiguration
{
    private static $usePrivateSchemaMode;
    private static $enableIndividualControlForPublicPrivateSchemaMode;

    public static function usePrivateSchemaMode(): bool
    {
        // Define properties
        $envVariable = Environment::USE_PRIVATE_SCHEMA_MODE;
        $selfProperty = &self::$usePrivateSchemaMode;
        $callback = [Environment::class, 'usePrivateSchemaMode'];

        // Initialize property from the environment/hook
        self::maybeInitEnvironmentVariable(
            $envVariable,
            $selfProperty,
            $callback
        );
        return $selfProperty;
    }

    public static function enableIndividualControlForPublicPrivateSchemaMode(): bool
    {
        // Define properties
        $envVariable = Environment::ENABLE_INDIVIDUAL_CONTROL_FOR_PUBLIC_PRIVATE_SCHEMA_MODE;
        $selfProperty = &self::$enableIndividualControlForPublicPrivateSchemaMode;
        $callback = [Environment::class, 'enableIndividualControlForPublicPrivateSchemaMode'];

        // Initialize property from the environment/hook
        self::maybeInitEnvironmentVariable(
            $envVariable,
            $selfProperty,
            $callback
        );
        return $selfProperty;
    }
}
