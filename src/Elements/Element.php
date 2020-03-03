<?php
namespace Ezweb\Workflow\Elements;

abstract class Element
{
    protected static \Ezweb\Workflow\Providers\Type $typeProviders;
    protected static \Ezweb\Workflow\Providers\Operator $operatorProvider;
    protected static \Ezweb\Workflow\Providers\InternalFunction $internalFunctionProvider;

    protected function __construct()
    {
        self::$typeProviders = \Ezweb\Workflow\Providers\Type::getInstance();
        self::$operatorProvider = \Ezweb\Workflow\Providers\Operator::getInstance();
        self::$internalFunctionProvider = \Ezweb\Workflow\Providers\InternalFunction::getInstance();
    }
}