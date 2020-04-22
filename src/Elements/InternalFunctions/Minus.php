<?php
namespace Ezweb\Workflow\Elements\InternalFunctions;

class Minus extends InternalFunction
{
    public static function getName(): string
    {
        return 'minus';
    }

    protected function getResult(array $vars, array $childrenValues)
    {
        $result = array_shift($childrenValues);
        foreach ($childrenValues as $childValue) {
            $result -= $childValue;
        }
        return $result;
    }

    public function __toString(): string
    {
        return implode(' - ', $this->getArgs());
    }

    protected function isValid(): bool
    {
        $args = $this->getArgs();

        // we need args
        if (empty($args)) {
            return false;
        }

        // and only numeric
        foreach ($args as $arg) {
            if (!is_numeric($arg)) {
                return false;
            }
        }

        return true;
    }
}
