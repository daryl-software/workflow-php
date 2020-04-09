<?php
namespace Ezweb\Workflow\Test\Builder;

class ScalarBuilder extends \PHPUnit\Framework\TestCase {

    public function getMockWithValue($value): \Ezweb\Workflow\Elements\Types\ScalarTypes\Scalar
    {
        /** @var \Ezweb\Workflow\Elements\Types\ScalarTypes\Scalar $mock */
        $mock = $this
            ->getMockBuilder(\Ezweb\Workflow\Elements\Types\ScalarTypes\Scalar::class)
            ->disableOriginalConstructor()
            ->setMethodsExcept(['getHash', 'getName'])
            ->getMock();

        // stub mains methods
        $mock->method('getValue')->willReturn($value);
        $mock->method('getJSONData')->willReturn([
            'type' => $mock->getName(),
            'value' => $value
        ]);
        $mock->method('__toString')->willReturn('rule->toString');
        return $mock;
    }
}
