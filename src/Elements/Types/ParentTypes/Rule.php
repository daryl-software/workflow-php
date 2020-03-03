<?php

namespace Ezweb\Workflow\Elements\Types\ParentTypes;

class Rule extends ParentType
{
    public static function getName(): string
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
