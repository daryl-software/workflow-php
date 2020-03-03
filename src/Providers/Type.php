<?php

namespace Ezweb\Workflow\Providers;


class Type extends Element
{
    public static function getProviderType(): string
    {
        return \Ezweb\Workflow\Elements\Types\Type::class;
    }
}