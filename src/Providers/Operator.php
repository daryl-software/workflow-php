<?php
namespace Ezweb\Workflow\Providers;

class Operator extends Provider
{
    public static function getProviderType(): string
    {
        return \Ezweb\Workflow\Elements\Operators\Operator::class;
    }
}