<?php
namespace Ezweb\Workflow\Elements\Actions\Arithmetics;

class Pow extends \Ezweb\Workflow\Elements\Actions\Action
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
