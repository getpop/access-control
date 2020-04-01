<?php
namespace PoP\AccessControl\Hooks;

use PoP\MandatoryDirectivesByConfiguration\ConfigurationEntries\ConfigurableMandatoryDirectivesForDirectivesTrait;
use PoP\AccessControl\ConfigurationEntries\AccessControlConfigurableMandatoryDirectivesForDirectivesTrait;

abstract class AbstractConfigurableAccessControlForDirectivesInPrivateSchemaHookSet extends AbstractAccessControlForDirectivesInPrivateSchemaHookSet
{
    use ConfigurableMandatoryDirectivesForDirectivesTrait, AccessControlConfigurableMandatoryDirectivesForDirectivesTrait {
        AccessControlConfigurableMandatoryDirectivesForDirectivesTrait::getMatchingEntries insteadof ConfigurableMandatoryDirectivesForDirectivesTrait;
        AccessControlConfigurableMandatoryDirectivesForDirectivesTrait::getEntries insteadof ConfigurableMandatoryDirectivesForDirectivesTrait;
    }

    protected function enabled(): bool
    {
        return parent::enabled() && !empty($this->getEntries());
    }
}
