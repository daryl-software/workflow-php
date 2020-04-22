<?php
namespace Ezweb\Workflow\Elements\InternalFunctions;

class Pow extends InternalFunction
{
    public static function getName(): string
    {
        return 'pow';
    }

    protected function getResult(array $vars, array $childrenValues)
    {
        return $childrenValues[0] ** $childrenValues[1];
    }

    public function __toString(): string
    {
        return implode(' ** ', $this->getArgs());
    }

    protected function isValid(): bool
    {
        $args = $this->getArgs();

        // must have only 2 arguments for this actions
        if (count($args) !== 2) {
            return false;
        }

        // arguments must be numeric
        if (!is_numeric($args[0]) || !is_numeric($args[1])) {
            return false;
        }

        return true;
    }
}
