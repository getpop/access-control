<?php
namespace PoP\AccessControl\Hooks;

use PoP\AccessControl\Hooks\AbstractAccessControlForDirectivesHookSet;
use PoP\AccessControl\Environment;

abstract class AbstractMaybeDisableDirectivesInPrivateSchemaHookSet extends AbstractAccessControlForDirectivesHookSet
{
    protected function enabled(): bool
    {
        return Environment::usePrivateSchemaMode();
    }
}
