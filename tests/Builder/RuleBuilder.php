<?php

namespace Ezweb\Workflow\Test\Builder;

class RuleBuilder extends \PHPUnit\Framework\TestCase
{
    /**
     * @return \PHPUnit\Framework\MockObject\MockObject| \Ezweb\Workflow\Elements\Types\ParentTypes\Rule
     */
    public function getMock()
    {
        return $this
            ->getMockBuilder(\Ezweb\Workflow\Elements\Types\ParentTypes\Rule::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
