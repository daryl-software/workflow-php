<?php
namespace Ezweb\Workflow\Test\internalFunctions;

class ModuloTest extends \PHPUnit\Framework\TestCase
{
    private \Ezweb\Workflow\Test\Builder\ScalarBuilder $scalarBuilder;

    protected function setUp(): void
    {
        $this->scalarBuilder = new \Ezweb\Workflow\Test\Builder\ScalarBuilder();
    }

    public function testCreateANewModuloElement()
    {
        $modulo = \Ezweb\Workflow\Elements\InternalFunctions\Modulo::create();
        $this->assertInstanceOf(\Ezweb\Workflow\Elements\InternalFunctions\Modulo::class, $modulo);
    }

    public function testAddArg()
    {
        $modulo = \Ezweb\Workflow\Elements\InternalFunctions\Modulo::create();
        $modulo->addArgs($this->scalarBuilder->getMockWithValue(1));
        $modulo->addArgs($this->scalarBuilder->getMockWithValue(2));
        $this->assertCount(2, $modulo->getArgs());
    }

    public function testResultIsOk()
    {
        $modulo = \Ezweb\Workflow\Elements\InternalFunctions\Modulo::create();
        $modulo->addArgs($this->scalarBuilder->getMockWithValue(4));
        $modulo->addArgs($this->scalarBuilder->getMockWithValue(2));

        $reflection = new \ReflectionClass(\Ezweb\Workflow\Elements\InternalFunctions\Modulo::class);
        $method = $reflection->getMethod('getResult');
        $method->setAccessible(true);

        $this->assertSame(0, $method->invoke($modulo, [], [4, 2]));
        $this->assertSame(0, $method->invoke($modulo, [
            'foo' => 'bar',
            'testFloat' => 3.2,
            'testNumber' => 5,
            'testString' => 'toto'
        ], [4,2]));
    }

    // public function testThrowAnExceptionOnIncorrectArgs()
    // {
    //     $modulo = \Ezweb\Workflow\Elements\InternalFunctions\Modulo::create();
    //     $modulo->addArgs($this->scalarBuilder->getMockWithValue(2));
    //     $this->expectException(\RuntimeException::class);
    //     $modulo->getResult([],);
    // }
    //
    // public function testThrowAnExceptionOnIncorrectValue()
    // {
    //     $modulo = \Ezweb\Workflow\Elements\InternalFunctions\Modulo::create();
    //     $modulo->addArgs($this->scalarBuilder->getMockWithValue(2));
    //     $this->expectException(\RuntimeException::class);
    //     $modulo->getResult([],);
    // }
}
