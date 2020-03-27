<?php

namespace Ezweb\Workflow\Elements\Types\Condition\Operators;

abstract class Operator extends \Ezweb\Workflow\Elements\Types\Type

{
    /**
     * @var \Ezweb\Workflow\Elements\Types\Type[]
     */
    protected array $operands;

    /**
     * @param \Ezweb\Workflow\Elements\Types\Type $value
     * @return $this
     */
    public function addOperand(\Ezweb\Workflow\Elements\Types\Type $value)
    {
        $this->operands[] = $value;
        return $this;
    }

    public function attachNewOperand($classname)
    {
        $operand = new $classname();
        $this->addOperand($operand);
        return $operand;
    }
}
