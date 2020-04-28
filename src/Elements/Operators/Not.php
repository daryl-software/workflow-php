<?php

namespace Ezweb\Workflow\Elements\Operators;

class Not extends Operator
{
    public static function getName(): string
    {
        return 'not';
    }

    protected function getResult(array $vars, array $childrenValues)
    {
        return !(bool) $childrenValues[0];
    }

    public function getJSONData(): array
    {
        return [
            'type' => self::getName(),
            'value' => $this->getOperands()
        ];
    }

    public function __toString(): string
    {
        return 'NOT(' . $this->getOperands()[0] . ')';
    }

    protected function isValid(array $vars, array $childrenValues): bool
    {
        // we must have a single operand for this operator
        if (count($this->getOperands()) !== 1) {
            return false;
        }

        return true;
    }
}
