<?php

namespace Ezweb\Workflow\Elements\Operators;

class GreaterOrEqual extends Operator
{
    public static function getName(): string
    {
        return 'greaterOrEqual';
    }

    protected function getResult(array $vars, array $childrenValues): bool
    {
        return $childrenValues[0] >= $childrenValues[1];
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
        return  implode(' >= ', $this->getOperands());
    }

    protected function isValid(array $vars, array $childrenValues): bool
    {
        // we must have 2 operands for this operator
        if (count($this->getOperands()) !== 2) {
            return false;
        }

        return true;
    }
}
