<?php

namespace Ezweb\Workflow;

use Ezweb\Workflow\Operators\Equal;

class Workflow
{
    private Types\Providers\TypeProvider $typeProvider;
    private Operators\Providers\OperatorProvider $operatorProvider;

    public function init()
    {
        $this->typeProvider = Types\Providers\TypeProvider::getInstance();
        $this->typeProvider->register(Types\Rule::class);
        $this->typeProvider->register(Types\Operator::class);
        $this->typeProvider->register(Types\Condition::class);
        $this->typeProvider->register(Types\Vars::class);
        $this->typeProvider->register(Types\Value::class);

        $this->typeProvider->register(Types\Condition\Operators\All::class);
        $this->typeProvider->register(Types\Condition\Operators\Any::class);

        $this->operatorProvider = Operators\Providers\OperatorProvider::getInstance();
        $this->operatorProvider->register(Equal::class);
    }
}
