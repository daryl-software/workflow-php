<?php

namespace Ezweb\Workflow;

class Loader
{
    private ?\Ezweb\Workflow\Providers\Type $typeProviderConfig = null;
    private ?\Ezweb\Workflow\Providers\Operator $operatorProviderConfig = null;
    private ?\Ezweb\Workflow\Providers\Action $actionProviderConfig = null;

    // private static $savedInstance;

    public function getTypeProviderConfig(): \Ezweb\Workflow\Providers\Type
    {
        if ($this->typeProviderConfig) {
            return $this->typeProviderConfig;
        }

        $typeProviders = new \Ezweb\Workflow\Providers\Type();
        $typeProviders->register(\Ezweb\Workflow\Elements\Types\ParentTypes\Rule::class);
        $typeProviders->register(\Ezweb\Workflow\Elements\Types\ParentTypes\Operator::class);
        $typeProviders->register(\Ezweb\Workflow\Elements\Types\ParentTypes\Condition::class);
        $typeProviders->register(\Ezweb\Workflow\Elements\Types\ParentTypes\Action::class);
        $typeProviders->register(\Ezweb\Workflow\Elements\Types\ScalarTypes\Vars::class);
        $typeProviders->register(\Ezweb\Workflow\Elements\Types\ScalarTypes\Scalar::class);
        $typeProviders->register(\Ezweb\Workflow\Elements\Types\Condition\Operators\All::class);
        $typeProviders->register(\Ezweb\Workflow\Elements\Types\Condition\Operators\Any::class);
        $this->typeProviderConfig = $typeProviders;

        return $this->typeProviderConfig;
    }

    public function setTypeProviderConfig(\Ezweb\Workflow\Providers\Type $typeProviderConfig): void
    {
        $this->typeProviderConfig = $typeProviderConfig;
    }

    public function getOperatorProviderConfig(): \Ezweb\Workflow\Providers\Operator
    {
        if ($this->operatorProviderConfig) {
            return $this->operatorProviderConfig;
        }

        $operatorProvider = new \Ezweb\Workflow\Providers\Operator();
        $operatorProvider->register(\Ezweb\Workflow\Elements\Operators\Equal::class);
        $operatorProvider->register(\Ezweb\Workflow\Elements\Operators\Not::class);
        $operatorProvider->register(\Ezweb\Workflow\Elements\Operators\Greater::class);
        $operatorProvider->register(\Ezweb\Workflow\Elements\Operators\GreaterOrEqual::class);
        $operatorProvider->register(\Ezweb\Workflow\Elements\Operators\Less::class);
        $operatorProvider->register(\Ezweb\Workflow\Elements\Operators\LessOrEqual::class);
        $this->operatorProviderConfig = $operatorProvider;

        return $this->operatorProviderConfig;
    }

    public function setOperatorProviderConfig(\Ezweb\Workflow\Providers\Operator $operatorProviderConfig)
    {
        $this->operatorProviderConfig = $operatorProviderConfig;
    }

    public function getActionProviderConfig()
    {
        if ($this->actionProviderConfig) {
            return $this->actionProviderConfig;
        }

        $actionProvider = new \Ezweb\Workflow\Providers\Action();
        $actionProvider->register(\Ezweb\Workflow\Elements\Actions\Arithmetics\Modulo::class);
        $actionProvider->register(\Ezweb\Workflow\Elements\Actions\Arithmetics\Divide::class);
        $actionProvider->register(\Ezweb\Workflow\Elements\Actions\Arithmetics\Minus::class);
        $actionProvider->register(\Ezweb\Workflow\Elements\Actions\Arithmetics\Plus::class);
        $actionProvider->register(\Ezweb\Workflow\Elements\Actions\Arithmetics\Pow::class);
        $actionProvider->register(\Ezweb\Workflow\Elements\Actions\Arithmetics\Times::class);
        $this->actionProviderConfig = $actionProvider;
        return $this->actionProviderConfig;
    }

    public function setActionProviderConfig(\Ezweb\Workflow\Providers\Action $actionProviderConfig)
    {
        $this->actionProviderConfig = $actionProviderConfig;
    }

    // public function saveConfig()
    // {
    //     self::savedInstance = $this;
    // }
}
