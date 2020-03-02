<?php
namespace PoP\AccessControl\TypeResolverDecorators;

use PoP\AccessControl\ConfigurationEntries\ConfigurableAccessControlForDirectivesTrait;
use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;

trait ConfigurableAccessControlForDirectivesTypeResolverDecoratorTrait
{
    use ConfigurableAccessControlForDirectivesTrait;

    /**
     * Because the validation can be done on any directive applied to any typeResolver, then attach it to the base abstract class: AbstractTypeResolver::class
     *
     * @return array
     */
    public static function getClassesToAttachTo(): array
    {
        return [
            AbstractTypeResolver::class,
        ];
    }

    abstract protected function getMandatoryDirectives($entryValue = null): array;

    public function getMandatoryDirectivesForDirectives(TypeResolverInterface $typeResolver): array
    {
        $mandatoryDirectivesForDirectives = [];
        foreach ($this->getEntries() as $entry) {
            $directiveResolverClass = $entry[0];
            $entryValue = $entry[1]; // this might be any value (string, array, etc) or, if not defined, null
            $directiveName = $directiveResolverClass::getDirectiveName();
            $mandatoryDirectivesForDirectives[$directiveName] = $this->getMandatoryDirectives($entryValue);
        }
        return $mandatoryDirectivesForDirectives;
    }
}
