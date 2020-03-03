<?php

namespace Ezweb\Workflow\Types;

class Condition extends Type
{
    protected Condition\Operators\Operator $operator;

    public static function getType(): string
    {
        return 'condition';
    }

    public static function loadFromConfig(\stdClass $config): Type
    {
        $object = parent::loadFromConfig($config);
        $operatorClassName = \Ezweb\Workflow\Types\Providers\TypeProvider::getInstance()->getClassFromType($config->operator);
        $object->operator = new $operatorClassName();
        return $object;
    }


    public function getResult()
    {
        return $this->operator->getResult();
    }
}
