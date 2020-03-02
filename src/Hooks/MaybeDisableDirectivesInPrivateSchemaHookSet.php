<?php
namespace PoP\AccessControl\Hooks;

use PoP\AccessControl\Services\AccessControlGroups;
use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\AccessControl\Hooks\AbstractMaybeDisableDirectivesInPrivateSchemaHookSet;

class MaybeDisableDirectivesInPrivateSchemaHookSet extends AbstractMaybeDisableDirectivesInPrivateSchemaHookSet
{
    protected function getConfigurationEntries(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForDirectives(AccessControlGroups::DISABLED);
    }
}
