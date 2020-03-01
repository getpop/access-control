<?php
namespace PoP\AccessControl\Hooks;

use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\FieldResolvers\FieldResolverInterface;

abstract class AbstractMaybeDisableFieldsIfConditionInPrivateSchemaHookSet extends AbstractMaybeDisableFieldsInPrivateSchemaHookSet
{
    use MaybeDisableFieldsIfConditionPrivateSchemaHookSetTrait;

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
        if ($matchingEntries = $this->getMatchingEntriesFromConfiguration(
            static::getEntryList(),
            $typeResolver,
            $fieldName
        )) {
            // Obtain the 3rd value on each entry: if the validation is "in" or "out"
            $configuredEntryStates = array_values(array_unique(array_map(
                function($entry) {
                    return $entry[2];
                },
                $matchingEntries
            )));
            // Let the implementation class decide if to remove the field or not
            return $this->removeFieldNameBasedOnCondition($configuredEntryStates);
        }
        return false;
    }

    protected function removeFieldNameBasedOnCondition(array $configuredEntryStates): bool
    {
        return true;
    }
}
