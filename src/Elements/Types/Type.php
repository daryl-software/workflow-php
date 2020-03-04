<?php
namespace Ezweb\Workflow\Elements\Types;

abstract class Type extends \Ezweb\Workflow\Elements\Element {

    abstract public static function getName(): string;

    abstract public function getResult(array $vars);

    // public function getResult();
}