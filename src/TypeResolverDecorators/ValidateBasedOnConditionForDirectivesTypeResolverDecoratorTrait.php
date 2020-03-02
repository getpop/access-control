<?php
namespace PoP\AccessControl\TypeResolverDecorators;

use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;

trait ValidateBasedOnConditionForDirectivesTypeResolverDecoratorTrait
{
    use ValidateConditionForDirectivesTypeResolverDecoratorTrait;

    abstract protected function getMandatoryDirectives(): array;

    public function getMandatoryDirectivesForDirectives(TypeResolverInterface $typeResolver): array
    {
        $mandatoryDirectivesForDirectives = [];
        $entryList = static::getEntryList();

        if ($matchingEntries = $this->getMatchingEntries(
            $entryList,
            $this->getRequiredEntryValue()
        )) {
            $directiveResolverClasses = array_values(array_unique(array_map(
                function($entry) {
                    return $entry[0];
                },
                $matchingEntries
            )));
            foreach ($directiveResolverClasses as $directiveResolverClass) {
                $directiveName = $directiveResolverClass::getDirectiveName();
                $mandatoryDirectivesForDirectives[$directiveName] = $this->getMandatoryDirectives();
            }
        }
        return $mandatoryDirectivesForDirectives;
    }
}
