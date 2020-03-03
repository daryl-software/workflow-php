<?php

namespace Ezweb\Workflow\Types;

class InternalFunction extends Type
{
    public static function getType(): string
    {
        return 'internalFunction';
    }

    public function getResult()
    {
        // TODO: Implement getResult() method.
    }

    public static function loadFromConfig(\stdClass $config): Type
    {
        $operatorClassName = \Ezweb\Workflow\InternalFunction\Providers\InternalFunctionProvider::getInstance()->getClassFromInternalFunction($config->name);
        return new $operatorClassName();
    }
}
