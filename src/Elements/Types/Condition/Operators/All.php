<?php
namespace Ezweb\Workflow\Elements\Types\Condition\Operators;

class All extends Operator
{
    public static function getName(): string
    {
        return 'all';
    }

    /**
     * @param array $vars
     * @return bool
     */
    public function getResult(array $vars)
    {
        foreach ($this->operands as $operand) {
            if ($operand->getResult($vars) !== true) {
                return false;
            }
        }
        return true;
    }
}