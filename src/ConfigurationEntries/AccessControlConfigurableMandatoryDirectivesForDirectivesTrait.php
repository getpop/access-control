<?php
namespace PoP\AccessControl\ConfigurationEntries;

use PoP\AccessControl\Environment;
use PoP\AccessControl\Schema\SchemaModes;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\DirectiveResolvers\DirectiveResolverInterface;
use PoP\MandatoryDirectivesByConfiguration\ConfigurationEntries\ConfigurableMandatoryDirectivesForDirectivesTrait;

trait AccessControlConfigurableMandatoryDirectivesForDirectivesTrait
{
    use ConfigurableMandatoryDirectivesForDirectivesTrait {
        ConfigurableMandatoryDirectivesForDirectivesTrait::getMatchingEntries as getUpstreamMatchingEntries;
    }
    use AccessControlConfigurableMandatoryDirectivesForItemsTrait;

    /**
     * Filter all the entries from the list which apply to the passed typeResolver and fieldName
     *
     * @param array $entryList
     * @param string|null $value
     * @return array
     */
    final protected function getMatchingEntries(array $entryList, ?string $value): array
    {
        /**
         * If enabling individual control over public/private schema modes, then we must also check
         * that this field has the required mode.
         * If the schema mode was not defined in the entry, then this field is valid if the default
         * schema mode is the same required one
         */
        if (!Environment::enableIndividualControlForPublicPrivateSchemaMode()) {
            return $this->getUpstreamMatchingEntries($entryList, $value);
        }
        if ($value) {
            $individualControlSchemaMode = $this->getSchemaMode();
            $matchNullControlEntry = $this->doesSchemaModeProcessNullControlEntry();
            return array_filter(
                $entryList,
                function($entry) use($value, $individualControlSchemaMode, $matchNullControlEntry) {
                    return $entry[1] == $value &&
                    (
                        $entry[2] == $individualControlSchemaMode ||
                        (
                            is_null($entry[2]) &&
                            $matchNullControlEntry
                        )
                    );
                }
            );
        }
        return $entryList;
    }

    public function maybeFilterDirectiveName(bool $include, TypeResolverInterface $typeResolver, DirectiveResolverInterface $directiveResolver, string $directiveName): bool
    {
        /**
         * If not enabling individual control, then the parent case already deals with the general case
         */
        if (!Environment::enableIndividualControlForPublicPrivateSchemaMode()) {
            return parent::maybeFilterDirectiveName($include, $typeResolver, $directiveResolver, $directiveName);
        }

        /**
         * On the entries we will resolve either the class of the directive resolver, or any of its ancestors
         * If there is any entry for this directive resolver, after filtering, then enable it
         * Otherwise, exit by returning the original hook value
         */
        $ancestorDirectiveResolverClasses = [];
        $directiveResolverClass = get_class($directiveResolver);
        do {
            $ancestorDirectiveResolverClasses[] = $directiveResolverClass;
            $directiveResolverClass = get_parent_class($directiveResolverClass);
        } while ($directiveResolverClass != null);
        $entries = $this->getEntries();
        foreach ($entries as $entry) {
            /**
             * If there is any entry for this directive, then continue the normal execution: that of the parent
             */
            if (in_array($entry[0], $ancestorDirectiveResolverClasses)) {
                return parent::maybeFilterDirectiveName($include, $typeResolver, $directiveResolver, $directiveName);
            }
        }
        /**
         * If there are no entries, then exit
         */
        return $include;
    }
}
