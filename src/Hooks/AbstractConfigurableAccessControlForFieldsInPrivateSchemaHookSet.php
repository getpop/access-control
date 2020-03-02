<?php
namespace PoP\AccessControl\Hooks;

use PoP\AccessControl\ConfigurationEntries\ConfigurableAccessControlForFieldsTrait;

abstract class AbstractConfigurableAccessControlForFieldsInPrivateSchemaHookSet extends AbstractAccessControlForFieldsInPrivateSchemaHookSet
{
    use ConfigurableAccessControlForFieldsTrait;

    protected function enabled(): bool
    {
        return parent::enabled() && !empty(static::getConfigurationEntries());
    }
}
