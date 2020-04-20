<?php

namespace Ezweb\Workflow\Elements\Types\ParentTypes;

abstract class ParentType extends \Ezweb\Workflow\Elements\Types\Type
{
    /**
     * @var array<\Ezweb\Workflow\Elements\Types\Type>
     */
    protected array $values = [];

    /**
     * @return \Ezweb\Workflow\Elements\Types\Type|ParentType[]
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

    final protected function runThroughTree($vars)
    {
        $childrenValues = [];
        $values = $this->getValues();
        foreach ($values as $value) {
            if (!$value->isValid()) {
                throw new \Exception(static::class . ' is not valid => ' . $value);
            }
            // Type don't have any children, directly call getResult
            if ($value instanceof self) {
                $childrenValues[] = $value->runThroughTree($vars);
            } else {
                $childrenValues[] = $value->getResult($vars, []);
            }
        }
        return $this->getResult($vars, $childrenValues);
    }
}
