<?php

namespace Ezweb\Workflow;

class Workflow
{
    private \Ezweb\Workflow\Providers\TypeProvider $typeProvider;
    private \Ezweb\Workflow\Providers\OperatorProvider $operatorProvider;
    private \Ezweb\Workflow\Providers\InternalFunctionProvider $internalFunction;

    public function init()
    {
        // providers registrations
        $this->typeProvider = \Ezweb\Workflow\Providers\TypeProvider::getInstance();
        $this->typeProvider->register(\Ezweb\Workflow\Elements\Types\ParentTypes\Rule::class);
        $this->typeProvider->register(\Ezweb\Workflow\Elements\Types\ParentTypes\Operator::class);
        $this->typeProvider->register(\Ezweb\Workflow\Elements\Types\ParentTypes\Condition::class);
        $this->typeProvider->register(\Ezweb\Workflow\Elements\Types\ScalarTypes\Vars::class);
        $this->typeProvider->register(\Ezweb\Workflow\Elements\Types\ScalarTypes\Scalar::class);
        $this->typeProvider->register(\Ezweb\Workflow\Elements\Types\ParentTypes\InternalFunction::class);

        $this->typeProvider->register(\Ezweb\Workflow\Elements\Types\Condition\Operators\All::class);
        $this->typeProvider->register(\Ezweb\Workflow\Elements\Types\Condition\Operators\Any::class);
        $this->operatorProvider = \Ezweb\Workflow\Providers\OperatorProvider::getInstance();
        $this->operatorProvider->register(\Ezweb\Workflow\Elements\Operators\Equal::class);

        $this->internalFunction = \Ezweb\Workflow\Providers\InternalFunctionProvider::getInstance();
        $this->internalFunction->register(\Ezweb\Workflow\Elements\InternalFunctions\Modulo::class);

    }
}
