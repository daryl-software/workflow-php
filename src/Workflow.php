<?php

namespace Ezweb\Workflow;

class Workflow implements \JsonSerializable
{
    public const BEHAVIOR_ALL_MATCHES = 'allMatches';
    public const BEHAVIOR_FIRST_MATCH = 'firstMatch';
    public const STRING_SEPARATOR = '|';

    /**
     * Process name
     */
    private string $name;

    /**
     * Rules to execute
     * @var array<\Ezweb\Workflow\Elements\Types\ParentTypes\Rule>
     */
    private array $rules = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed[]
     */
    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'value' => $this->rules
        ];
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

    /**
     * Convert to json
     * @param int $flags Json constant flag
     * @return false|string
     */
    public function toJson(int $flags = 0)
    {
        return json_encode($this, $flags);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return implode(self::STRING_SEPARATOR, $this->getRules());
    }

    /**
     * @return Elements\Types\ParentTypes\Rule
     */
    public function attachNewRule() {
        $rule = \Ezweb\Workflow\Elements\Types\ParentTypes\Rule::create();
        $this->addRule($rule);
        return $rule;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        $hashes = [];
        $rules = $this->getRules();
        foreach ($rules as $rule) {
            $hashes[] = $rule->getHash();
        }
        sort($hashes, SORT_STRING);
        return md5(self::class.'.'.implode('.', $hashes));
    }

    public function getDebugString(): string
    {
        return $this;
    }
}
