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
        return $vars[$this->scalarValue];
    }

}
