<?php

namespace Ezweb\Workflow\Test\Elements\Action\Arithmetics;

use Ezweb\Workflow\Providers\Provider;

class DivideTest extends \PHPUnit\Framework\TestCase
{
    private \Ezweb\Workflow\Test\Mocker\ScalarMocker $scalarBuilder;

    protected function setUp(): void
    {
        $this->scalarBuilder = new \Ezweb\Workflow\Test\Mocker\ScalarMocker();
    }

    /**
     * @dataProvider argDatasetProvider
     */
    public function testIsValidWithDifferentArgs($args, $expected)
    {
        $divide = \Ezweb\Workflow\Elements\Actions\Arithmetics\Divide::create();
        foreach ($args as $arg) {
            $scalarMock = $this->scalarBuilder->getMockWithValue($arg);
            $divide->addArgs($scalarMock);
        }
        $method = new \ReflectionMethod($divide, 'isValid');
        $method->setAccessible(true);

        $this->assertSame($expected, $method->invoke($divide));
    }

    public function argDatasetProvider()
    {
        return [
            [[6, 2], true]
        ];
    }
}
