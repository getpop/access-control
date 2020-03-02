<?php
namespace PoP\AccessControl\TypeResolverDecorators;

use PoP\ComponentModel\Facades\Schema\FieldQueryInterpreterFacade;
use PoP\AccessControl\DirectiveResolvers\DisableAccessDirectiveResolver;
use PoP\AccessControl\TypeResolverDecorators\AbstractPublicSchemaTypeResolverDecorator;
use PoP\AccessControl\TypeResolverDecorators\ValidateConditionForDirectivesTypeResolverDecoratorTrait;

abstract class AbstractMaybeDisableAccessForDirectivesPublicSchemaTypeResolverDecorator extends AbstractPublicSchemaTypeResolverDecorator
{
    use ValidateConditionForDirectivesTypeResolverDecoratorTrait;

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
