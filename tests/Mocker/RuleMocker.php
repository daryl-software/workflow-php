<?php

namespace Ezweb\Workflow\Test\Mocker;

class RuleMocker extends \PHPUnit\Framework\TestCase
{
    private const NAME = 'rule';
    private const VALUES = [];
    private const RETURN = 4;


    /**
     * @return \PHPUnit\Framework\MockObject\MockObject| \Ezweb\Workflow\Elements\Types\ParentTypes\Rule
     */
    public function getMock()
    {
        // mock Rule object
        $mock = $this
            ->getMockBuilder(\Ezweb\Workflow\Elements\Types\ParentTypes\Rule::class)
            ->disableOriginalConstructor()
            ->setMethodsExcept(['getHash'])
            ->getMock();

        // stub mains methods
        $mock->method('getValues')->willReturn(self::VALUES);
        $mock->method('getReturn')->willReturn(self::RETURN);
        $mock->method('getName')->willReturn(self::NAME);
        $mock->method('getJSONData')->willReturn([
            'type' => self::NAME,
            'return' => self::RETURN,
            'value' => self::VALUES
        ]);
        $mock->method('__toString')->willReturn('rule->toString');

        return $mock;
    }
}
