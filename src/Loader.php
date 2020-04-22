<?php

namespace Ezweb\Workflow;

class Loader
{
    public static function load(): void
    {
        self::loadProviders();
    }

    private static function loadProviders(): void
    {
        // providers registrations
        $typeProviders = \Ezweb\Workflow\Providers\Type::getInstance();
        $typeProviders->register(\Ezweb\Workflow\Elements\Types\ParentTypes\Rule::class);
        $typeProviders->register(\Ezweb\Workflow\Elements\Types\ParentTypes\Operator::class);
        $typeProviders->register(\Ezweb\Workflow\Elements\Types\ParentTypes\Condition::class);
        $typeProviders->register(\Ezweb\Workflow\Elements\Types\ParentTypes\Action::class);
        $typeProviders->register(\Ezweb\Workflow\Elements\Types\ScalarTypes\Vars::class);
        $typeProviders->register(\Ezweb\Workflow\Elements\Types\ScalarTypes\Scalar::class);
        $typeProviders->register(\Ezweb\Workflow\Elements\Types\Condition\Operators\All::class);
        $typeProviders->register(\Ezweb\Workflow\Elements\Types\Condition\Operators\Any::class);

        $operatorProvider = \Ezweb\Workflow\Providers\Operator::getInstance();
        $operatorProvider->register(\Ezweb\Workflow\Elements\Operators\Equal::class);
        $operatorProvider->register(\Ezweb\Workflow\Elements\Operators\Not::class);
        $operatorProvider->register(\Ezweb\Workflow\Elements\Operators\Greater::class);
        $operatorProvider->register(\Ezweb\Workflow\Elements\Operators\GreaterOrEqual::class);
        $operatorProvider->register(\Ezweb\Workflow\Elements\Operators\LessThan::class);
        $operatorProvider->register(\Ezweb\Workflow\Elements\Operators\LessOrEqual::class);

        $actionProvider = \Ezweb\Workflow\Providers\Action::getInstance();
        $actionProvider->register(\Ezweb\Workflow\Elements\Actions\Arithmetics\Modulo::class);
        $actionProvider->register(\Ezweb\Workflow\Elements\Actions\Arithmetics\Divide::class);
        $actionProvider->register(\Ezweb\Workflow\Elements\Actions\Arithmetics\Minus::class);
        $actionProvider->register(\Ezweb\Workflow\Elements\Actions\Arithmetics\Plus::class);
        $actionProvider->register(\Ezweb\Workflow\Elements\Actions\Arithmetics\Pow::class);
        $actionProvider->register(\Ezweb\Workflow\Elements\Actions\Arithmetics\Times::class);
    }
}
