<?php

declare(strict_types=1);

namespace PoP\AccessControl\ConfigurationEntries;

use PoP\AccessControl\Environment;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\FieldResolvers\FieldResolverInterface;
use PoP\MandatoryDirectivesByConfiguration\ConfigurationEntries\ConfigurableMandatoryDirectivesForFieldsTrait;

trait AccessControlConfigurableMandatoryDirectivesForFieldsTrait
{
    use ConfigurableMandatoryDirectivesForFieldsTrait {
        ConfigurableMandatoryDirectivesForFieldsTrait::getMatchingEntries as getUpstreamMatchingEntries;
    }
    use AccessControlConfigurableMandatoryDirectivesForItemsTrait;

    /**
     * Filter all the entries from the list which apply to the passed typeResolver and fieldName
     *
     * @param boolean $include
     * @param array $entryList
     * @param TypeResolverInterface $typeResolver
     * @param string $fieldName
     * @return boolean
     */
    final protected function getMatchingEntries(array $entryList, TypeResolverInterface $typeResolver, string $fieldName): array
    {
        /**
         * If enabling individual control over public/private schema modes, then we must also check
         * that this field has the required mode.
         * If the schema mode was not defined in the entry, then this field is valid if the default
         * schema mode is the same required one
         */
        if (!Environment::enableIndividualControlForPublicPrivateSchemaMode()) {
            return $this->getUpstreamMatchingEntries($entryList, $typeResolver, $fieldName);
        }
        $typeResolverClass = get_class($typeResolver);
        $individualControlSchemaMode = $this->getSchemaMode();
        $matchNullControlEntry = $this->doesSchemaModeProcessNullControlEntry();
        return array_filter(
            $entryList,
            function ($entry) use ($typeResolverClass, $fieldName, $individualControlSchemaMode, $matchNullControlEntry) {
                return
                    $entry[0] == $typeResolverClass &&
                    $entry[1] == $fieldName &&
                    (
                        $entry[3] == $individualControlSchemaMode ||
                        (
                            is_null($entry[3]) &&
                            $matchNullControlEntry
                        )
                    );
            }
        );
    }

    public function maybeFilterFieldName(bool $include, TypeResolverInterface $typeResolver, FieldResolverInterface $fieldResolver, string $fieldName): bool
    {
        /**
         * If enabling individual control, then check if there is any entry for this field and schema mode
         */
        if (Environment::enableIndividualControlForPublicPrivateSchemaMode()) {
            /**
             * If there are no entries, then exit by returning the original hook value
             */
            if (empty($this->getEntries($typeResolver, $fieldName))) {
                return $include;
            }
        }

        /**
         * The parent case deals with the general case
         */
        return parent::maybeFilterFieldName($include, $typeResolver, $fieldResolver, $fieldName);
    }
}