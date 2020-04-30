<?php

namespace Ezweb\Workflow\Test\Elements\Types\ParentTypes;

class Condition extends \PHPUnit\Framework\TestCase
{
    public function testGetResult()
    {
        $condition = \Ezweb\Workflow\Elements\Types\ParentTypes\Condition::create();

        $property = new \ReflectionProperty($condition, 'operator');
        $property->setAccessible(true);

        $method = new \ReflectionMethod($condition, 'getResult');
        $method->setAccessible(true);

        $vars = [1, 2];
        $childrenValues = ['a', 'b'];

        $operator = $this
            ->getMockBuilder(\Ezweb\Workflow\Elements\Types\Condition\Operators\Operator::class)
            ->disableOriginalConstructor()
            ->getMock();
        $operator->expects($this->once())
            ->method('getResult')
            ->with($vars, $childrenValues)
            ->willReturn(2);

        $property->setValue($condition, $operator);

        $this->assertSame(2, $method->invokeArgs($condition, [$vars, $childrenValues]));
    }

    public function testAddValue()
    {
        $condition = \Ezweb\Workflow\Elements\Types\ParentTypes\Condition::create();

        $property = new \ReflectionProperty($condition, 'operator');
        $property->setAccessible(true);

        $method = new \ReflectionMethod($condition, 'addValue');
        $method->setAccessible(true);

        $typeMock = $this->getMockBuilder(\Ezweb\Workflow\Elements\Types\Type::class)
            ->getMock();

        $operator = $this
            ->getMockBuilder(\Ezweb\Workflow\Elements\Types\Condition\Operators\Operator::class)
            ->disableOriginalConstructor()
            ->getMock();
        $operator->expects($this->once())
            ->method('addOperand')
            ->with($typeMock)
            ->willReturn($condition);

        $property->setValue($condition, $operator);

        $this->assertSame($condition, $method->invokeArgs($condition, [$typeMock]));
    }

    public function testCreateFromParser()
    {
        $parsedData = new \stdClass();
        $parsedData->operator = '';

        $providerType = $this->getMockBuilder(\Ezweb\Workflow\Providers\Type::class)->getMock();
        $providerType->method('getClass')->willReturn(\Ezweb\Workflow\Elements\Types\Condition\Operators\Any::class);

        $loader = $this->getMockBuilder(\Ezweb\Workflow\Loader::class)->getMock();
        $loader->method('getTypeProviderConfig')->willReturn($providerType);

        $condition = \Ezweb\Workflow\Elements\Types\ParentTypes\Condition::createFromParser($parsedData, $loader);

        $property = new \ReflectionProperty($condition, 'operator');
        $property->setAccessible(true);

        $operator = $property->getValue($condition);

        $this->assertInstanceOf(\Ezweb\Workflow\Elements\Types\ParentTypes\Condition::class, $condition);
        $this->assertInstanceOf(\Ezweb\Workflow\Elements\Types\Condition\Operators\Any::class, $operator);
    }
}
