<?php

namespace Ezweb\Workflow\Elements\Operators;

class LessOrEqualThan extends Operator
{
    public static function getName(): string
    {
        return 'lessOrEqualThan';
    }

    /**
     * @param mixed[] $vars
     * @return bool
     */
    public function getResult(array $vars): bool
    {
        if (count($this->operands) !== 2) {
            throw new \RuntimeException('Require only 2 operands');
        }
        return $this->operands[0]->getResult($vars) <= $this->operands[1]->getResult($vars);
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
        return  implode(' <= ', $this->getOperands());
    }
}
