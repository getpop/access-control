<?php
namespace PoP\AccessControl\TypeResolverDecorators;

use PoP\AccessControl\DirectiveResolvers\DisableAccessDirectiveResolver;
use PoP\ComponentModel\Facades\Schema\FieldQueryInterpreterFacade;
use PoP\AccessControl\TypeResolverDecorators\AbstractPublicSchemaTypeResolverDecorator;
use PoP\AccessControl\TypeResolverDecorators\ValidateBasedOnConditionForFieldsTypeResolverDecoratorTrait;

abstract class AbstractMaybeDisableAccessForFieldsPublicSchemaTypeResolverDecorator extends AbstractPublicSchemaTypeResolverDecorator
{
    use ConfigurableAccessControlForFieldsTypeResolverDecoratorTrait;

    protected function getMandatoryDirectives($entryValue = null): array
    {
        $fieldQueryInterpreter = FieldQueryInterpreterFacade::getInstance();
        $disableAccessDirective = $fieldQueryInterpreter->getDirective(
            DisableAccessDirectiveResolver::getDirectiveName()
        );
        return [
            $disableAccessDirective,
        ];
    }
}
