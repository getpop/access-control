<?php

declare(strict_types=1);

namespace PoP\AccessControl;

use PoP\ComponentModel\AbstractComponentConfiguration;

class ComponentConfiguration extends AbstractComponentConfiguration
{
    private static $enableIndividualControlForPublicPrivateSchemaMode;

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
