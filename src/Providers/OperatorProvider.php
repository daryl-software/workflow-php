<?php

namespace Ezweb\Workflow\Providers;



class OperatorProvider extends ElementProvider
{
    public static function getProviderType(): string
    {
        return \Ezweb\Workflow\Elements\Operators\Operator::class;
    }
}