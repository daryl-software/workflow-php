<?php

namespace Ezweb\Workflow;

class Parser
{
    private static function setUp(): void
    {
        Loader::load();
    }

    public static function createFromJson(string $json): Workflow
    {
        self::setUp();
        $decodedJson = json_decode($json);
        if ($decodedJson === false) {
            throw new \RuntimeException('Invalid JSON: ' . json_last_error_msg());
        }
        $workflow = new Workflow($decodedJson->name);

        foreach ($decodedJson->value as $value) {
            $parsedValue = self::parse($value);
            if ($parsedValue instanceof \Ezweb\Workflow\Elements\Types\ParentTypes\Rule) {
                $workflow->addRule($parsedValue);
            }
        }
        return $workflow;
    }

    /**
     * @param \stdClass $decodedJson
     * @return Elements\Types\Type
     */
    private static function parse(\stdClass $decodedJson): Elements\Types\Type
    {
        if (!isset($decodedJson->type)) {
            throw new \RuntimeException(
                'Object type property must be defined:'
                . PHP_EOL
                . json_encode($decodedJson, JSON_PRETTY_PRINT)
            );
        }

        $classType = \Ezweb\Workflow\Providers\Type::getInstance()->getClass($decodedJson->type);
        /** @var \Ezweb\Workflow\Elements\Types\Type $classType */
        $typeElement = $classType::loadFromConfig($decodedJson);
        if (\is_array($decodedJson->value)) {
            /** @var \Ezweb\Workflow\Elements\Types\ParentTypes\ParentType $typeElement */
            /** @var mixed $v */
            foreach ($decodedJson->value as $v) {
                $typeElement->addValue(self::parse($v));
            }
        } elseif ($decodedJson->value instanceof \stdClass) {
            /** @var \Ezweb\Workflow\Elements\Types\ParentTypes\ParentType $typeElement */
            $typeElement->addValue(self::parse($decodedJson->value));
        }

        return $typeElement;
    }
}