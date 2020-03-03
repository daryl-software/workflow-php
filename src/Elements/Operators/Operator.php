<?php


namespace Ezweb\Workflow\Elements\Operators;


abstract class Operator extends \Ezweb\Workflow\Elements\Element
{
    abstract public static function getName(): string;

}