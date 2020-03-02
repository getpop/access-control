<?php
namespace PoP\AccessControl\Hooks;

use PoP\AccessControl\ConfigurationEntries\ConfigurableAccessControlForDirectivesTrait;

abstract class AbstractConfigurableAccessControlForDirectivesInPrivateSchemaHookSet extends AbstractMaybeDisableDirectivesInPrivateSchemaHookSet
{
    use ConfigurableAccessControlForDirectivesTrait;

    protected function enabled(): bool
    {
        return parent::enabled() && !empty($this->getEntries());
    }
}
