<?php

namespace Ezweb\Workflow\Elements\Types\ParentTypes;

abstract class ParentType extends \Ezweb\Workflow\Elements\Types\Type
{
    /**
     * @var array<\Ezweb\Workflow\Elements\Types\Type>
     */
    protected array $values;

    /**
     * @return array<\Ezweb\Workflow\Elements\Types\Type>
     */
    public function getValue(): array
    {
        return $this->values;
    }

    public function addValue(\Ezweb\Workflow\Elements\Types\Type $value): self
    {
        $this->values[] = $value;
        return $this;
    }

    public static function loadFromConfig(\stdClass $config): self
    {
        return new static();
    }
}
