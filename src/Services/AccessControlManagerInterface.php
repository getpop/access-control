<?php
namespace PoP\AccessControl\Services;

interface AccessControlManagerInterface
{
    public function getEntriesForFields(string $group/*, string $id*/): array;
    public function getEntriesForDirectives(string $group/*, string $id*/): array;
    public function addEntriesForFields(string $group/*, string $id*/, array $fieldEntries): void;
    public function addEntriesForDirectives(string $group/*, string $id*/, array $directiveEntries): void;
}
