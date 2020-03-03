<?php

namespace Ezweb\Workflow;

use Ezweb\Workflow\InternalFunction\Providers\InternalFunctionProvider;
use Ezweb\Workflow\Operators\Equal;
use Ezweb\Workflow\Types\InternalFunction\Modulo;

class Workflow
{
    private Types\Providers\TypeProvider $typeProvider;
    private Operators\Providers\OperatorProvider $operatorProvider;
    private InternalFunctionProvider $internalFunction;

    public function init()
    {
        $this->typeProvider = Types\Providers\TypeProvider::getInstance();
        $this->typeProvider->register(Types\Rule::class);
        $this->typeProvider->register(Types\Operator::class);
        $this->typeProvider->register(Types\Condition::class);
        $this->typeProvider->register(Types\Vars::class);
        $this->typeProvider->register(Types\Value::class);
        $this->typeProvider->register(Types\InternalFunction::class);

        $this->typeProvider->register(Types\Condition\Operators\All::class);
        $this->typeProvider->register(Types\Condition\Operators\Any::class);

        $this->operatorProvider = Operators\Providers\OperatorProvider::getInstance();
        $this->operatorProvider->register(Equal::class);

        $this->internalFunction = InternalFunctionProvider::getInstance();
        $this->internalFunction->register(Modulo::class);
    }
}
