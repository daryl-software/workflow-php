<?php
namespace Ezweb\Workflow\Elements\Actions\Arithmetics;

class Modulo extends \Ezweb\Workflow\Elements\Actions\Action
{
    public static function getName(): string
    {
        return 'modulo';
    }

    protected function getResult(array $vars, array $childrenValues)
    {
        $firstArgs = $childrenValues[0];
        $secondArgs = $childrenValues[1];

        return $firstArgs % $secondArgs;
    }

    public function __toString(): string
    {
        return implode(' % ', $this->getArgs());
    }

    protected function isValid(): bool
    {
        $args = $this->getArgs();
        // we need 2 args for this function to work properly
        if (count($args) !== 2) {
            return false;
        }

        // get args values (ignore defined keys)
        $args = array_values($args);

        // both args must be numeric
        if (!is_numeric($args[0]) || !is_numeric($args[1])) {
            return false;
        }

        return true;
    }
}
