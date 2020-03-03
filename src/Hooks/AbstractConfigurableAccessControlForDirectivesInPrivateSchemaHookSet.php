<?php
namespace PoP\AccessControl\Hooks;

use PoP\MandatoryDirectivesByConfiguration\ConfigurationEntries\ConfigurableMandatoryDirectivesForDirectivesTrait;

abstract class AbstractConfigurableAccessControlForDirectivesInPrivateSchemaHookSet extends AbstractAccessControlForDirectivesInPrivateSchemaHookSet
{
    use ConfigurableMandatoryDirectivesForDirectivesTrait;

    protected function enabled(): bool
    {
        return parent::enabled() && !empty($this->getEntries());
    }
}
