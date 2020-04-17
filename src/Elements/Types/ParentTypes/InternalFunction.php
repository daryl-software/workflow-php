<?php

namespace Ezweb\Workflow\Elements\Types\ParentTypes;

class InternalFunction extends ParentType
{
    /**
     * @var \Ezweb\Workflow\Elements\InternalFunctions\InternalFunction
     */
    public \Ezweb\Workflow\Elements\InternalFunctions\InternalFunction $function;

    public static function getName(): string
    {
        return 'internalFunction';
    }

    protected function getResult(array $vars, array $childrenValues)
    {
        return $this->function->getResult($vars, $childrenValues);
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

    public function getJSONData(): ?array
    {
        return [
            'type' => self::getName(),
            'name' => $this->function::getName(),
            'value' => $this->function->getArgs()
        ];
    }

    public function __toString(): string
    {
        return '('.$this->function.')';
    }

    public function getValues(): array
    {
        return $this->function->getArgs();
    }
}
