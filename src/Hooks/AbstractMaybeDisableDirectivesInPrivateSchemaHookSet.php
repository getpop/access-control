<?php
namespace PoP\AccessControl\Hooks;

use PoP\API\Environment;
use PoP\API\Hooks\AbstractMaybeDisableDirectivesHookSet;

abstract class AbstractMaybeDisableDirectivesInPrivateSchemaHookSet extends AbstractMaybeDisableDirectivesHookSet
{
    /**
     * Return true if the directives must be disabled
     *
     * @return boolean
     */
    protected function enabled(): bool
    {
        return Environment::usePrivateSchemaMode();
    }
}
