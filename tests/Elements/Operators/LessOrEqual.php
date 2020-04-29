<?php

namespace Ezweb\Workflow\Test\Elements\Operators;


class LessOrEqual extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getResultProvider
     */
    public function testGetResult($a, $expected)
    {
        $operator = \Ezweb\Workflow\Elements\Operators\LessOrEqual::create();

        $method = new \ReflectionMethod($operator, 'getResult');
        $method->setAccessible(true);
        $this->assertSame($expected, $method->invokeArgs($operator, [[], $a]));
    }

    public function getResultProvider()
    {
        return
            [
                [[1, 1], true],
                [[1, '1'], true],
                [[1, '1', 1.0], true],
                [['ab', 'ab'], true],
                [[1, 1, 1, 1], true],
                [[1, true], true],
                [[false, 0], true],
                [['a', 'b'], true],

                [['b', 'a'], false],
                [[true, false], false],
                [[2, 1], false],
                [['2', 1], false],
            ];
    }

    public function testIsValid()
    {
        $operator = \Ezweb\Workflow\Elements\Operators\LessOrEqual::create();

        $method = new \ReflectionMethod($operator, 'isValid');
        $method->setAccessible(true);

        $operator->attachNewScalar(2);
        $this->assertFalse($method->invokeArgs($operator, [[], []]));

        $operator->attachNewScalar(2);
        $this->assertTrue($method->invokeArgs($operator, [[], []]));

        $operator->attachNewScalar(2);
        $this->assertFalse($method->invokeArgs($operator, [[], []]));

        $operator = \Ezweb\Workflow\Elements\Operators\LessOrEqual::create();
        $method = new \ReflectionMethod($operator, 'isValid');
        $method->setAccessible(true);

        $this->assertFalse($method->invokeArgs($operator, [[], []]));
    }

    public function testGetJSONData()
    {
        $operator = \Ezweb\Workflow\Elements\Operators\LessOrEqual::create();
        $operator->attachNewScalar(2);
        $operator->attachNewVars('toto');

        $expected = [
            'type' => \Ezweb\Workflow\Elements\Operators\LessOrEqual::getName(),
            'value' => $operator->getOperands()
        ];

        $this->assertSame($expected, $operator->getJSONData());
    }
}
