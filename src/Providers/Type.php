<?php
namespace Ezweb\Workflow\Providers;

class Type extends Provider
{
    public static function getProviderType(): string
    {
        return \Ezweb\Workflow\Elements\Types\Type::class;
    }
}