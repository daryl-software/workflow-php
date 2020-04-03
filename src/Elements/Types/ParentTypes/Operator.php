<?php

namespace Ezweb\Workflow\Elements\Types\ParentTypes;

class Operator extends ParentType
{
    private \Ezweb\Workflow\Elements\Operators\Operator $operator;

    public static function getName(): string
    {
        return 'operator';
    }

    public static function loadFromConfig(\stdClass $config): self
    {
        $instance = new self();
        $operatorClass = self::$operatorProvider->getClass($config->operator);
        $instance->operator = new $operatorClass();
        return $instance;
    }

    public function addValue(\Ezweb\Workflow\Elements\Types\Type $value): ParentType
    {
        $this->operator->addOperand($value);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getResult(array $vars)
    {
        return $this->operator->getResult($vars);
    }

    /**
     * @param \Ezweb\Workflow\Elements\Operators\Operator $operator
     * @return Operator
     */
    public function setOperator(\Ezweb\Workflow\Elements\Operators\Operator $operator): Operator
    {
        $this->operator = $operator;
        return $this;
    }

    /**
     * @return mixed[]
     */
    public function getJSONData(): array
    {
        return [
            'type' => self::getName(),
            'operator' => $this->operator::getName(),
            'value' => $this->operator->getOperands()
        ];
    }

    public function __toString(): string
    {
        return (string) $this->operator;
    }

    public function getValues(): array
    {
        return $this->operator->getOperands();
    }
}
