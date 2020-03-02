<?php
namespace PoP\AccessControl\TypeResolverDecorators;

use PoP\AccessControl\Services\AccessControlGroups;
use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\AccessControl\TypeResolverDecorators\AbstractMaybeDisableAccessForDirectivesPublicSchemaTypeResolverDecorator;

class MaybeDisableAccessForDirectivesPublicSchemaTypeResolverDecorator extends AbstractMaybeDisableAccessForDirectivesPublicSchemaTypeResolverDecorator
{
    protected function getConfigurationEntries(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForDirectives(AccessControlGroups::DISABLED);
    }
}
