<?php

namespace Ezweb\Workflow\Elements\Types\ParentTypes;

class InternalFunction extends ParentType
{
    public static function getName(): string
    {
        return 'internalFunction';
    }

    public function getResult()
    {
        // TODO: Implement getResult() method.
    }

    public static function loadFromConfig(\stdClass $config): self
    {
        $instance = new static();
        return $instance;
    }
}
