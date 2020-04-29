<?php

namespace Ezweb\Workflow\Test\Elements\Action\Arithmetics;


class PowTest extends \PHPUnit\Framework\TestCase
{
    private \Ezweb\Workflow\Test\Mocker\ScalarMocker $scalarBuilder;

    protected function setUp(): void
    {
        $this->scalarBuilder = new \Ezweb\Workflow\Test\Mocker\ScalarMocker();
    }

    public function testCreateANewPowElement()
    {
        $pow = \Ezweb\Workflow\Elements\Actions\Arithmetics\Pow::create();
        $this->assertInstanceOf(\Ezweb\Workflow\Elements\Actions\Arithmetics\Pow::class, $pow);
    }

    public function testAddArg()
    {
        $pow = \Ezweb\Workflow\Elements\Actions\Arithmetics\Pow::create();

        $pow->addArgs($this->scalarBuilder->getMockWithValue(1));
        $pow->addArgs($this->scalarBuilder->getMockWithValue(2));
        $this->assertCount(2, $pow->getArgs());
    }

    /**
     * @dataProvider resultIsOkProvider
     */
    public function testResultIsOk($a, $b, $expected)
    {
        $pow = \Ezweb\Workflow\Elements\Actions\Arithmetics\Pow::create();

        $method = new \ReflectionMethod($pow, 'getResult');
        $method->setAccessible(true);

        $this->assertSame(
            $expected,
            $method->invoke($pow, [], [$a, $b]),
            'getResult for ' . $a . ' ** ' . $b . ' = ' . $expected
        );
    }

    public function resultIsOkProvider()
    {
        return [
            [4, 2, 16],
            [2, 3, 8],
            [4.5, 2, 20.25],
            [2.5, 4.5, 61.76323555016366],
            [3.1415, 3.1415, 36.45491472872008],
            [9, 7, 4782969],
        ];
    }

    /**
     * @dataProvider isValidValuesProvider
     */
    public function testIsValid($a, $b, $expected)
    {
        $pow = \Ezweb\Workflow\Elements\Actions\Arithmetics\Pow::create();

        $method = new \ReflectionMethod($pow, 'isValid');
        $method->setAccessible(true);

        $this->assertSame(
            $expected,
            $method->invokeArgs($pow, [[], [$a, $b]]),
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
