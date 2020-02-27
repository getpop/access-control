<?php
namespace PoP\AccessControl;

use PoP\AccessControl\Environment;
use PoP\Root\Component\AbstractComponent;
use PoP\Root\Component\YAMLServicesTrait;
use PoP\Root\Component\CanDisableComponentTrait;

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

            // Boot conditional on API package being installed
            if (class_exists('\PoP\CacheControl\Component')) {
                \PoP\AccessControl\Conditional\CacheControl\ConditionalComponent::init();
            }
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

        // Boot conditional on API package being installed
        if (class_exists('\PoP\CacheControl\Component')) {
            \PoP\AccessControl\Conditional\CacheControl\ConditionalComponent::boot();
        }
    }
}
