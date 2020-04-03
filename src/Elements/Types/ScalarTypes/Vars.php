<?php

namespace Ezweb\Workflow\Elements\Types\ScalarTypes;

class Vars extends ScalarType
{
    public static function getName(): string
    {
        return 'vars';
    }

    public function getResult(array $vars)
    {
        if (!isset($vars[$this->scalarValue])) {
            throw new \RuntimeException('Var ' . $this->scalarValue . ' is missing');
        }
        return $vars[$this->scalarValue];
    }

    /**
     * @return mixed[]
     */
    public function getJSONData(): array
    {
        return [
            'type' => self::getName(),
            'value' => $this->scalarValue
        ];
    }

    public function __toString(): string
    {
        return (string) $this->scalarValue;
    }
}
