<?php

namespace Ezweb\Workflow\Elements\Types\ScalarTypes;

class Scalar extends ScalarType
{
    public $scalarValue;

    public static function getName(): string
    {
        return 'scalar';
    }

    public function getResult(array $vars)
    {
        return $this->scalarValue;
    }
}
