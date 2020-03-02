<?php


namespace Ezweb\Workflow\Types\Condition\Operators;


class All extends Operator
{
    public static function getName(): string
    {
        return 'all';
    }

    public static function getType(): string
    {
        return 'all';
    }
}