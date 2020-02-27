<?php
namespace PoP\AccessControl\TypeResolverDecorators;

use PoP\AccessControl\Environment;
use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\TypeResolverDecorators\AbstractTypeResolverDecorator;

abstract class AbstractPublicSchemaTypeResolverDecorator extends AbstractTypeResolverDecorator
{
    public const HOOK_ENABLED = __CLASS__.':enabled';
    /**
     * Enable only for public schema
     *
     * @param TypeResolverInterface $typeResolver
     * @return array
     */
    public function enabled(TypeResolverInterface $typeResolver): bool
    {
        // By default, this value says: it is only enabled for the public schema.
        // However, this value can be overriden! If returning true, it will work for both public and private schemas
        // This is to allow the CacheControl to not cache the response whenever any field/directive involved in Access Control is added to the query
        // That logic relies on the NoCacheDirective being attached by the ValidateIsUserLoggedInDirective
        // Hence, ValidateIsUserLoggedInDirective must be always added, also in the private mode!
        // It will not have any influence though, since it comes after ValidateDirective, which removes the results,
        // and then ValidateIsUserLoggedInDirective has `needsIDsDataFields` => true, so it won't be executed
        // But by it being on the directive pipeline alone we can already attach the NoCacheDirective
        $hooksAPI = HooksAPIFacade::getInstance();
        return $hooksAPI->applyFilters(
            self::HOOK_ENABLED,
            !Environment::usePrivateSchemaMode()
        );
    }
}
