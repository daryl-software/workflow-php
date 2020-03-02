<?php


namespace Ezweb\Workflow\Types\Condition\Operators;


class Any extends Operator
{
    public static function getName(): string
    {
        return 'any';
    }


    public static function getType(): string
    {
        return 'any';
    }
}