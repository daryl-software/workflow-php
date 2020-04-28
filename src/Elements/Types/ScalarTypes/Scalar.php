<?php

namespace Ezweb\Workflow\Elements\Types\ScalarTypes;

class Scalar extends ScalarType
{
    /**
     * @var mixed
     */
    protected $scalarValue;

    public static function getName(): string
    {
        return 'scalar';
    }

    protected function getResult(array $vars, array $childrenValues)
    {
        return $this->getValue();
    }

    public function getJSONData(): ?array
    {
        return [
            'type' => self::getName(),
            'value' => $this->getValue()
        ];
    }

    public function __toString(): string
    {
        return (string) $this->getValue();
    }

    protected function isValid(array $vars, array $childrenValues): bool
    {
        return $this->getValue() !== null;
    }
}
