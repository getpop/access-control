<?php
namespace PoP\AccessControl\TypeResolverDecorators;

use PoP\AccessControl\ConfigurationEntries\ConfigurableAccessControlForDirectivesTrait;
use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;

trait ValidateConditionForDirectivesTypeResolverDecoratorTrait
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
}
