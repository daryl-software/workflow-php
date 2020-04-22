<?php
namespace Ezweb\Workflow\Elements\InternalFunctions;

class Plus extends InternalFunction
{
    public static function getName(): string
    {
        return 'plus';
    }

    protected function getResult(array $vars, array $childrenValues)
    {
        return array_sum($childrenValues);
    }

    public function __toString(): string
    {
        return implode(' + ', $this->getArgs());
    }

    protected function isValid(): bool
    {
        $args = $this->getArgs();

        // must has args
        if (empty($args)) {
            return false;
        }

        // and all numeric
        foreach ($args as $arg) {
            if (!is_numeric($arg)) {
                return false;
            }
        }

        return true;
    }
}
