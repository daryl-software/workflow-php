<?php

namespace Ezweb\Workflow\Elements\Types\ScalarTypes;

class Vars extends ScalarType
{
    public static function getName(): string
    {
        return 'vars';
    }

    protected function getResult(array $vars, array $childrenValues)
    {
        if (!isset($vars[$this->scalarValue])) {
            throw new \RuntimeException('Var ' . $this->scalarValue . ' is missing');
        }
        return $vars[$this->getValue()];
    }

    /**
     * @return mixed[]
     */
    public function getJSONData(): ?array
    {
        return [
            'type' => self::getName(),
            'value' => $this->getValue()
        ];
    }

    public function __toString(): string
    {
        return (string) $this->scalarValue;
    }

    protected function isValid(array $vars, array $childrenValues): bool
    {
        return !empty($this->getValue());
    }
}
