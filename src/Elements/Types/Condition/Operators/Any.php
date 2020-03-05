<?php


namespace Ezweb\Workflow\Elements\Types\Condition\Operators;


class Any extends Operator
{
    public static function getName(): string
    {
        return 'any';
    }

    /**
     * @param mixed[] $vars
     * @return bool
     */
    public function getResult(array $vars): bool
    {
        foreach ($this->operands as $operand) {
            if ($operand->getResult($vars) === true) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return mixed[]
     */
    public function jsonSerialize(): array
    {
        return [
            'type' => self::getName(),
            'value' => $this->operands
        ];
    }
}