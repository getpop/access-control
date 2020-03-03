<?php
namespace PoP\AccessControl\TypeResolverDecorators;

use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\MandatoryDirectivesByConfiguration\TypeResolverDecorators\ConfigurableMandatoryDirectivesForFieldsTypeResolverDecoratorTrait;

trait ConfigurableAccessControlForFieldsTypeResolverDecoratorTrait
{
    use ConfigurableMandatoryDirectivesForFieldsTypeResolverDecoratorTrait;

    public function enabled(TypeResolverInterface $typeResolver): bool
    {
        return parent::enabled($typeResolver) && !empty(static::getConfigurationEntries());
    }
}
