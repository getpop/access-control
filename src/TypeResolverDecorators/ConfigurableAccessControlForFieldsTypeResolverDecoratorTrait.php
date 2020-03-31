<?php
namespace PoP\AccessControl\TypeResolverDecorators;

use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\AccessControl\ConfigurationEntries\AccessControlConfigurableMandatoryDirectivesForFieldsTrait;
use PoP\MandatoryDirectivesByConfiguration\TypeResolverDecorators\ConfigurableMandatoryDirectivesForFieldsTypeResolverDecoratorTrait;

trait ConfigurableAccessControlForFieldsTypeResolverDecoratorTrait
{
    use ConfigurableMandatoryDirectivesForFieldsTypeResolverDecoratorTrait, AccessControlConfigurableMandatoryDirectivesForFieldsTrait {
        AccessControlConfigurableMandatoryDirectivesForFieldsTrait::getMatchingEntries insteadof ConfigurableMandatoryDirectivesForFieldsTypeResolverDecoratorTrait;
    }

    public function enabled(TypeResolverInterface $typeResolver): bool
    {
        return parent::enabled($typeResolver) && !empty(static::getConfigurationEntries());
    }
}
