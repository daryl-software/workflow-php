<?php

namespace Ezweb\Workflow\Test\Elements\Types\ParentTypes;

class Action extends \PHPUnit\Framework\TestCase
{

    public function testGetResult()
    {
        $action = \Ezweb\Workflow\Elements\Types\ParentTypes\Action::create();

        $method = new \ReflectionMethod($action, 'getResult');
        $method->setAccessible(true);

        $vars = [1, 2];
        $childrenValues = ['a', 'b'];

        $function = $this
            ->getMockBuilder(\Ezweb\Workflow\Elements\Actions\Action::class)
            ->disableOriginalConstructor()
            ->getMock();

        $function
            ->expects($this->once())
            ->method('getResult')
            ->with($vars, $childrenValues);

        $action->function = $function;

        $method->invokeArgs($action, [$vars, $childrenValues]);
    }

    public function testAddValue()
    {
        $action = \Ezweb\Workflow\Elements\Types\ParentTypes\Action::create();

        $type = $this->getMockBuilder(\Ezweb\Workflow\Elements\Types\Type::class)->disableOriginalConstructor()->getMock();

        $function = $this->getMockBuilder(\Ezweb\Workflow\Elements\Actions\Action::class)->disableOriginalConstructor()->getMock();
        $function->expects($this->once())->method('addArgs')->with($type);

        $action->function = $function;

        $action->addValue($type);
    }
}
