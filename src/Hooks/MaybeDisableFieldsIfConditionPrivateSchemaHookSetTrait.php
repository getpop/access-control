<?php
namespace PoP\AccessControl\Hooks;

use PoP\AccessControl\ConfigurationEntries\ConfigurableAccessControlForFieldsTrait;

trait MaybeDisableFieldsIfConditionPrivateSchemaHookSetTrait
{
    use ConfigurableAccessControlForFieldsTrait;

    protected function enabled(): bool
    {
        return parent::enabled() && !empty(static::getConfigurationEntries());
    }
}
