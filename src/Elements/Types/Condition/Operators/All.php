<?php

namespace Ezweb\Workflow\Elements\Types\Condition\Operators;

class All extends Operator
{
    public static function getName(): string
    {
        return 'all';
    }

    public function getResult(array $vars): bool
    {
        foreach ($this->operands as $operand) {
            if ($operand->getResult($vars) !== true) {
                return false;
            }
        }
        return true;
    }

    public function getJSONData(): array
    {
        return [
            'type' => self::getName(),
            'value' => $this->operands
        ];
    }

    public function __toString(): string
    {
        return implode(' AND ', $this->getOperands());
    }
}