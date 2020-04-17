<?php

namespace Ezweb\Workflow\Elements\Operators;

class Equal extends Operator
{
    public static function getName(): string
    {
        return 'equal';
    }

    protected function getResult(array $vars, array $childrenValues)
    {
        if (count($this->operands) === 0) {
            throw new \RuntimeException('No operands');
        }
        // get first element to initialize value to check
        $valueToBeEquals = $childrenValues[0];
        // first iteration will be always true, due to upper line
        foreach ($childrenValues as $childrenValue) {
            if ($valueToBeEquals != $childrenValue) {
                return false;
            }
        }
        return true;
    }

    public function getJSONData(): ?array
    {
        return [
            'type' => self::getName(),
            'value' => $this->operands
        ];
    }

    public function __toString(): string
    {
        return '(' . implode(' = ', $this->getOperands()) . ')';
    }
}
