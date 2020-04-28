<?php
namespace Ezweb\Workflow\Elements\Actions\Arithmetics;

class Plus extends \Ezweb\Workflow\Elements\Actions\Action
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

    protected function isValid(array $vars, array $childrenValues): bool
    {
        // must has args
        if (empty($childrenValues)) {
            return false;
        }

        // and all numeric
        foreach ($childrenValues as $childValue) {
            if (!is_numeric($childValue)) {
                return false;
            }
        }

        return true;
    }
}
