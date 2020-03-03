<?php

namespace Ezweb\Workflow\Types;

class Rule extends Type
{
    public static function getType(): string
    {
        return 'rule';
    }

    public function getResult()
    {
        $r = [];
        foreach ($this->values as $value) {
            $r[] = $value->getResult();
        }
        return $r;
    }
}
