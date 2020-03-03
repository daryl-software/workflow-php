<?php

namespace Ezweb\Workflow\Providers;


class TypeProvider extends ElementProvider
{
    public static function getProviderType(): string
    {
        return \Ezweb\Workflow\Elements\Types\Type::class;
    }
}