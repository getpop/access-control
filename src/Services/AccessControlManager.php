<?php
namespace PoP\AccessControl\Services;

use PoP\AccessControl\Services\AccessControlManagerInterface;

class AccessControlManager implements AccessControlManagerInterface
{
    protected $fieldEntries = [];
    protected $directiveEntries = [];

    public function getEntriesForFields(string $group/*, string $id*/): array
    {
        return $this->fieldEntries[$group]/*[$id]*/ ?? [];
    }
    public function getEntriesForDirectives(string $group/*, string $id*/): array
    {
        return $this->directiveEntries[$group]/*[$id]*/ ?? [];
    }

    public function addEntriesForFields(string $group/*, string $id*/, array $fieldEntries): void
    {
        $this->fieldEntries[$group]/*[$id]*/ = array_merge(
            $this->fieldEntries[$group]/*[$id]*/ ?? [],
            $fieldEntries
        );
    }
    public function addEntriesForDirectives(string $group/*, string $id*/, array $directiveEntries): void
    {
        $this->directiveEntries[$group]/*[$id]*/ = array_merge(
            $this->directiveEntries[$group]/*[$id]*/ ?? [],
            $directiveEntries
        );
    }
}
