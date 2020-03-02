<?php
namespace PoP\AccessControl\Hooks;

use PoP\AccessControl\Environment;
use PoP\AccessControl\Hooks\AbstractAccessControlForFieldsHookSet;

abstract class AbstractAccessControlForFieldsInPrivateSchemaHookSet extends AbstractAccessControlForFieldsHookSet
{
    /**
     * Indicate if this hook is enabled
     *
     * @return boolean
     */
    protected function enabled(): bool
    {
        return Environment::usePrivateSchemaMode();
    }
}
