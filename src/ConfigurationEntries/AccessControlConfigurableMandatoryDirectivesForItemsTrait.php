<?php

declare(strict_types=1);

namespace PoP\AccessControl\ConfigurationEntries;

use PoP\AccessControl\Environment;
use PoP\AccessControl\Schema\SchemaModes;

trait AccessControlConfigurableMandatoryDirectivesForItemsTrait
{
    /**
     * Indicates if the entry having no schema mode set must also be processed
     * To decide, it gets the default schema mode and checks its the same with
     * the one from this object
     *
     * @return bool
     */
    protected function doesSchemaModeProcessNullControlEntry(): bool
    {
        $individualControlSchemaMode = $this->getSchemaMode();
        return
            (Environment::usePrivateSchemaMode() && $individualControlSchemaMode == SchemaModes::PRIVATE_SCHEMA_MODE) ||
            (!Environment::usePrivateSchemaMode() && $individualControlSchemaMode == SchemaModes::PUBLIC_SCHEMA_MODE);
    }

    abstract protected function getSchemaMode(): string;
}
