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

    /**
     * @param mixed $scalarValue
     * @return ScalarType
     */
    public function setScalarValue($scalarValue)
    {
        $this->scalarValue = $scalarValue;
        return $this;
    }

    /**
     * @param \stdClass $config
     * @return static
     */
    public static function createFromParser(\stdClass $config, \Ezweb\Workflow\Loader $configLoader): self
    {
        $instance = new static();
        if ((!is_scalar($config->value) || is_array($config->value)) && $config->value !== null) {
            throw new \InvalidArgumentException('ScalarType must have a scalar value');
        }
        $instance->scalarValue = $config->value;
        return $instance;
    }

    public function getHash(): string
    {
        return md5(json_encode($this->getJSONData()));
    }
}
