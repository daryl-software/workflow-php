<?php

namespace Ezweb\Workflow\Elements;

abstract class Element implements \JsonSerializable
{
    protected static \Ezweb\Workflow\Providers\Type $typeProviders;
    protected static \Ezweb\Workflow\Providers\Operator $operatorProvider;
    protected static \Ezweb\Workflow\Providers\InternalFunction $internalFunctionProvider;

    final protected function __construct()
    {
        self::$typeProviders = \Ezweb\Workflow\Providers\Type::getInstance();
        self::$operatorProvider = \Ezweb\Workflow\Providers\Operator::getInstance();
        self::$internalFunctionProvider = \Ezweb\Workflow\Providers\InternalFunction::getInstance();

        if (method_exists($this, 'setUp')) {
            $this->setUp();
        }
    }

    final public function jsonSerialize()
    {
        $data = $this->getJSONData();
        // add object hash to json
        $data['hash'] = $this->getHash();
        return $data;
    }

    /**
     * @return string
     */
    abstract public static function getName(): string;

    abstract public static function create(): self;

    /**
     * @return string
     */
    abstract public function getHash(): string;

    /**
     * @return array
     */
    abstract public function getJSONData(): array;
}