<?php

namespace Ezweb\Workflow\Elements\Types\ParentTypes;

class Rule extends ParentType
{
    private $return;

    public static function getName(): string
    {
        return 'rule';
    }

    public function getResult(array $vars)
    {
        $r = [];
        foreach ($this->values as $value) {
            $r[] = $value->getResult($vars);
        }
        return $r;
    }

    public static function loadFromConfig(\stdClass $config): ParentType
    {
        $instance = new static();
        $instance->return = $config->return;
        return $instance;
    }

    public function getReturn()
    {
        return $this->return;
    }
}
