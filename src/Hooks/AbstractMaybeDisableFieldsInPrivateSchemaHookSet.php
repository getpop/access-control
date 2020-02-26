<?php
namespace PoP\AccessControl\Hooks;

use PoP\AccessControl\Environment;
use PoP\API\Hooks\AbstractMaybeDisableFieldsHookSet;

abstract class AbstractMaybeDisableFieldsInPrivateSchemaHookSet extends AbstractMaybeDisableFieldsHookSet
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
