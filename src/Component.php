<?php
namespace PoP\AccessControl;

use PoP\AccessControl\Environment;
use PoP\Root\Component\AbstractComponent;
use PoP\Root\Component\YAMLServicesTrait;
use PoP\Root\Component\CanDisableComponentTrait;
use PoP\ComponentModel\Container\ContainerBuilderUtils;

/**
 * Initialize component
 */
class Component extends AbstractComponent
{
    public static $COMPONENT_DIR;
    use YAMLServicesTrait, CanDisableComponentTrait;
    // const VERSION = '0.1.0';

    /**
     * Initialize services
     */
    public static function init()
    {
        if (self::isEnabled()) {
            parent::init();
            self::$COMPONENT_DIR = dirname(__DIR__);
            self::initYAMLServices(self::$COMPONENT_DIR);
        }
    }

    protected static function resolveEnabled()
    {
        return !Environment::disableAccessControl();
    }

    /**
     * Boot component
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        // // Initialize classes
        ContainerBuilderUtils::instantiateNamespaceServices(__NAMESPACE__.'\\Hooks');
        ContainerBuilderUtils::attachTypeResolverDecoratorsFromNamespace(__NAMESPACE__.'\\TypeResolverDecorators');
        ContainerBuilderUtils::attachDirectiveResolversFromNamespace(__NAMESPACE__.'\\DirectiveResolvers');
    }
}
