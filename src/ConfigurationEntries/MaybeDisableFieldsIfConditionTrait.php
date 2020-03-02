<?php
namespace PoP\AccessControl\ConfigurationEntries;

use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;

trait MaybeDisableFieldsIfConditionTrait
{
    /**
     * Configuration entries
     *
     * @return array
     */
    abstract protected static function getConfigurationEntries(): array;

    /**
     * Field names to remove
     *
     * @return array
     */
    protected function getFieldNames(): array
    {
        return array_map(
            function($entry) {
                // The tuple has format [typeResolverClass, fieldName] or [typeResolverClass, fieldName, $role] or [typeResolverClass, fieldName, $capability]
                // So, in position [1], will always be the $fieldName
                return $entry[1];
            },
           static::getConfigurationEntries()
        );
    }

    /**
     * Configuration entries
     *
     * @return array
     */
    final protected function getEntries(TypeResolverInterface $typeResolver, string $fieldName): array
    {
        return $this->getMatchingEntries(
            static::getConfigurationEntries(),
            $typeResolver,
            $fieldName
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
    final protected function getMatchingEntries(array $entryList, TypeResolverInterface $typeResolver, string $fieldName): array
    {
        $typeResolverClass = get_class($typeResolver);
        return array_filter(
            $entryList,
            function($entry) use($typeResolverClass, $fieldName) {
                return $entry[0] == $typeResolverClass && $entry[1] == $fieldName;
            }
        );
    }
}
