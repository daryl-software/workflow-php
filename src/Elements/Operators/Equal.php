<?php


namespace Ezweb\Workflow\Elements\Operators;


class Equal extends Operator
{
    public static function getName(): string
    {
        return 'equal';
    }

    public function getResult(array $vars)
    {
        if (empty($this->operands)) {
            throw new \RuntimeException('No operands');
        }
        // get first element to initialize value to check
        $valueToBeEquals = $this->operands[0]->getResult($vars);
        // first iteration will be always true, due to upper line
        foreach ($this->operands as $iterationNumber => $operand) {
            if ($valueToBeEquals != $operand->getResult($vars)) {
                return false;
            }
        }
        return true;
    }
}