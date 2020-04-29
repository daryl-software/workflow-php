<?php

namespace Ezweb\Workflow\Test\Elements\Action\Arithmetics;


class DivideTest extends \PHPUnit\Framework\TestCase
{
    private \Ezweb\Workflow\Test\Mocker\ScalarMocker $scalarBuilder;

    protected function setUp(): void
    {
        $this->scalarBuilder = new \Ezweb\Workflow\Test\Mocker\ScalarMocker();
    }

    public function testCreateANewDivideElement()
    {
        $divide = \Ezweb\Workflow\Elements\Actions\Arithmetics\Divide::create();
        $this->assertInstanceOf(\Ezweb\Workflow\Elements\Actions\Arithmetics\Divide::class, $divide);
    }

    public function testAddArg()
    {
        $divide = \Ezweb\Workflow\Elements\Actions\Arithmetics\Divide::create();

        $divide->addArgs($this->scalarBuilder->getMockWithValue(1));
        $divide->addArgs($this->scalarBuilder->getMockWithValue(2));
        $this->assertCount(2, $divide->getArgs());
    }

    /**
     * @dataProvider resultIsOkProvider
     */
    public function testResultIsOk($a, $b, $expected)
    {
        $divide = \Ezweb\Workflow\Elements\Actions\Arithmetics\Divide::create();

        $method = new \ReflectionMethod($divide, 'getResult');
        $method->setAccessible(true);

        $this->assertSame(
            $expected,
            $method->invoke($divide, [], [$a, $b]),
            'getResult for ' . $a . ' / ' . $b . ' = ' . $expected
        );
    }

    public function resultIsOkProvider()
    {
        return [
            [4, 2, 2],
            [4.5, 2, 2.25],
            [4.5, 2.5, 1.8],
        ];
    }

    /**
     * @dataProvider isValidValuesProvider
     */
    public function testIsValid($a, $b, $expected)
    {
        $divide = \Ezweb\Workflow\Elements\Actions\Arithmetics\Divide::create();

        $method = new \ReflectionMethod($divide, 'isValid');
        $method->setAccessible(true);

        $this->assertSame(
            $expected,
            $method->invokeArgs($divide, [[], [$a, $b]]),
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
