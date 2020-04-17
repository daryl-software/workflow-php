<?php
namespace Ezweb\Workflow\Elements\InternalFunctions;

class Modulo extends InternalFunction
{
    public static function getName(): string
    {
        return 'modulo';
    }

    protected function getResult(array $vars, array $childrenValues)
    {
        if (count($this->args) !== 2) {
            throw new \RuntimeException('Modulo must have only 2 arguments');
        }

        $firstArgs = $childrenValues[0];
        $secondArgs = $childrenValues[1];

        if (!is_numeric($firstArgs) || !is_numeric($secondArgs)) {
            throw new \RuntimeException('Modulo arguments must be numeric');
        }

        return $firstArgs % $secondArgs;
    }

    public function __toString(): string
    {
        return implode(' % ', $this->getArgs());
    }
}