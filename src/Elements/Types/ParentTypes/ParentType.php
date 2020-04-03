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

    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @param \Ezweb\Workflow\Elements\Types\Type $value
     * @return $this
     */
    public function addValue(\Ezweb\Workflow\Elements\Types\Type $value): self
    {
        $this->values[] = $value;
        return $this;
    }

    /**
     * @param \stdClass $config
     * @return self
     */
    public static function loadFromConfig(\stdClass $config): self
    {
        return new static();
    }

    public function getHash(): string
    {
        return $this->hash($this->getValues());
    }
}
