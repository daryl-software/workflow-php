<?php

namespace Ezweb\Workflow\Test;

use Ezweb\Workflow\Test\Builder\RuleBuilder;

class WorkflowTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var RuleBuilder
     */
    private RuleBuilder $ruleBuilder;

    public function setUp(): void
    {
        $this->ruleBuilder = new RuleBuilder();
    }

    public function testJsonSerialize()
    {
        $workflow = new \Ezweb\Workflow\Workflow('customWorkflow');
        $this->assertEquals('{"name":"customWorkflow","value":[]}', json_encode($workflow));
    }

    public function testGetName()
    {
        $workflow = new \Ezweb\Workflow\Workflow('customWorkflow');
        $this->assertEquals('customWorkflow', $workflow->getName());
    }

    public function testaddRule()
    {
        $workflow = new \Ezweb\Workflow\Workflow('customWorkflow');
        $ruleMock = $this->ruleBuilder->getMock();
        $ruleMock->method('jsonSerialize')->willReturn(json_decode(file_get_contents(__DIR__.'/samples/json/rule.json'),true));
        $workflow->addRule($ruleMock);
        $this->assertSame('{"name":"customWorkflow","value":[{"type":"rule","return":4,"value":[]}]}', json_encode($workflow));
    }

    public function testGetRules()
    {
        $workflow = new \Ezweb\Workflow\Workflow('customWorkflow');

        $ruleMock1 = $this->ruleBuilder->getMock();
        $ruleMock2 = $this->ruleBuilder->getMock();

        $workflow
            ->addRule($ruleMock1)
            ->addRule($ruleMock2);

        $this->assertEquals([$ruleMock1, $ruleMock2], $workflow->getRules());
    }

}
