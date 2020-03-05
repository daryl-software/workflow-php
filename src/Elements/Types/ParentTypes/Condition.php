<?php

namespace Ezweb\Workflow\Elements\Types\ParentTypes;

class Condition extends ParentType
{
    protected \Ezweb\Workflow\Elements\Types\Condition\Operators\Operator $operator;

    /**
     * @inheritDoc
     */
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
        parent::addValue($value);
        $this->operator->addOperand($value);
        return $this;
    }

    /**
     * @param mixed[] $vars
     * @return bool
     */
    public function getResult(array $vars): bool
    {
        return $this->operator->getResult($vars);
    }

    /**
     * @return mixed[]
     */
    public function jsonSerialize(): array
    {
        return [
            'type' => self::getName(),
            'operator' => $this->operator::getName(),
            'value' => $this->values
        ];
    }
}
