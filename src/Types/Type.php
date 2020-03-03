<?php

namespace Ezweb\Workflow\Types;

abstract class Type
{
    /**
     * @var array<Type>
     */
    protected array $values;

    abstract public static function getType(): string;

    abstract public function getResult();

    /**
     * @return array<Type>
     */
    public function getValue(): array
    {
        return $this->values;
    }

    public function addValue(Type $value): Type
    {
        $this->values[] = $value;
        return $this;
    }

    public static function loadFromConfig(\stdClass $config): self
    {
        return new static();
    }
}
