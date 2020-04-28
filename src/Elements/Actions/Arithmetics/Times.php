<?php
namespace Ezweb\Workflow\Elements\Actions\Arithmetics;

class Times extends \Ezweb\Workflow\Elements\Actions\Action
{
    public static function getName(): string
    {
        return 'times';
    }

    /**
     * @inheritDoc
     */
    protected function getResult(array $vars, array $childrenValues)
    {
        $result = 1;
        foreach ($childrenValues as $childValue) {
            $result *= $childValue;
        }
        return $result;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return implode(' x ', $this->getArgs());
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
