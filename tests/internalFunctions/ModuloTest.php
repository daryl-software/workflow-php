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
        $this->assertSame(0, $modulo->getResult([]), 'getResult without parameters');
        $this->assertSame(0, $modulo->getResult([
            'foo' => 'bar',
            'testFloat' => 3.2,
            'testNumber' => 5,
            'testString' => 'toto'
        ]), 'getResult with parameters');
    }

    public function testThrowAnExceptionOnIncorrectArgs()
    {
        $modulo = \Ezweb\Workflow\Elements\InternalFunctions\Modulo::create();
        $modulo->addArgs($this->scalarBuilder->getMockWithValue(2));
        $this->expectException(\RuntimeException::class);
        $modulo->getResult([]);
    }

    public function testThrowAnExceptionOnIncorrectValue()
    {
        $modulo = \Ezweb\Workflow\Elements\InternalFunctions\Modulo::create();
        $modulo->addArgs($this->scalarBuilder->getMockWithValue(2));
        $this->expectException(\RuntimeException::class);
        $modulo->getResult([]);
    }
}
