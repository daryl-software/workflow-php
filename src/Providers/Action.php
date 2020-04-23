<?php
namespace Ezweb\Workflow\Providers;

class Action extends Provider
{
    public static function getProviderType(): string
    {
        return \Ezweb\Workflow\Elements\Actions\Action::class;
    }
}
