<?php

namespace Ezweb\Workflow\Elements\Types\ParentTypes;

class Condition extends ParentType
{
    protected \Ezweb\Workflow\Elements\Types\Condition\Operators\Operator $operator;

    public static function getName(): string
    {
        return 'condition';
    }

    public static function loadFromConfig(\stdClass $config): self
    {
        $instance = new self();
        $operatorClassName = self::$typeProviders->getClass($config->operator);
        $instance->operator = new $operatorClassName();
        return $instance;
    }

    public function addValue(\Ezweb\Workflow\Elements\Types\Type $value): ParentType
    {
        $this->operator->addOperand($value);
        return $this;
    }

    protected function getResult(array $vars, array $childrenValues)
    {
        return $this->operator->getResult($vars, $childrenValues);
    }

    /**
     * @param $className
     * @return $this
     */
    public function setConditionOperator($className)
    {
        $this->operator = new $className();
        return $this;
    }

    /**
     * @param $className
     * @return \Ezweb\Workflow\Elements\Operators\Operator
     */
    public function attachNewOperator($className):\Ezweb\Workflow\Elements\Operators\Operator
    {
        // we need that condition operator to be set before adding element
        if ($this->operator === null) {
            throw new \Exception('A condition operator must be set before add childs');
        }

        // create a operator parent type
        $operatorType = new Operator();
        // create that operator child
        $operator = new $className();
        // set parent type operator to the created one
        $operatorType->setOperator($operator);
        // add everything to the current condition operator
        $this->operator->addOperand($operatorType);
        // return the child, in which user is interested
        return $operator;
    }

    public function getJSONData(): ?array
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

    protected function isValid(): bool
    {
        return !empty($this->getValues());
    }
}
