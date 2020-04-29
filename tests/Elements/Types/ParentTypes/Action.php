<?php

namespace Ezweb\Workflow\Test\Elements\Types\ParentTypes;

use Ezweb\Workflow\Loader;
use Ezweb\Workflow\Parser;

class Action extends \PHPUnit\Framework\TestCase
{

    public function testGetResult()
    {
        $action = \Ezweb\Workflow\Elements\Types\ParentTypes\Action::create();

        $method = new \ReflectionMethod($action, 'getResult');
        $method->setAccessible(true);

        $property = new \ReflectionProperty($action, 'function');
        $property->setAccessible(true);

        $vars = [1, 2];
        $childrenValues = ['a', 'b'];

        $function = $this
            ->getMockBuilder(\Ezweb\Workflow\Elements\Actions\Action::class)
            ->getMock();

        $function
            ->expects($this->once())
            ->method('getResult')
            ->willReturn(2)
            ->with($vars, $childrenValues);

        $property->setValue($action, $function);

        $this->assertSame(2, $method->invokeArgs($action, [$vars, $childrenValues]));
    }

    public function testAddValue()
    {
        $action = \Ezweb\Workflow\Elements\Types\ParentTypes\Action::create();

        $property = new \ReflectionProperty($action, 'function');
        $property->setAccessible(true);

        $type = $this->getMockBuilder(\Ezweb\Workflow\Elements\Types\Type::class)->getMock();

        $function = $this->getMockBuilder(\Ezweb\Workflow\Elements\Actions\Action::class)->getMock();
        $function->expects($this->once())->method('addArgs')->with($type);

        $property->setValue($action, $function);

        $action->addValue($type);
    }

    public function testCreateFromParser()
    {
        $functionParsed = new \stdClass();
        $functionParsed->name = '';

        $providerAction = $this->getMockBuilder(\Ezweb\Workflow\Providers\Action::class)->getMock();
        $providerAction->method('getClass')->willReturn(\Ezweb\Workflow\Elements\Actions\Arithmetics\Modulo::class);

        $loader = $this->getMockBuilder(\Ezweb\Workflow\Loader::class)->getMock();
        $loader->method('getActionProviderConfig')->willReturn($providerAction);

        $action = \Ezweb\Workflow\Elements\Types\ParentTypes\Action::createFromParser($functionParsed, $loader);
        $property = new \ReflectionProperty($action, 'function');
        $property->setAccessible(true);

        $function = $property->getValue($action);

        $this->assertInstanceOf(\Ezweb\Workflow\Elements\Types\ParentTypes\Action::class, $action);
        $this->assertInstanceOf(\Ezweb\Workflow\Elements\Actions\Arithmetics\Modulo::class, $function);
    }

    public function testGetValues()
    {
        $scalar = new \stdClass();
        $scalar->type = 'scalar';
        $scalar->value = 2;

        $vars = new \stdClass();
        $vars->type = 'scalar';
        $vars->value = 'toto';

        $object = new \stdClass();
        $object->type = 'action';
        $object->name = 'modulo';
        $object->value = [
            $scalar,
            $vars
        ];

        $action = \Ezweb\Workflow\Elements\Types\ParentTypes\Action::createFromParser($object, new Loader());

        dump($action);
    }
}
