<?php
namespace PoP\AccessControl\Hooks;

use PoP\AccessControl\ConfigurationEntries\AccessControlForFieldsTrait;

trait MaybeDisableFieldsIfConditionPrivateSchemaHookSetTrait
{
    use AccessControlForFieldsTrait;

    protected function enabled(): bool
    {
        return parent::enabled() && !empty(static::getConfigurationEntries());
    }
}
