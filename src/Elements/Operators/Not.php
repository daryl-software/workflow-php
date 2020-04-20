<?php

namespace Ezweb\Workflow\Elements\Operators;

class Not extends Operator
{
    public static function getName(): string
    {
        return 'not';
    }

    /**
     * @param mixed[] $vars
     * @return bool
     */
    public function getResult(array $vars): bool
    {
        if (count($this->operands) !== 1) {
            throw new \RuntimeException('Require only 1 operand');
        }
        // get first element to initialize value to check
        return !(bool)$this->operands[0]->getResult($vars);
    }

    /**
     * @return mixed[]
     */
    public function getJSONData(): array
    {
        return [
            'type' => self::getName(),
            'value' => $this->operands
        ];
    }

    public function __toString()
    {
        return 'NOT(' . $this->operands[0] . ')';
    }
}
