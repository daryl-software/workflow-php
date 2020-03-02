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
        $classType = Types\Providers\TypeProvider::getInstance()->getClassFromType($decodedJson->type);

        /** @var Types\Type $type */
        $type = $classType::loadFromConfig($decodedJson);
        if (\is_array($decodedJson->value)) {
            foreach ($decodedJson->value as $v) {
                $type->addValue(self::parseMatcher($v));
            }
        } elseif ($decodedJson->value instanceof \stdClass) {
            $type->addValue(self::parseMatcher($decodedJson->value));
        }
        return $type;
    }
}