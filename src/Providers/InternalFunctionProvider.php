<?php

namespace Ezweb\Workflow\Providers;


class InternalFunctionProvider extends ElementProvider
{
    public static function getProviderType(): string
    {
        return \Ezweb\Workflow\Elements\InternalFunctions\InternalFunction::class;
    }
}