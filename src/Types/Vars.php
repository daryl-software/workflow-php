<?php

namespace Ezweb\Workflow\Types;

class Vars extends Type
{
    public static function getType(): string
    {
        return 'vars';
    }

    public static function loadFromConfig(\stdClass $config): Type
    {
        $object = new static();
        $object->value = $config->value;
        return $object;
    }
}
