<?php
namespace Ezweb\Workflow\Elements\Operators;

abstract class Operator extends \Ezweb\Workflow\Elements\Element
{
    /**
     * @var array<\Ezweb\Workflow\Elements\Types\Type>
     */
    protected array $operands = [];

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

    /**
     * @param $value
     * @return \Ezweb\Workflow\Elements\Types\ScalarTypes\Scalar
     */
    public function attachNewScalar($value): \Ezweb\Workflow\Elements\Types\ScalarTypes\Scalar
    {
        $scalar = new \Ezweb\Workflow\Elements\Types\ScalarTypes\Scalar();
        $scalar->setScalarValue($value);
        $this->addOperand($scalar);
        return $scalar;
    }

    /**
     * @param $varName
     * @return \Ezweb\Workflow\Elements\Types\ScalarTypes\Vars
     */
    public function attachNewVars($varName): \Ezweb\Workflow\Elements\Types\ScalarTypes\Vars
    {
        $var = new \Ezweb\Workflow\Elements\Types\ScalarTypes\Vars();
        $var->setScalarValue($varName);
        $this->addOperand($var);
        return $var;
    }

    /**
     * @param $className
     * @return \Ezweb\Workflow\Elements\Actions\Action
     */
    public function attachNewAction($className): \Ezweb\Workflow\Elements\Actions\Action
    {
        $action = new $className();
        $this->addOperand($action);
        return $action;
    }

    public function getHash(): string
    {
        return $this->hash($this->getOperands());
    }
}
