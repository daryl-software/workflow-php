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
        $instance = new static();
        $operatorClassName = self::$typeProviders->getClass($config->operator);
        $instance->operator = new $operatorClassName();
        return $instance;
    }


    public function getResult()
    {
        return $this->operator->getResult();
    }
}
