<?php
namespace Ezweb\Workflow\Elements;

abstract class Element
{
    protected static \Ezweb\Workflow\Providers\TypeProvider $typeProviders;
    protected static \Ezweb\Workflow\Providers\OperatorProvider $operatorProvider;
    protected static \Ezweb\Workflow\Providers\InternalFunctionProvider $internalFunctionProvider;

    protected function __construct()
    {
        self::$typeProviders = \Ezweb\Workflow\Providers\TypeProvider::getInstance();
        self::$operatorProvider = \Ezweb\Workflow\Providers\OperatorProvider::getInstance();
        self::$internalFunctionProvider = \Ezweb\Workflow\Providers\InternalFunctionProvider::getInstance();
    }
}