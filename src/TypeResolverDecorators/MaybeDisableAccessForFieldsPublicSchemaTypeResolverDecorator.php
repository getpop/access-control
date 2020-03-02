<?php
namespace PoP\AccessControl\TypeResolverDecorators;

use PoP\AccessControl\Services\AccessControlGroups;
use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\AccessControl\TypeResolverDecorators\AbstractMaybeDisableAccessForFieldsPublicSchemaTypeResolverDecorator;

class MaybeDisableAccessForFieldsPublicSchemaTypeResolverDecorator extends AbstractMaybeDisableAccessForFieldsPublicSchemaTypeResolverDecorator
{
    protected static function getEntryList(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForFields(AccessControlGroups::DISABLED);
    }
}
