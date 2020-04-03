<?php
namespace Ezweb\Workflow\Providers;

class InternalFunction extends Provider
{
    public static function getProviderType(): string
    {
        return \Ezweb\Workflow\Elements\InternalFunctions\InternalFunction::class;
    }
}