<?php

namespace Ezweb\Workflow;

class Workflow implements \JsonSerializable
{

    public const BEHAVIOR_ALL_MATCHES = 'allMatches';
    public const BEHAVIOR_FIRST_MATCH = 'firstMatch';
    /**
     * Process name
     */
    private string $name;

    /**
     * Rules to execute
     * @var array<\Ezweb\Workflow\Elements\Types\ParentTypes\Rule>
     */
    private array $rules;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed[]
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
     * @return \Ezweb\Workflow\Elements\Types\ParentTypes\Rule[]
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
     * @param mixed[] $vars
     * @param string $behavior
     * @return mixed|mixed[]
     */
    public function getResult(array $vars, string $behavior)
    {
        switch ($behavior) {
            case self::BEHAVIOR_ALL_MATCHES:
                return $this->getAllMatches($vars);
            case  self::BEHAVIOR_FIRST_MATCH:
                return $this->getFirstMatch($vars);
            default:
                throw new \InvalidArgumentException('This behavior (' . $behavior . ') does not exist');
        }

    }

    /**
     * @param mixed[] $vars
     * @return mixed[]
     */
    public function getAllMatches(array $vars): array
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

    /**
     * @param mixed[] $vars
     * @return mixed|null
     */
    public function getFirstMatch(array $vars)
    {
        $rules = $this->getRules();
        foreach ($rules as $rule) {
            $result = $rule->getResult($vars);
            if ($result) {
                return $rule->getReturn();
            }
        }
        return null;
    }
}
