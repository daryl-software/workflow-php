<?php

namespace Ezweb\Workflow;

class Parser
{
    public static function createFromJson(string $json)
    {
        $decodedJson = json_decode($json);
        if ($decodedJson === false) {
            throw new \RuntimeException('Invalid JSON: ' . json_last_error_msg());
        }
        $process = new Process($decodedJson->name, $decodedJson->behavior);

        foreach ($decodedJson->value as $v){
            $process->addRule(self::parseMatcher($v));
        }
        return $process;
    }

    private static function parseMatcher(\stdClass $decodedJson)
    {
        if (!isset($decodedJson->type)) {
            return null;
        }

        $classType = \Ezweb\Workflow\Providers\TypeProvider::getInstance()->getClass($decodedJson->type);
        /** @var \Ezweb\Workflow\Elements\Types\Type $typeElement */
        $typeElement = $classType::loadFromConfig($decodedJson);
        if (!isset($decodedJson->value)) {
            var_dump('---------');
            var_dump($decodedJson);
        }
        if (\is_array($decodedJson->value)) {
            foreach ($decodedJson->value as $v) {
                $typeElement->addValue(self::parseMatcher($v));
            }
        } elseif ($decodedJson->value instanceof \stdClass) {
            $typeElement->addValue(self::parseMatcher($decodedJson->value));
        }
        return $typeElement;
    }
}