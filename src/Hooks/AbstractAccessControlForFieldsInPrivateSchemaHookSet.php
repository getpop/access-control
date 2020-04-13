<?php

declare(strict_types=1);

namespace PoP\AccessControl\Hooks;

use PoP\AccessControl\Environment;
use PoP\AccessControl\Schema\SchemaModes;
use PoP\AccessControl\Hooks\AbstractAccessControlForFieldsHookSet;

abstract class AbstractAccessControlForFieldsInPrivateSchemaHookSet extends AbstractAccessControlForFieldsHookSet
{
    /**
     * Indicate if this hook is enabled
     *
     * @return boolean
     */
    protected function enabled(): bool
    {
        return
            Environment::enableIndividualControlForPublicPrivateSchemaMode() ||
            Environment::usePrivateSchemaMode();
    }

    protected function getSchemaMode(): string
    {
        return SchemaModes::PRIVATE_SCHEMA_MODE;
    }
}
