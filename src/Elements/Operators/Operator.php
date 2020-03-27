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
     * @return string
     */
    abstract public static function getName(): string;

    /**
     * @param mixed[] $vars
     * @return mixed
     */
    abstract public function getResult(array $vars);

    /**
     * @param \Ezweb\Workflow\Elements\Types\Type $value
     * @return $this
     */
    public function addOperand(\Ezweb\Workflow\Elements\Types\Type $value)
    {
        $this->operands[] = $value;
        return $this;
    }

    public static function create()
    {
        return new static();
    }

    public function attachNewScalar()
    {
        $scalar = new Scalar();
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
}
