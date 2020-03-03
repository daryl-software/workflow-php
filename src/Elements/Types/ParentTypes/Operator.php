<?php

namespace Ezweb\Workflow\Elements\Types\ParentTypes;

class Operator extends ParentType
{
    private string $operator;

    public static function getName(): string
    {
        return 'operator';
    }

    public static function loadFromConfig(\stdClass $config): self
    {
        $instance = new static();
        $instance->operator = $config->operator;
        return $instance;
    }


    public function getResult()
    {
        $operatorClass = self::$operatorProvider->getClass($this->operator);
        $operator = new $operatorClass();
        $operator->values = $this->values;
        return $operator->getResult();
    }
}
