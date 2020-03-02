<?php
namespace PoP\AccessControl\TypeResolverDecorators;

use PoP\ComponentModel\Facades\Schema\FieldQueryInterpreterFacade;
use PoP\AccessControl\DirectiveResolvers\DisableAccessDirectiveResolver;
use PoP\AccessControl\TypeResolverDecorators\AbstractConfigurableAccessControlForDirectivesInPublicSchemaTypeResolverDecorator;

abstract class AbstractMaybeDisableAccessForDirectivesPublicSchemaTypeResolverDecorator extends AbstractConfigurableAccessControlForDirectivesInPublicSchemaTypeResolverDecorator
{
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
