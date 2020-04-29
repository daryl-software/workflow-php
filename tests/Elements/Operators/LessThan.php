<?php

namespace Ezweb\Workflow\Test\Elements\Operators;


class LessThan extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getResultProvider
     */
    public function testGetResult($a, $expected)
    {
        $operator = \Ezweb\Workflow\Elements\Operators\LessThan::create();

        $method = new \ReflectionMethod($operator, 'getResult');
        $method->setAccessible(true);
        $this->assertSame($expected, $method->invokeArgs($operator, [[], $a]), var_export($a, true));
    }

    public function getResultProvider()
    {
        return
            [
                [['a', 'b'], true],
                [[1, 2], true],
                [[1, 1], false],
                [[1, '1'], false],
                [[1, '1', 1.0], false],
                [['ab', 'ab'], false],
                [[1, 1, 1, 1], false],
                [[1, true], false],
                [[false, 0], false],

                [['b', 'a'], false],
                [[true, false], false],
                [[2, 1], false],
                [['2', 1], false],
            ];
    }

    public function testIsValid()
    {
        $operator = \Ezweb\Workflow\Elements\Operators\LessThan::create();

        $method = new \ReflectionMethod($operator, 'isValid');
        $method->setAccessible(true);

        $operator->attachNewScalar(2);
        $this->assertFalse($method->invokeArgs($operator, [[], []]));

        $operator->attachNewScalar(2);
        $this->assertTrue($method->invokeArgs($operator, [[], []]));

        $operator->attachNewScalar(2);
        $this->assertFalse($method->invokeArgs($operator, [[], []]));

        $operator = \Ezweb\Workflow\Elements\Operators\LessThan::create();
        $method = new \ReflectionMethod($operator, 'isValid');
        $method->setAccessible(true);

        $this->assertFalse($method->invokeArgs($operator, [[], []]));
    }

    public function testGetJSONData()
    {
        $operator = \Ezweb\Workflow\Elements\Operators\LessThan::create();
        $operator->attachNewScalar(2);
        $operator->attachNewVars('toto');

        $expected = [
            'type' => \Ezweb\Workflow\Elements\Operators\LessThan::getName(),
            'value' => $operator->getOperands()
        ];

        $this->assertSame($expected, $operator->getJSONData());
    }
}
