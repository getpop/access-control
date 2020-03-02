<?php
namespace PoP\AccessControl\TypeResolverDecorators;

use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;

trait ValidateBasedOnConditionForFieldsTypeResolverDecoratorTrait
{
    use ValidateConditionForFieldsTypeResolverDecoratorTrait;

    abstract protected static function getEntryList(): array;

    abstract protected function getMandatoryDirectives(): array;

    public function getMandatoryDirectivesForFields(TypeResolverInterface $typeResolver): array
    {
        $mandatoryDirectivesForFields = [];
        $entryList = static::getEntryList();
        $mandatoryDirectives = $this->getMandatoryDirectives();
        // Obtain all capabilities allowed for the current combination of typeResolver/fieldName
        foreach ($this->getFieldNames() as $fieldName) {
            if ($matchingEntries = $this->getMatchingEntriesFromConfiguration(
                $entryList,
                $typeResolver,
                $fieldName
            )) {
                if ($states = array_values(array_unique(array_map(
                    function($entry) {
                        return $entry[2];
                    },
                    $matchingEntries
                )))) {
                    if ($this->removeFieldNameBasedOnCondition($states)) {
                        $mandatoryDirectivesForFields[$fieldName] = $mandatoryDirectives;
                    }
                }
            }
        }
        return $mandatoryDirectivesForFields;
    }

    protected function removeFieldNameBasedOnCondition(array $states): bool
    {
        return true;
    }
}
