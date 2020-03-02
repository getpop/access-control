<?php
namespace PoP\AccessControl\ConfigurationEntries;

use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;

trait MaybeDisableDirectivesIfConditionTrait
{
    /**
     * Configuration entries
     *
     * @return array
     */
    abstract protected function getEntryList(): array;

    /**
     * Directive names to remove
     *
     * @return array
     */
    protected function getDirectiveResolverClasses(): array
    {
        return array_map(
            function($entry) {
                // The entry has format [directiveResolverClass, value]
                // So, in position [0], will always be the $directiveResolverClass
                return $entry[0];
            },
           $this->getEntryList()
        );
    }

    /**
     * Filter all the entries from the list which apply to the passed typeResolver and fieldName
     *
     * @param boolean $include
     * @param array $entryList
     * @param TypeResolverInterface $typeResolver
     * @param string $fieldName
     * @return boolean
     */
    protected function getMatchingEntriesFromConfiguration(array $entryList, ?string $state): array
    {
        if ($state) {
            return array_filter(
                $entryList,
                function($entry) use($state) {
                    return $entry[1] == $state;
                }
            );
        }
        return $entryList;
    }
}
