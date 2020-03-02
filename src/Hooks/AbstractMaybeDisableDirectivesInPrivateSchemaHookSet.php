<?php
namespace PoP\AccessControl\Hooks;

use PoP\AccessControl\Hooks\AbstractMaybeDisableDirectivesHookSet;
use PoP\AccessControl\Environment;

abstract class AbstractMaybeDisableDirectivesInPrivateSchemaHookSet extends AbstractMaybeDisableDirectivesHookSet
{
    protected function enabled(): bool
    {
        return Environment::usePrivateSchemaMode();
    }
}
