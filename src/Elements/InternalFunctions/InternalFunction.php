<?php


namespace Ezweb\Workflow\Elements\InternalFunctions;


abstract class InternalFunction extends \Ezweb\Workflow\Elements\Element
{
    /**
     * @var \Ezweb\Workflow\Elements\Types\Type[]
     */
    protected array $args;

    /**
     * @return string
     */
    abstract public static function getName(): string;

    /**
     * @param mixed[] $vars
     * @return mixed
     */
    abstract public function getResult(array $vars);

    /**
     * @param \Ezweb\Workflow\Elements\Types\Type $arg
     * @return static
     */
    public function addArgs(\Ezweb\Workflow\Elements\Types\Type $arg): self
    {
        $this->args[] = $arg;
        return $this;
    }
    
    public static function create()
    {
        return new static();
    }
}