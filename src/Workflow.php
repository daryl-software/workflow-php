<?php

namespace Ezweb\Workflow;

class Workflow implements \JsonSerializable
{
    /**
     * Process name
     */
    private string $name;

    /**
     * Rules to execute
     * @var array<\Ezweb\Workflow\Elements\Types\ParentTypes\Rule>
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
     * @return array<\Ezweb\Workflow\Elements\Types\ParentTypes\Rule>
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @param \Ezweb\Workflow\Elements\Types\ParentTypes\Rule $rules
     * @return self
     */
    public function addRule(\Ezweb\Workflow\Elements\Types\ParentTypes\Rule $rules): self
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

    /**
     * @param array $vars
     * @return array
     */
    public function getResult(array $vars): array
    {
        $rules = $this->getRules();
        $results = [];
        foreach ($rules as $rule) {
            $result = $rule->getResult($vars);
            if ($result) {
                $results[] = $rule->getReturn();
            }
        }
        return $results;
    }
}
