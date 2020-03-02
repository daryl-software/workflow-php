<?php

namespace Ezweb\Workflow\Types\Condition\Operators;

abstract class Operator extends \Ezweb\Workflow\Types\Type
{
    abstract public static function getName(): string;
}
