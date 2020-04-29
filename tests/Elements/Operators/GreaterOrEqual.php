<?php

namespace Ezweb\Workflow\Test\Elements\Operators;


class GreaterOrEqual extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getResultProvider
     */
    public function testGetResult($a, $expected)
    {
        $operator = \Ezweb\Workflow\Elements\Operators\GreaterOrEqual::create();

        $method = new \ReflectionMethod($operator, 'getResult');
        $method->setAccessible(true);
        $this->assertSame($expected, $method->invokeArgs($operator, [[], $a]));
    }

    public function getResultProvider()
    {
        return
            [
                [['b', 'a'], true],
                [[true, false], true],
                [[2, 1], true],
                [['2', 1], true],
                [[1, 1], true],
                [[1, '1'], true],
                [[1, '1', 1.0], true],
                [['ab', 'ab'], true],
                [[1, 1, 1, 1], true],
                [[1, true], true],
                [[false, 0], true],

                [['a', 'b'], false],
            ];
    }

    public function testIsValid()
    {
        $operator = \Ezweb\Workflow\Elements\Operators\GreaterOrEqual::create();

        $method = new \ReflectionMethod($operator, 'isValid');
        $method->setAccessible(true);

        $operator->attachNewScalar(2);
        $this->assertFalse($method->invokeArgs($operator, [[], []]));

        $operator->attachNewScalar(2);
        $this->assertTrue($method->invokeArgs($operator, [[], []]));

        $operator->attachNewScalar(2);
        $this->assertFalse($method->invokeArgs($operator, [[], []]));

        $operator = \Ezweb\Workflow\Elements\Operators\GreaterOrEqual::create();
        $method = new \ReflectionMethod($operator, 'isValid');
        $method->setAccessible(true);

        $this->assertFalse($method->invokeArgs($operator, [[], []]));
    }

    public function testGetJSONData()
    {
        $operator = \Ezweb\Workflow\Elements\Operators\GreaterOrEqual::create();
        $operator->attachNewScalar(2);
        $operator->attachNewVars('toto');

        $expected = [
            'type' => \Ezweb\Workflow\Elements\Operators\GreaterOrEqual::getName(),
            'value' => $operator->getOperands()
        ];

        $this->assertSame($expected, $operator->getJSONData());
    }
}
