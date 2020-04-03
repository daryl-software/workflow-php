<?php
namespace Ezweb\Workflow\Elements\InternalFunctions;

class Modulo extends InternalFunction
{
    public static function getName(): string
    {
        return 'modulo';
    }

    public function getResult(array $vars)
    {
        if (count($this->args) !== 2) {
            throw new \RuntimeException('Modulo must have only 2 arguments');
        }

        $firstArgs = $this->args[0]->getResult($vars);
        $secondArgs = $this->args[1]->getResult($vars);

        if (!is_numeric($firstArgs) || !is_numeric($secondArgs)) {
            throw new \RuntimeException('Modulo arguments must be numeric');
        }

        return $firstArgs % $secondArgs;
    }

    public function getJSONData(): array
    {
        return $this->args;
    }

    public function __toString(): string
    {
        return  implode(' % ', $this->getArgs());
    }
}