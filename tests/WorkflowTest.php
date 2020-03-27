<?php

namespace Ezweb\Workflow\Test;

class WorkflowTest extends \PHPUnit\Framework\TestCase
{
    private \Ezweb\Workflow\Test\Builder\RuleBuilder $ruleBuilder;

    public function setUp(): void
    {
        $this->ruleBuilder = new \Ezweb\Workflow\Test\Builder\RuleBuilder();
    }

    public function testRuleCountAfterAddingSimpleRule()
    {
        $workflow = new \Ezweb\Workflow\Workflow('customWorkflow');
        $ruleMock = $this->generateBasicRule();
        $workflow->addRule($ruleMock);
        $this->assertCount(1, $workflow->getRules());
    }

    public function testResultShouldBeAnArrayWithAllResultWhenUsingAllMatchesBehavior()
    {
        $workflow = \Ezweb\Workflow\Parser::createFromJson(file_get_contents(__DIR__ . '/samples/json/completeWorkflow.json'));
        $results = $workflow->getResult([
            'testString' => 'foo',
            'testNumber' => 2,
            'testFloat' => 3.14
        ], \Ezweb\Workflow\Workflow::BEHAVIOR_ALL_MATCHES);
        $this->assertEquals([4,69], $results);
    }

    public function testResultShouldReturnFirstResultOnlyAndShouldNotBeAnArrayWhenUsingFirstMatchBehavior()
    {
        $workflow = \Ezweb\Workflow\Parser::createFromJson(file_get_contents(__DIR__ . '/samples/json/completeWorkflow.json'));
        $results = $workflow->getResult([
            'testString' => 'foo',
            'testNumber' => 2,
            'testFloat' => 3.14
        ], \Ezweb\Workflow\Workflow::BEHAVIOR_FIRST_MATCH);
        $this->assertEquals(4, $results);
    }

    public function testResultShouldThrowAnExceptionOnUnknownBehavior()
    {
        $workflow = \Ezweb\Workflow\Parser::createFromJson(file_get_contents(__DIR__ . '/samples/json/completeWorkflow.json'));
        $this->expectException(\InvalidArgumentException::class);
        $workflow->getResult([
            'testString' => 'foo',
            'testNumber' => 2,
            'testFloat' => 3.14
        ], 'test');
    }

    public function testBaseJsonGeneration()
    {
        $workflow = new \Ezweb\Workflow\Workflow('customWorkflow');
        $this->assertEquals('{"name":"customWorkflow","value":[]}', json_encode($workflow));
    }

    public function testBaseJsonGenerationThroughTojsonMethod()
    {
        $workflow = new \Ezweb\Workflow\Workflow('customWorkflow');
        $this->assertEquals('{"name":"customWorkflow","value":[]}', $workflow->toJson());
    }

    public function testJsonGenerationAfterAddingASimpleRule()
    {
        $workflow = new \Ezweb\Workflow\Workflow('customWorkflow');
        $ruleMock = $this->generateBasicRule();
        $workflow->addRule($ruleMock);
        $this->assertSame('{"name":"customWorkflow","value":[{"type":"rule","return":4,"value":[]}]}', json_encode($workflow));
    }

    public function testGenerateStringFromSimpleWorkflow()
    {
        $workflow = new \Ezweb\Workflow\Workflow('customWorkflow');
        $ruleMock = $this->generateBasicRule();
        $ruleMock2 = $this->generateBasicRule();
        $workflow->addRule($ruleMock);
        $workflow->addRule($ruleMock2);
        $this->assertEquals('rule->toString' . PHP_EOL . 'rule->toString', (string)$workflow);
    }

    private function generateBasicRule()
    {
        $ruleMock = $this->ruleBuilder->getMock();
        $ruleMock->method('jsonSerialize')->willReturn(json_decode(file_get_contents(__DIR__.'/samples/json/rule.json'),true));
        $ruleMock->method('__toString')->willReturn('rule->toString');
        return $ruleMock;
    }
}
