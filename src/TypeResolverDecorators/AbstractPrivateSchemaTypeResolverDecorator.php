<?php
namespace PoP\AccessControl\TypeResolverDecorators;

use PoP\AccessControl\Environment;
use PoP\AccessControl\Schema\SchemaModes;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\TypeResolverDecorators\AbstractTypeResolverDecorator;

abstract class AbstractPrivateSchemaTypeResolverDecorator extends AbstractTypeResolverDecorator
{
    /**
     * Enable only for private schema
     *
     * @param TypeResolverInterface $typeResolver
     * @return array
     */
    public function enabled(TypeResolverInterface $typeResolver): bool
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
