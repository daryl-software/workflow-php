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
    public function getJSONData(): array
    {
        return [
            'type' => self::getName(),
            'name' => $this->function::getName(),
            'value' => $this->function->getJSONData()
        ];
    }

    public function __toString()
    {
        return '('.$this->function.')';
    }

    public function getValues(): array
    {
        return $this->function->getArgs();
    }
}
