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
