<?php
namespace PoP\AccessControl\TypeResolverDecorators;

use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;

trait ValidateBasedOnConditionForFieldsTypeResolverDecoratorTrait
{
    use ValidateConditionForFieldsTypeResolverDecoratorTrait;

    abstract protected function getMandatoryDirectives(): array;

    public function getMandatoryDirectivesForFields(TypeResolverInterface $typeResolver): array
    {
        $mandatoryDirectivesForFields = [];
        $mandatoryDirectives = $this->getMandatoryDirectives();
        // Obtain all capabilities allowed for the current combination of typeResolver/fieldName
        foreach ($this->getFieldNames() as $fieldName) {
            if ($matchingEntries = $this->getEntries(
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
