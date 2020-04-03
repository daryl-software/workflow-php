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
        if (count($this->operands) === 0) {
            throw new \RuntimeException('No operands');
        }
        // get first element to initialize value to check
        $value = $this->operands[0]->getResult($vars);
        // first iteration will be always true, due to upper line
        foreach ($this->operands as $iterationNumber => $operand) {
            if ($value <= $operand->getResult($vars)) {
                return false;
            }
        }
        return true;
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
