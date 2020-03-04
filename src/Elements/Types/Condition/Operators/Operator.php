<?php

namespace Ezweb\Workflow\Elements\Types\Condition\Operators;

abstract class Operator extends \Ezweb\Workflow\Elements\Types\Type
{
    protected array $operands;

    public function addOperand(\Ezweb\Workflow\Elements\Types\Type $value)
    {
        $this->operands[] = $value;
        return $this;
    }
}
