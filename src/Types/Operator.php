<?php

namespace Ezweb\Workflow\Types;

use Ezweb\Workflow\Operators\Providers\OperatorProvider;

class Operator extends Type
{
    private string $operator;

    public static function getType(): string
    {
        return 'operator';
    }

    public static function loadFromConfig(\stdClass $config): Type
    {
        $object = new static();
        $object->operator = $config->operator;
        return $object;
    }


    public function getResult()
    {
        $operatorClass = OperatorProvider::getInstance()->getClassFromOperator($this->operator);
        $operator = new $operatorClass();
        $operator->values = $this->values;
        return $operator->getResult();
    }
}
