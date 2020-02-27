<?php
namespace PoP\AccessControl\Conditional\CacheControl;

use PoP\Root\Component\YAMLServicesTrait;
use PoP\AccessControl\Component;
use PoP\ComponentModel\Container\ContainerBuilderUtils;

/**
 * Initialize component
 */
class ConditionalComponent
{
    use YAMLServicesTrait;

    public static function init()
    {
        self::initYAMLServices(Component::$COMPONENT_DIR, '/Conditional/CacheControl');
    }

    /**
     * Boot component
     *
     * @return void
     */
    public static function boot()
    {
        // Initialize classes
        ContainerBuilderUtils::instantiateNamespaceServices(__NAMESPACE__.'\\Hooks');
    }
}
