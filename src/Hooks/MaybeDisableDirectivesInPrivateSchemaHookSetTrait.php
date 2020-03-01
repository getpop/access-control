<?php
namespace PoP\AccessControl\Hooks;

use PoP\AccessControl\Environment;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;

trait MaybeDisableDirectivesInPrivateSchemaHookSetTrait
{
    protected function enabled(): bool
    {
        return Environment::usePrivateSchemaMode() && !empty($this->getMatchingEntries());
    }

    /**
     * Configuration entries
     *
     * @return array
     */
    protected function getMatchingEntries(): array
    {
        $entryList = $this->getEntryList();
        if ($requiredEntryValue = $this->getRequiredEntryValue()) {
            return $this->getMatchingEntriesFromConfiguration(
                $entryList,
                $requiredEntryValue
            );
        }
        return $entryList;
    }

    /**
     * Configuration entries
     *
     * @return array
     */
    abstract protected function getEntryList(): array;

    /**
     * The value in the 2nd element from the entry
     *
     * @return string
     */
    protected function getRequiredEntryValue(): ?string
    {
        return null;
    }

    /**
     * Remove directiveName "translate" if the user is not logged in
     *
     * @param boolean $include
     * @param TypeResolverInterface $typeResolver
     * @param string $directiveName
     * @return boolean
     */
    protected function getDirectiveResolverClasses(): array
    {
        // Obtain all entries for the current combination of typeResolver/fieldName
        return array_values(array_unique(array_map(
            function($entry) {
                return $entry[0];
            },
            $this->getMatchingEntries()
        )));
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
    protected function getMatchingEntriesFromConfiguration(array $entryList, string $value): array
    {
        return array_filter(
            $entryList,
            function($entry) use($value) {
                return $entry[1] == $value;
            }
        );
    }
}
