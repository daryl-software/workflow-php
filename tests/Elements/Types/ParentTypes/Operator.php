<?php

namespace Ezweb\Workflow\Test\Elements\Types\ParentTypes;


class Operator extends \PHPUnit\Framework\TestCase
{
    public function testGetResult()
    {
        $condition = \Ezweb\Workflow\Elements\Types\ParentTypes\Operator::create();

        $property = new \ReflectionProperty($condition, 'operator');
        $property->setAccessible(true);

        $method = new \ReflectionMethod($condition, 'getResult');
        $method->setAccessible(true);

        $vars = [1, 2];
        $childrenValues = ['a', 'b'];

        $operator = $this
            ->getMockBuilder(\Ezweb\Workflow\Elements\Operators\Operator::class)
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
        $operatorType = \Ezweb\Workflow\Elements\Types\ParentTypes\Operator::create();

        $property = new \ReflectionProperty($operatorType, 'operator');
        $property->setAccessible(true);

        $method = new \ReflectionMethod($operatorType, 'addValue');
        $method->setAccessible(true);

        $typeMock = $this->getMockBuilder(\Ezweb\Workflow\Elements\Types\Type::class)
            ->getMock();

        $operator = $this
            ->getMockBuilder(\Ezweb\Workflow\Elements\Operators\Operator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $operator->expects($this->once())
            ->method('addOperand')
            ->with($typeMock)
            ->willReturn($operatorType);

        $property->setValue($operatorType, $operator);

        $this->assertSame($operatorType, $method->invokeArgs($operatorType, [$typeMock]));
    }

    public function testCreateFromParser()
    {
        $parsedData = new \stdClass();
        $parsedData->operator = '';

        $providerType = $this->getMockBuilder(\Ezweb\Workflow\Providers\Operator::class)->getMock();
        $providerType->method('getClass')->willReturn(\Ezweb\Workflow\Elements\Operators\Equal::class);

        $loader = $this->getMockBuilder(\Ezweb\Workflow\Loader::class)->getMock();
        $loader->method('getOperatorProviderConfig')->willReturn($providerType);

        $condition = \Ezweb\Workflow\Elements\Types\ParentTypes\Operator::createFromParser($parsedData, $loader);

        $property = new \ReflectionProperty($condition, 'operator');
        $property->setAccessible(true);

        $operator = $property->getValue($condition);

        $this->assertInstanceOf(\Ezweb\Workflow\Elements\Types\ParentTypes\Operator::class, $condition);
        $this->assertInstanceOf(\Ezweb\Workflow\Elements\Operators\Equal::class, $operator);
    }
}
