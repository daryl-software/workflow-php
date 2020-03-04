<?php

namespace Ezweb\Workflow;

class Parser
{
    private static function init()
    {
        Loader::load();
    }

    public static function createFromJson(string $json)
    {
        self::init();
        $decodedJson = json_decode($json);
        if ($decodedJson === false) {
            throw new \RuntimeException('Invalid JSON: ' . json_last_error_msg());
        }
        $workflow = new Workflow($decodedJson->name, $decodedJson->behavior);

        foreach ($decodedJson->value as $value){
            $parsedValue = self::parse($value);
            if ($parsedValue instanceof \Ezweb\Workflow\Elements\Types\ParentTypes\Rule) {
                $workflow->addRule($parsedValue);
            }
        }
        return $workflow;
    }

    private static function parse(\stdClass $decodedJson)
    {
        if (!isset($decodedJson->type)) {
            return null;
        }

        $classType = \Ezweb\Workflow\Providers\Type::getInstance()->getClass($decodedJson->type);
        /** @var \Ezweb\Workflow\Elements\Types\Type $typeElement */
        $typeElement = $classType::loadFromConfig($decodedJson);
        if (\is_array($decodedJson->value)) {
            foreach ($decodedJson->value as $v) {
                $typeElement->addValue(self::parse($v));
            }
        } elseif ($decodedJson->value instanceof \stdClass) {
            $typeElement->addValue(self::parse($decodedJson->value));
        }

        return $typeElement;
    }
}