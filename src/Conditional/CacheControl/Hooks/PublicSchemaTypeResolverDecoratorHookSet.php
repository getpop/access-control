<?php
namespace PoP\AccessControl\Conditional\CacheControl\Hooks;

use PoP\AccessControl\TypeResolverDecorators\AbstractPublicSchemaTypeResolverDecorator;
use PoP\Engine\Hooks\AbstractHookSet;

class PublicSchemaTypeResolverDecoratorHookSet extends AbstractHookSet
{
    protected function init()
    {
        // Enable for both Public and Private schemas
        // This is to allow the CacheControl to not cache the response whenever any field/directive involved in Access Control is added to the query
        // That logic relies on the NoCacheDirective being attached by the ValidateIsUserLoggedInDirective
        // Hence, ValidateIsUserLoggedInDirective must be always added, also in the private mode!
        // It will not have any influence though, since it comes after ValidateDirective, which removes the results,
        // and then ValidateIsUserLoggedInDirective has `needsIDsDataFields` => true, so it won't be executed
        // But by it being on the directive pipeline alone we can already attach the NoCacheDirective
        $this->hooksAPI->addFilter(
            AbstractPublicSchemaTypeResolverDecorator::HOOK_ENABLED,
            function() {
                return true;
            }
        );
    }
}
