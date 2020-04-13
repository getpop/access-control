<?php

declare(strict_types=1);

namespace PoP\AccessControl\TypeResolverDecorators;

use PoP\AccessControl\Environment;
use PoP\AccessControl\Schema\SchemaModes;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\TypeResolverDecorators\AbstractTypeResolverDecorator;

abstract class AbstractPublicSchemaTypeResolverDecorator extends AbstractTypeResolverDecorator
{
    /**
     * Enable only for public schema
     *
     * @param TypeResolverInterface $typeResolver
     * @return array
     */
    public function enabled(TypeResolverInterface $typeResolver): bool
    {
        return
            Environment::enableIndividualControlForPublicPrivateSchemaMode() ||
            !Environment::usePrivateSchemaMode();
    }

    protected function getSchemaMode(): string
    {
        return SchemaModes::PUBLIC_SCHEMA_MODE;
    }
}
