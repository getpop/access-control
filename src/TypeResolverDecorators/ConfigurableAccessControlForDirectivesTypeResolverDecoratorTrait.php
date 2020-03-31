<?php
namespace PoP\AccessControl\TypeResolverDecorators;

use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;
use PoP\AccessControl\ConfigurationEntries\AccessControlConfigurableMandatoryDirectivesForDirectivesTrait;
use PoP\MandatoryDirectivesByConfiguration\TypeResolverDecorators\ConfigurableMandatoryDirectivesForDirectivesTypeResolverDecoratorTrait;

trait ConfigurableAccessControlForDirectivesTypeResolverDecoratorTrait
{
    use ConfigurableMandatoryDirectivesForDirectivesTypeResolverDecoratorTrait, AccessControlConfigurableMandatoryDirectivesForDirectivesTrait {
        AccessControlConfigurableMandatoryDirectivesForDirectivesTrait::getMatchingEntries insteadof ConfigurableMandatoryDirectivesForDirectivesTypeResolverDecoratorTrait;
    }

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
}
