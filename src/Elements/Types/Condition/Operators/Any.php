<?php


namespace Ezweb\Workflow\Elements\Types\Condition\Operators;


class Any extends Operator
{
    public static function getName(): string
    {
        return 'any';
    }

    public function getResult(array $vars): bool
    {
        foreach ($this->operands as $operand) {
            if ($operand->getResult($vars) === true) {
                return true;
            }
        }
        return false;
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
        return implode(' OR ', $this->getOperands());
    }
}