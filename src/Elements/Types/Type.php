<?php
namespace Ezweb\Workflow\Elements\Types;

abstract class Type extends \Ezweb\Workflow\Elements\Element {

    abstract public static function getName(): string;
    // public function getResult();
}