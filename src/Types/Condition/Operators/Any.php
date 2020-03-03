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

    public function getResult()
    {
        foreach ($this->values as $value) {
            if ($value === true) {
                return true;
            }
        }
        return false;
    }
}