<?php
namespace PoP\AccessControl\TypeResolverDecorators;

use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\AccessControl\ConfigurationEntries\ConfigurableAccessControlForFieldsTrait;

trait ValidateConditionForFieldsTypeResolverDecoratorTrait
{
    use ConfigurableAccessControlForFieldsTrait;

    public function enabled(TypeResolverInterface $typeResolver): bool
    {
        return parent::enabled($typeResolver) && !empty(static::getConfigurationEntries());
    }

    public static function getClassesToAttachTo(): array
    {
        return array_map(
            function($entry) {
                // The tuple has format [typeResolverClass, fieldName] or [typeResolverClass, fieldName, $role] or [typeResolverClass, fieldName, $capability]
                // So, in position [0], will always be the $typeResolverClass
                return $entry[0];
            },
            static::getConfigurationEntries()
        );
    }
}
