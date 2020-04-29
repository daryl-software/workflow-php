<?php

namespace Ezweb\Workflow\Test\Elements\Action\Arithmetics;


class PlusTest extends \PHPUnit\Framework\TestCase
{
    private \Ezweb\Workflow\Test\Mocker\ScalarMocker $scalarBuilder;

    protected function setUp(): void
    {
        $this->scalarBuilder = new \Ezweb\Workflow\Test\Mocker\ScalarMocker();
    }

    public function testCreateANewPlusElement()
    {
        $plus = \Ezweb\Workflow\Elements\Actions\Arithmetics\Plus::create();
        $this->assertInstanceOf(\Ezweb\Workflow\Elements\Actions\Arithmetics\Plus::class, $plus);
    }

    public function testAddArg()
    {
        $plus = \Ezweb\Workflow\Elements\Actions\Arithmetics\Plus::create();

        $plus->addArgs($this->scalarBuilder->getMockWithValue(1));
        $plus->addArgs($this->scalarBuilder->getMockWithValue(2));
        $this->assertCount(2, $plus->getArgs());
    }

    /**
     * @dataProvider resultIsOkProvider
     */
    public function testResultIsOk($a, $b, $expected)
    {
        $plus = \Ezweb\Workflow\Elements\Actions\Arithmetics\Plus::create();

        $method = new \ReflectionMethod($plus, 'getResult');
        $method->setAccessible(true);

        $this->assertSame(
            $expected,
            $method->invoke($plus, [], [$a, $b]),
            'getResult for ' . $a . '+' . $b . ' = ' . $expected
        );
    }

    public function resultIsOkProvider()
    {
        return [
            [4, 2, 6],
            [2, 3, 5],
            [4.5, 2, 6.5],
            [2.5, 4.5, 7.0],
            [3.1415, 3.1415, 6.283],
            [9, 7, 16],
        ];
    }

    /**
     * @dataProvider isValidValuesProvider
     */
    public function testIsValid($a, $b, $expected)
    {
        $plus = \Ezweb\Workflow\Elements\Actions\Arithmetics\Plus::create();

        $method = new \ReflectionMethod($plus, 'isValid');
        $method->setAccessible(true);

        $this->assertSame(
            $expected,
            $method->invokeArgs($plus, [[], [$a, $b]]),
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
