<?php

namespace Ezweb\Workflow\Test\Elements\Operators;


class Equal extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getResultProvider
     */
    public function testGetResult($a, $expected)
    {
        $operator = \Ezweb\Workflow\Elements\Operators\Equal::create();

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

                [[1, 2], false],
                [['a', 1], false],
                [[true, false], false],
                [[1, false], false],
                [[1, 1, 2, 1], false],
                [['ab', 'a'], false],
            ];
    }

    public function testIsValid()
    {
        $operator = \Ezweb\Workflow\Elements\Operators\Equal::create();

        $method = new \ReflectionMethod($operator, 'isValid');
        $method->setAccessible(true);

        $operator->attachNewScalar(2);
        $this->assertTrue($method->invokeArgs($operator, [[], []]));
        $operator->attachNewScalar(2);
        $this->assertTrue($method->invokeArgs($operator, [[], []]));

        $operator = \Ezweb\Workflow\Elements\Operators\Equal::create();
        $method = new \ReflectionMethod($operator, 'isValid');
        $method->setAccessible(true);

        $this->assertFalse($method->invokeArgs($operator, [[], []]));
    }

    public function testGetJSONData()
    {
        $operator = \Ezweb\Workflow\Elements\Operators\Equal::create();
        $operator->attachNewScalar(2);
        $operator->attachNewVars('toto');

        $expected = [
            'type' => \Ezweb\Workflow\Elements\Operators\Equal::getName(),
            'value' => $operator->getOperands()
        ];

        $this->assertSame($expected, $operator->getJSONData());
    }
}
