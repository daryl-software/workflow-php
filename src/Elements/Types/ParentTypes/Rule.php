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
        $result = true;
        foreach ($this->values as $value) {
            // is result still valid ?
            $result = $result === $value->getResult($vars);
        }
        return $result;
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
