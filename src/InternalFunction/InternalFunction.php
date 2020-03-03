<?php


namespace Ezweb\Workflow\InternalFunction;


abstract class InternalFunction extends \Ezweb\Workflow\Types\Type
{
    abstract public static function getName(): string;
}