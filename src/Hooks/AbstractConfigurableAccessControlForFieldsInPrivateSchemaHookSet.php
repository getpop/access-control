<?php
namespace PoP\AccessControl\Hooks;

use PoP\AccessControl\ConfigurationEntries\ConfigurableAccessControlForFieldsTrait;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\FieldResolvers\FieldResolverInterface;

abstract class AbstractConfigurableAccessControlForFieldsInPrivateSchemaHookSet extends AbstractAccessControlForFieldsInPrivateSchemaHookSet
{
    use ConfigurableAccessControlForFieldsTrait;

    protected function enabled(): bool
    {
        return parent::enabled() && !empty(static::getConfigurationEntries());
    }

    /**
     * Remove fieldName "roles" if the user is not logged in
     *
     * @param boolean $include
     * @param TypeResolverInterface $typeResolver
     * @param FieldResolverInterface $fieldResolver
     * @param string $fieldName
     * @return boolean
     */
    protected function removeFieldName(TypeResolverInterface $typeResolver, FieldResolverInterface $fieldResolver, string $fieldName): bool
    {
        // Obtain all entries for the current combination of typeResolver/fieldName
        foreach ($this->getEntries($typeResolver, $fieldName) as $entry) {
            // Obtain the 3rd value on each entry: if the validation is "in" or "out"
            $entryValue = $entry[2];
            // Let the implementation class decide if to remove the field or not
            return $this->removeFieldNameBasedOnMatchingEntryValue($entryValue);
        }
        return false;
    }

    protected function removeFieldNameBasedOnMatchingEntryValue($entryValue = nul): bool
    {
        return true;
    }
}
