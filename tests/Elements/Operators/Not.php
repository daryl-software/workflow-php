<?php

namespace Ezweb\Workflow\Test\Elements\Operators;


class Not extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getResultProvider
     */
    public function testGetResult($a, $expected)
    {
        $operator = \Ezweb\Workflow\Elements\Operators\Not::create();

        $method = new \ReflectionMethod($operator, 'getResult');
        $method->setAccessible(true);
        $this->assertSame($expected, $method->invokeArgs($operator, [[], $a]), var_export($a, true));
    }

    public function getResultProvider()
    {
        return
            [
                [[true], false],
                [[false], true],
                [[1], false],
                [[2], false],
                [['a'], false],
            ];
    }

    public function testIsValid()
    {
        $operator = \Ezweb\Workflow\Elements\Operators\Not::create();

        $method = new \ReflectionMethod($operator, 'isValid');
        $method->setAccessible(true);

        $operator->attachNewScalar(2);
        $this->assertTrue($method->invokeArgs($operator, [[], []]));

        $operator->attachNewScalar(2);
        $this->assertFalse($method->invokeArgs($operator, [[], []]));

        $operator->attachNewScalar(2);
        $this->assertFalse($method->invokeArgs($operator, [[], []]));

        $operator = \Ezweb\Workflow\Elements\Operators\Not::create();
        $method = new \ReflectionMethod($operator, 'isValid');
        $method->setAccessible(true);

        $this->assertFalse($method->invokeArgs($operator, [[], []]));
    }

    public function testGetJSONData()
    {
        $operator = \Ezweb\Workflow\Elements\Operators\Not::create();
        $operator->attachNewScalar(2);
        $operator->attachNewVars('toto');

        $expected = [
            'type' => \Ezweb\Workflow\Elements\Operators\Not::getName(),
            'value' => $operator->getOperands()
        ];

        $this->assertSame($expected, $operator->getJSONData());
    }
}
