<?php

namespace Ezweb\Workflow\Types\InternalFunction;

class Modulo extends InternalFunction
{

    public static function getType(): string
    {
        return 'modulo';
    }

    public function getResult()
    {
        $args = func_get_args();
        return $args[0] % $args[1];
    }

    public static function getName(): string
    {
        return 'modulo';
    }
}