<?php
namespace PoP\AccessControl\Hooks;

use PoP\AccessControl\Services\AccessControlGroups;
use PoP\AccessControl\Facades\AccessControlManagerFacade;
use PoP\AccessControl\Hooks\AbstractMaybeDisableFieldsIfConditionInPrivateSchemaHookSet;

class MaybeDisableFieldsPrivateSchemaHookSet extends AbstractMaybeDisableFieldsIfConditionInPrivateSchemaHookSet
{
    /**
     * Configuration entries
     *
     * @return array
     */
    protected static function getEntryList(): array
    {
        $accessControlManager = AccessControlManagerFacade::getInstance();
        return $accessControlManager->getEntriesForFields(AccessControlGroups::DISABLED);
    }
}
