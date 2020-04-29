<?php

namespace Ezweb\Workflow\Test\Actions\Arithmetics;

class ModuloTest extends \PHPUnit\Framework\TestCase
{
    private \Ezweb\Workflow\Test\Mocker\ScalarMocker $scalarBuilder;

    protected function setUp(): void
    {
        $this->scalarBuilder = new \Ezweb\Workflow\Test\Mocker\ScalarMocker();
    }

    public function testCreateANewModuloElement()
    {
        $modulo = \Ezweb\Workflow\Elements\Actions\Arithmetics\Modulo::create();
        $this->assertInstanceOf(\Ezweb\Workflow\Elements\Actions\Arithmetics\Modulo::class, $modulo);
    }

    public function testAddArg()
    {
        $modulo = \Ezweb\Workflow\Elements\Actions\Arithmetics\Modulo::create();

        $modulo->addArgs($this->scalarBuilder->getMockWithValue(1));
        $modulo->addArgs($this->scalarBuilder->getMockWithValue(2));
        $this->assertCount(2, $modulo->getArgs());
    }

    /**
     * @dataProvider resultIsOkProvider
     */
    public function testResultIsOk($a, $b, $expected)
    {
        $modulo = \Ezweb\Workflow\Elements\Actions\Arithmetics\Modulo::create();
        $modulo->addArgs($this->scalarBuilder->getMockWithValue(4));
        $modulo->addArgs($this->scalarBuilder->getMockWithValue(2));

        $method = new \ReflectionMethod($modulo, 'getResult');
        $method->setAccessible(true);

        $this->assertSame(
            $expected,
            $method->invoke($modulo, [], [$a, $b]),
            'getResult for ' . $a . ' % ' . $b . ' = ' . $expected
        );
    }

    public function resultIsOkProvider()
    {
        return [
            [4, 2, 0],
            [5, 2, 1],
            [2, 5, 2],
            [4.0, 2.0, 0],
            [4.0, 2.1, 0],
            [4.2, 2.2, 0],
            [4.5, 2.2, 0],
            [4.6, 2.2, 0],
            [4.6, 2, 0],
            ["4.6", "2", 0],
            [5.2, 2.2, 1],
            [5.6, 2.2, 1],
            [5.2, 2.5, 1],
            [5.2, 2.8, 1],
            [2.8, 5.2, 2],
        ];
    }

    /**
     * @dataProvider isValidValuesProvider
     */
    public function testIsValid($a, $b, $expected)
    {
        $modulo = \Ezweb\Workflow\Elements\Actions\Arithmetics\Modulo::create();
        $modulo->addArgs($this->scalarBuilder->getMockWithValue(4));
        $modulo->addArgs($this->scalarBuilder->getMockWithValue(2));

        $method = new \ReflectionMethod($modulo, 'isValid');
        $method->setAccessible(true);

        $this->assertSame(
            $expected,
            $method->invokeArgs($modulo, [[], [$a, $b]]),
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
