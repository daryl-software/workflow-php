<?php

namespace Ezweb\Workflow\Elements\Types\ScalarTypes;

class Vars extends ScalarType
{
    public static function getName(): string
    {
        return 'vars';
    }

    public function getResult(array $vars)
    {
        if (!isset($vars[$this->scalarValue])) {
            throw new \RuntimeException('Var ' . $this->scalarValue . ' is missing');
        }
        return $vars[$this->scalarValue];
    }

}
