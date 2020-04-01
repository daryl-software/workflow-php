<?php

namespace Ezweb\Workflow\Elements\Types;

abstract class Type extends \Ezweb\Workflow\Elements\Element
{

    public static function create(): self
    {
        return new static();
    }
}
