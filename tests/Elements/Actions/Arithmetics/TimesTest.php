<?php

namespace Ezweb\Workflow\Test\Elements\Action\Arithmetics;


class TimesTest extends \PHPUnit\Framework\TestCase
{
    private \Ezweb\Workflow\Test\Mocker\ScalarMocker $scalarBuilder;

    protected function setUp(): void
    {
        $this->scalarBuilder = new \Ezweb\Workflow\Test\Mocker\ScalarMocker();
    }

    public function testCreateANewTimesElement()
    {
        $times = \Ezweb\Workflow\Elements\Actions\Arithmetics\Times::create();
        $this->assertInstanceOf(\Ezweb\Workflow\Elements\Actions\Arithmetics\Times::class, $times);
    }

    public function testAddArg()
    {
        $times = \Ezweb\Workflow\Elements\Actions\Arithmetics\Times::create();

        $times->addArgs($this->scalarBuilder->getMockWithValue(1));
        $times->addArgs($this->scalarBuilder->getMockWithValue(2));
        $this->assertCount(2, $times->getArgs());
    }

    /**
     * @dataProvider resultIsOkProvider
     */
    public function testResultIsOk($a, $b, $expected)
    {
        $times = \Ezweb\Workflow\Elements\Actions\Arithmetics\Times::create();

        $method = new \ReflectionMethod($times, 'getResult');
        $method->setAccessible(true);

        $this->assertSame(
            $expected,
            $method->invoke($times, [], [$a, $b]),
            'getResult for ' . $a . ' * ' . $b . ' = ' . $expected
        );
    }

    public function resultIsOkProvider()
    {
        return [
            [4, 2, 8],
            [2, 3, 6],
            [4.5, 2, 9.0],
            [2.5, 4.5, 11.25],
            [3.1415, 3.1415, 9.86902225],
            [9, 7, 63],
        ];
    }

    /**
     * @dataProvider isValidValuesProvider
     */
    public function testIsValid($a, $b, $expected)
    {
        $times = \Ezweb\Workflow\Elements\Actions\Arithmetics\Times::create();

        $method = new \ReflectionMethod($times, 'isValid');
        $method->setAccessible(true);

        $this->assertSame(
            $expected,
            $method->invokeArgs($times, [[], [$a, $b]]),
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
