<?php

namespace Ezweb\Workflow\Test\Elements\Action\Arithmetics;


class MinusTest extends \PHPUnit\Framework\TestCase
{
    private \Ezweb\Workflow\Test\Mocker\ScalarMocker $scalarBuilder;

    protected function setUp(): void
    {
        $this->scalarBuilder = new \Ezweb\Workflow\Test\Mocker\ScalarMocker();
    }

    public function testCreateANewMinusElement()
    {
        $minus = \Ezweb\Workflow\Elements\Actions\Arithmetics\Minus::create();
        $this->assertInstanceOf(\Ezweb\Workflow\Elements\Actions\Arithmetics\Minus::class, $minus);
    }

    public function testAddArg()
    {
        $minus = \Ezweb\Workflow\Elements\Actions\Arithmetics\Minus::create();

        $minus->addArgs($this->scalarBuilder->getMockWithValue(1));
        $minus->addArgs($this->scalarBuilder->getMockWithValue(2));
        $this->assertCount(2, $minus->getArgs());
    }

    /**
     * @dataProvider resultIsOkProvider
     */
    public function testResultIsOk($a, $b, $expected)
    {
        $minus = \Ezweb\Workflow\Elements\Actions\Arithmetics\Minus::create();

        $method = new \ReflectionMethod($minus, 'getResult');
        $method->setAccessible(true);

        $this->assertSame(
            $expected,
            $method->invoke($minus, [], [$a, $b]),
            'getResult for ' . $a . ' % ' . $b . ' = ' . $expected
        );
    }

    public function resultIsOkProvider()
    {
        return [
            [4, 2, 2],
            [2, 3, -1],
            [4.5, 2, 2.5],
            [2.5, 4.5, -2.0],
            [3.1415, 3.1415, 0.0],
            [9, 7, 2],
        ];
    }

    /**
     * @dataProvider isValidValuesProvider
     */
    public function testIsValid($a, $b, $expected)
    {
        $minus = \Ezweb\Workflow\Elements\Actions\Arithmetics\Minus::create();

        $method = new \ReflectionMethod($minus, 'isValid');
        $method->setAccessible(true);

        $this->assertSame(
            $expected,
            $method->invokeArgs($minus, [[], [$a, $b]]),
            'isValid for ' . $a . ' and ' . $b . ' expect ' . ($expected ? "true" : "false")
        );
    }

    public function isValidValuesProvider()
    {
        return [
            [1, 2, true],
            [1.1, 2.2, true],
            ['a', 2, false],
            [1.1, 'b', false],
            ['a', 'b', false]
        ];
    }
}
