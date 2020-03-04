<?php


namespace Ezweb\Workflow\Elements\Types\Condition\Operators;


class Any extends Operator
{
    public static function getName(): string
    {
        return 'any';
    }

    public function getResult(array $vars)
    {
        foreach ($this->operands as $operand) {
            if ($operand->getResult($vars) === true) {
                return true;
            }
        }
        return false;
    }
}