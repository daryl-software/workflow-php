<?php

namespace Ezweb\Workflow\Types;

class Operator extends Type
{
    public $operands;

    public static function getType(): string
    {
        return 'operator';
    }

    public static function loadFromConfig(\stdClass $config): Type
    {
        $object = new static();

        foreach ($config->operands as $operand) {
            $op = \Ezweb\Workflow\Types\Providers\TypeProvider::getInstance()->getClassFromType($operand->type);
            $op = new $op();
            $op->value = $operand->value;
            $object->operands[] = $op;
        }

        return $object;
    }
}
