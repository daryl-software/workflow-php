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


    public function getResult()
    {
        foreach ($this->values as $value) {
            if ($value !== true) {
                return false;
            }
        }
        return true;
    }
}