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
        foreach ($this->getEntries() as $entry) {
            $directiveResolverClass = $entry[0];
            $directiveName = $directiveResolverClass::getDirectiveName();
            $mandatoryDirectivesForDirectives[$directiveName] = $this->getMandatoryDirectives();
        }
        return $mandatoryDirectivesForDirectives;
    }
}
