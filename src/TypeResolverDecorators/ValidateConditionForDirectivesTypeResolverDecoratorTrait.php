<?php
namespace PoP\AccessControl\TypeResolverDecorators;

use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\AccessControl\ConfigurationEntries\MaybeDisableDirectivesIfConditionTrait;
use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;

trait ValidateConditionForDirectivesTypeResolverDecoratorTrait
{
    use MaybeDisableDirectivesIfConditionTrait;

    public function enabled(TypeResolverInterface $typeResolver): bool
    {
        return parent::enabled($typeResolver) && !empty($this->getEntryList());
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
