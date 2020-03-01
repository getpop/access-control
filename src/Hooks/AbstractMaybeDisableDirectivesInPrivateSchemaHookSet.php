<?php
namespace PoP\AccessControl\Hooks;

use PoP\AccessControl\Hooks\AbstractMaybeDisableDirectivesHookSet;

abstract class AbstractMaybeDisableDirectivesInPrivateSchemaHookSet extends AbstractMaybeDisableDirectivesHookSet
{
    use MaybeDisableDirectivesInPrivateSchemaHookSetTrait;
}
