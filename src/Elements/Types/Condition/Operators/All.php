<?php

namespace Ezweb\Workflow\Elements\Types\Condition\Operators;

class All extends Operator
{
    public static function getName(): string
    {
        return 'all';
    }

    protected function getResult(array $vars, array $childrenValues)
    {
        foreach ($childrenValues as $childrenValue) {
            if ($childrenValue !== true) {
                return false;
            }
        }
        return true;
    }

    public function getJSONData(): ?array
    {
        return [
            'type' => self::getName(),
            'value' => $this->getOperands()
        ];
    }

    public function __toString(): string
    {
        return implode(' AND ', $this->getOperands());
    }

    protected function isValid(array $vars, array $childrenValues): bool
    {
        return !empty($this->getOperands());
    }
}
