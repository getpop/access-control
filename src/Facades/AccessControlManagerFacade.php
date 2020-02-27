<?php
namespace PoP\AccessControl\Facades;

use PoP\AccessControl\Services\AccessControlManagerInterface;
use PoP\Root\Container\ContainerBuilderFactory;

class AccessControlManagerFacade
{
    public static function getInstance(): AccessControlManagerInterface
    {
        return ContainerBuilderFactory::getInstance()->get('access_control_manager');
    }
}
