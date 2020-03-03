<?php


namespace Ezweb\Workflow\Elements\InternalFunctions;


abstract class InternalFunction extends \Ezweb\Workflow\Elements\Element
{
    abstract public static function getName(): string;
}