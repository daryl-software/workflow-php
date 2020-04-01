<?php

namespace Ezweb\Workflow\Elements\Operators;

use Ezweb\Workflow\Elements\Types\ParentTypes\InternalFunction;
use Ezweb\Workflow\Elements\Types\ScalarTypes\Scalar;
use Ezweb\Workflow\Elements\Types\ScalarTypes\Vars;

abstract class Operator extends \Ezweb\Workflow\Elements\Element
{
    /**
     * @var array<\Ezweb\Workflow\Elements\Types\Type>
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

    /**
     * @return \Ezweb\Workflow\Elements\Types\Type[]
     */
    public function getOperands(): ?array
    {
        return $this->operands;
    }

    public static function create(): self
    {
        return new static();
    }

    public function attachNewScalar($value)
    {
        $scalar = new Scalar();
        $scalar->setScalarValue($value);
        $this->addOperand($scalar);
        return $scalar;
    }

    public function attachNewVars($varName)
    {
        $var = new Vars();
        $var->setScalarValue($varName);
        $this->addOperand($var);
        return $var;
    }

    public function attachNewInternalFunction($className): InternalFunction
    {
        $internalFunction = new $className();
        $this->addOperand($internalFunction);
        return $internalFunction;
    }

    public function getHash(): string
    {
        return $this->hash($this->getOperands());
    }
}
