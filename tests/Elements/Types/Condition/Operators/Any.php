<?php

namespace Ezweb\Workflow\Test\Elements\Types\Condition\Operators;


use Ezweb\Workflow\Elements\Operators\Equal;
use Ezweb\Workflow\Elements\Operators\Operator;

class Any extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getResultProvider
     */
    public function testGetResult($a, $expected)
    {
        $operator = \Ezweb\Workflow\Elements\Types\Condition\Operators\Any::create();

        $method = new \ReflectionMethod($operator, 'getResult');
        $method->setAccessible(true);

        $this->assertSame($expected, $method->invokeArgs($operator, [[], $a]), var_export($a, true));
    }

    public function getResultProvider()
    {
        return
            [
                [[1, 1], false],
                [[false, false], false],
                [['a', 'a'], false],

                [[true, false], true],
                [[false, true], true],
                [[true, true], true],
                [[true, true, true, true], true],
            ];
    }

    public function testIsValid()
    {
        $operator = \Ezweb\Workflow\Elements\Types\Condition\Operators\Any::create();

        $method = new \ReflectionMethod($operator, 'isValid');
        $method->setAccessible(true);
        $this->assertFalse($method->invokeArgs($operator, [[], []]));

        $operator->attachNewOperand(\Ezweb\Workflow\Elements\Types\ParentTypes\Operator::class);
        $this->assertTrue($method->invokeArgs($operator, [[], []]));

        $operator->attachNewOperand(\Ezweb\Workflow\Elements\Types\ParentTypes\Operator::class);
        $this->assertTrue($method->invokeArgs($operator, [[], []]));

        $operator = \Ezweb\Workflow\Elements\Operators\Equal::create();
        $method = new \ReflectionMethod($operator, 'isValid');
        $method->setAccessible(true);

        $this->assertFalse($method->invokeArgs($operator, [[], []]));
    }

    public function testGetJSONData()
    {
        $operator = \Ezweb\Workflow\Elements\Types\Condition\Operators\Any::create();
        $operator->attachNewOperand(\Ezweb\Workflow\Elements\Types\ParentTypes\Operator::class);

        $expected = [
            'type' => \Ezweb\Workflow\Elements\Types\Condition\Operators\Any::getName(),
            'value' => $operator->getOperands()
        ];

        $this->assertSame($expected, $operator->getJSONData());
    }
}
