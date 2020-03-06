<?php

namespace Ezweb\Workflow\Elements\Types\ParentTypes;

class InternalFunction extends ParentType
{
    public \Ezweb\Workflow\Elements\InternalFunctions\InternalFunction $function;

    public static function getName(): string
    {
        return 'internalFunction';
    }

    /**
     * @param mixed[] $vars
     * @return mixed
     */
    public function getResult(array $vars)
    {
        return $this->function->getResult($vars);
    }

    public function addValue(\Ezweb\Workflow\Elements\Types\Type $value): ParentType
    {
        parent::addValue($value);
        $this->function->addArgs($value);
        return $this;
    }

    public static function loadFromConfig(\stdClass $config): self
    {
        $instance = new self();
        $className = self::$internalFunctionProvider->getClass($config->name);
        $instance->function = new $className();
        return $instance;
    }

    /**
     * @return mixed[]
     */
    public function jsonSerialize(): array
    {
        return [
            'type' => self::getName(),
            'name' => $this->function::getName(),
            'value' => $this->function->jsonSerialize()
        ];
    }

    public function __toString()
    {
        return '('.implode(' ' . $this->function . ' ', $this->values).')';
    }
}
