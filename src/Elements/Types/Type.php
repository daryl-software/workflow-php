<?php

namespace Ezweb\Workflow\Elements\Types;

abstract class Type extends \Ezweb\Workflow\Elements\Element
{

    /**
     * @param mixed[] $vars
     * @return mixed
     */
    abstract public function getResult(array $vars);

    public static function create(): self
    {
        return new static();
    }
}
