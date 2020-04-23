<?php

namespace Ezweb\Workflow\Elements;

abstract class Element implements \JsonSerializable
{
    protected static \Ezweb\Workflow\Providers\Type $typeProviders;
    protected static \Ezweb\Workflow\Providers\Operator $operatorProvider;
    protected static \Ezweb\Workflow\Providers\Action $actionProvider;
    private static bool $initialized = false;

    final protected function __construct()
    {
        if (!self::$initialized) {
            self::$typeProviders = \Ezweb\Workflow\Providers\Type::getInstance();
            self::$operatorProvider = \Ezweb\Workflow\Providers\Operator::getInstance();
            self::$actionProvider = \Ezweb\Workflow\Providers\Action::getInstance();
            self::$initialized = true;
        }

        if (method_exists($this, 'initialize')) {
            $this->initialize();
        }
    }

    /**
     * @param self[] $elements
     * @return string
     */
    protected function hash(array $elements)
    {
        $hashes = [];
        foreach ($elements as $value) {
            $hashes[] = $value->getHash();
        }
        sort($hashes, SORT_STRING);
        return md5($this->getName() . '.' . implode('.', $hashes));
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

    /**
     * @return static
     */
    abstract public static function create(): self;

    /**
     * @return string
     */
    abstract public function getHash(): string;

    /**
     * @return array
     */
    abstract public function getJSONData(): ?array;

    /**
     * @param mixed[] $vars
     * @param array $childrenValues
     * @return mixed
     */
    abstract protected function getResult(array $vars, array $childrenValues);

    /**
     * @return string
     */
    abstract public function __toString(): string;

    // Is this Element call valid?
    abstract protected function isValid(): bool;
}
