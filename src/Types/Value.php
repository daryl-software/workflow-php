<?php

namespace Ezweb\Workflow\Types;

class Value extends Type
{
    public $value;

    public static function getType(): string
    {
        return 'value';
    }

    public static function loadFromConfig(\stdClass $config): Type
    {
        $object = new static();
        $object->value = $config->value;
        dump($config);
        return $object;
    }
}
