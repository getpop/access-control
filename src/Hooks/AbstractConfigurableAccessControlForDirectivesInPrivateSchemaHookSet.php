<?php
namespace PoP\AccessControl\Hooks;

use PoP\AccessControl\ConfigurationEntries\ConfigurableAccessControlForDirectivesTrait;

abstract class AbstractConfigurableAccessControlForDirectivesInPrivateSchemaHookSet extends AbstractAccessControlForDirectivesInPrivateSchemaHookSet
{
    use ConfigurableAccessControlForDirectivesTrait;

    protected function enabled(): bool
    {
        return parent::enabled() && !empty($this->getEntries());
    }
}
