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
     * @param \stdClass $parsedData
     * @param \Ezweb\Workflow\Loader $configLoader
     * @return self
     */
    public static function createFromParser(\stdClass $parsedData, \Ezweb\Workflow\Loader $configLoader): self
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
            // Type don't have any children, directly call getResult
            if ($value instanceof self) {
                $childrenValues[] = $value->runThroughTree($vars);
            } else {
                if (!$value->isValid($vars, [])) {
                    throw new \Exception(get_class($value) . ' is not valid => ' . $value);
                }
                $childrenValues[] = $value->getResult($vars, []);
            }
        }
        if (!$this->isValid($vars, $childrenValues)) {
            throw new \Exception(get_class($this) . ' is not valid => ' . $this);
        }
        return $this->getResult($vars, $childrenValues);
    }

}
