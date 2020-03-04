<?php


namespace Ezweb\Workflow\Elements\Operators;


abstract class Operator extends \Ezweb\Workflow\Elements\Element
{
    /**
     * @var array<\Ezweb\Workflow\Elements\Types\Type>
     */
    protected array $operands;

    abstract public static function getName(): string;
    abstract public function getResult(array $vars);

    public function addOperand(\Ezweb\Workflow\Elements\Types\Type $value)
    {
        $this->operands[] = $value;
        return $this;
    }
}