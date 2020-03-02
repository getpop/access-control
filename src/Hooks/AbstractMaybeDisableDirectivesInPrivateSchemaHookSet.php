<?php
namespace PoP\AccessControl\Hooks;

use PoP\AccessControl\Hooks\AbstractMaybeDisableDirectivesHookSet;
use PoP\AccessControl\Environment;
use PoP\AccessControl\ConfigurationEntries\ConfigurableAccessControlForDirectivesTrait;

abstract class AbstractMaybeDisableDirectivesInPrivateSchemaHookSet extends AbstractMaybeDisableDirectivesHookSet
{
    use ConfigurableAccessControlForDirectivesTrait;

    protected function enabled(): bool
    {
        return Environment::usePrivateSchemaMode() && !empty($this->getEntries());
    }
}
