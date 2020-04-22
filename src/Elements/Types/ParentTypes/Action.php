<?php

namespace Ezweb\Workflow\Elements\Types\ParentTypes;

class Action extends ParentType
{
    /**
     * @var \Ezweb\Workflow\Elements\Actions\Action
     */
    public \Ezweb\Workflow\Elements\Actions\Action $function;

    public static function getName(): string
    {
        return 'action';
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
        $className = self::$actionProvider->getClass($config->name);
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

    protected function isValid(): bool
    {
        return !empty($this->function);
    }
}
