<?php


namespace Ezweb\Workflow\Elements\Types\Condition\Operators;


class Any extends Operator
{
    public static function getName(): string
    {
        return 'any';
    }

    protected function getResult(array $vars, array $childrenValues)
    {
        foreach ($childrenValues as $childrenValue) {
            if ($childrenValue === true) {
                return true;
            }
        }
        return false;
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
        return '(' . implode(' OR ', $this->getOperands()) . ')';
    }

    protected function isValid(array $vars, array $childrenValues): bool
    {
        return !empty($this->getOperands());
    }
}
