<?php

namespace Ezweb\Workflow\Test;

use Ezweb\Workflow\Elements\Operators\Equal;
use Ezweb\Workflow\Elements\Types\Condition\Operators\All;
use Ezweb\Workflow\Workflow;

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
        $ruleMock = $this->ruleBuilder->getMock();
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
        $workflow->attachNewRule()->setReturn(4);
        $this->assertSame(
            '{"name":"customWorkflow","value":[{"type":"rule","return":4,"value":[],"hash":"0b78c5a9fa638db8297b8f6148e8eadf"}]}',
            json_encode($workflow)
        );
    }

    public function testGenerateStringFromSimpleWorkflow()
    {
        $workflow = new \Ezweb\Workflow\Workflow('customWorkflow');
        $ruleMock = $this->ruleBuilder->getMock();
        $ruleMock2 = $this->ruleBuilder->getMock();
        $workflow->addRule($ruleMock);
        $workflow->addRule($ruleMock2);
        $this->assertEquals('rule->toString' . \Ezweb\Workflow\Workflow::STRING_SEPARATOR . 'rule->toString', (string)$workflow);
    }

    public function testWorkflowCreatedFromJsonOutputTheSameJson()
    {
        $json = file_get_contents(__DIR__ . '/samples/json/completeWorkflow.json');
        $trimmedJson = json_encode(json_decode($json));
        $workflow = \Ezweb\Workflow\Parser::createFromJson($trimmedJson);
        $this->assertEquals($trimmedJson, json_encode($workflow));
    }

    public function testHashIsStillTheSameBetweenWorkflowWithChangedObjectsOrder()
    {
        $json = file_get_contents(__DIR__ . '/samples/json/completeWorkflow.json');
        $trimmedJson = json_encode(json_decode($json));
        $jsonWithChangedOrder = file_get_contents(__DIR__ . '/samples/json/completeWorkflowChangedOrder.json');
        $trimmedJsonWithChangedOrder = json_encode(json_decode($jsonWithChangedOrder));
        $workflow = \Ezweb\Workflow\Parser::createFromJson($trimmedJson);
        $workflowWithChangedOrder = \Ezweb\Workflow\Parser::createFromJson($trimmedJsonWithChangedOrder);
        $this->assertEquals($workflow->getHash(), $workflowWithChangedOrder->getHash());
    }

    public function testBuildAWorkflowManually()
    {
        $workflow = new \Ezweb\Workflow\Workflow('customWorkflow');
        $rule1 = $workflow->attachNewRule();
        $rule1->setReturn(5);
        $condition1 = $rule1->attachNewCondition();
        $condition1->setConditionOperator(\Ezweb\Workflow\Elements\Types\Condition\Operators\All::class);
        $operator = $condition1->attachNewOperator(\Ezweb\Workflow\Elements\Operators\Equal::class);
        $operator->attachNewScalar(2);
        $operator->attachNewVars('channelId');
        $json = file_get_contents(__DIR__ . '/samples/json/manualWorkflowBuild.json');
        $trimmedJson = json_encode(json_decode($json));
        $this->assertEquals($trimmedJson, json_encode($workflow));
    }
}
