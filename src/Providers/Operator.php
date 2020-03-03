<?php

namespace Ezweb\Workflow\Providers;



class Operator extends Element
{
    public static function getProviderType(): string
    {
        return \Ezweb\Workflow\Elements\Operators\Operator::class;
    }
}