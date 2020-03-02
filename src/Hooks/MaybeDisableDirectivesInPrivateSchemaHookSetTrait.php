<?php
namespace PoP\AccessControl\Hooks;

use PoP\AccessControl\Environment;
use PoP\AccessControl\ConfigurationEntries\MaybeDisableDirectivesIfConditionTrait;

trait MaybeDisableDirectivesInPrivateSchemaHookSetTrait
{
    use MaybeDisableDirectivesIfConditionTrait;

    protected function enabled(): bool
    {
        return Environment::usePrivateSchemaMode() && !empty($this->getMatchingEntries());
    }
}
