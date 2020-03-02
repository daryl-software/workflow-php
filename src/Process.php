<?php

namespace Ezweb\Workflow;

use Ezweb\Workflow\Types\Rule;

class Process implements \JsonSerializable
{
    /**
     * Process name
     */
    private string $name;

    /**
     * Rules to execute
     * @var array<Types\Rule>
     */
    private array $rules;

    /**
     * @var string
     */
    private string $behavior;


    public function __construct(string $name, string $behavior)
    {
        $this->name = $name;
        $this->behavior = $behavior;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @param Rule $rules
     * @return Process
     */
    public function addRule(Rule $rules): Process
    {
        $this->rules[] = $rules;
        return $this;
    }

    /**
     * @return string
     */
    public function getBehavior(): string
    {
        return $this->behavior;
    }
}
