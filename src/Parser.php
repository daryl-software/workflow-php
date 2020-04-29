<?php

namespace Ezweb\Workflow;

class Parser
{
    /**
     * @param string $json
     * @return Workflow
     */
    public static function createFromJson(string $json): Workflow
    {
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
     * @param \stdClass $decodedData
     * @return Elements\Types\Type
     */
    private static function parse(\stdClass $decodedData, Loader $configLoader = null): Elements\Types\Type
    {
        if (!isset($decodedData->type)) {
            throw new \RuntimeException(
                'Object type property must be defined:'
                . PHP_EOL
                . json_encode($decodedData, JSON_PRETTY_PRINT)
            );
        }

        if ($configLoader === null) {
            $configLoader = new Loader();
        }

        $classType = $configLoader->getTypeProviderConfig()->getClass($decodedData->type);
        /** @var \Ezweb\Workflow\Elements\Types\Type $classType */
        $typeElement = $classType::createFromParser($decodedData, $configLoader);
        if (\is_array($decodedData->value)) {
            /** @var \Ezweb\Workflow\Elements\Types\ParentTypes\ParentType $typeElement */
            /** @var mixed $value */
            foreach ($decodedData->value as $value) {
                $typeElement->addValue(self::parse($value));
            }
        } elseif ($decodedData->value instanceof \stdClass) {
            /** @var \Ezweb\Workflow\Elements\Types\ParentTypes\ParentType $typeElement */
            $typeElement->addValue(self::parse($decodedData->value));
        }

        return $typeElement;
    }
}
