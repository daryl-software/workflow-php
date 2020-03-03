<?php


namespace Ezweb\Workflow\Operators;


class Equal extends Operator
{
    public static function getOperator(): string
    {
        return 'equal';
    }

    public function getResult()
    {
        foreach ($this->values as $value) {
            
        }
    }
}