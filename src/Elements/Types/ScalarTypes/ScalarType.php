<?php

namespace Ezweb\Workflow\Elements\Types\ScalarTypes;

abstract class ScalarType extends \Ezweb\Workflow\Elements\Types\Type
{
    /**
     * @var mixed
     */
    protected $scalarValue;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->scalarValue;
    }

    public static function loadFromConfig(\stdClass $config): self
    {
        $instance = new static();
        if (!is_scalar($config->value) && $config->value !== null) {
            throw new \InvalidArgumentException('ScalarType must have a scalar value');
        }
        $instance->scalarValue = $config->value;
        return $instance;
    }
}
