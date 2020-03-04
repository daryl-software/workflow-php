<?php


namespace Ezweb\Workflow\Elements\InternalFunctions;


abstract class InternalFunction extends \Ezweb\Workflow\Elements\Element
{
    /**
     * @var array<\Ezweb\Workflow\Elements\Types\Type>
     */
    protected array $args;

    abstract public static function getName(): string;

    abstract public function getResult(array $vars);

    public function addArgs(\Ezweb\Workflow\Elements\Types\Type $arg)
    {
        $this->args[] = $arg;
        return $this;
    }
}