<?php

namespace Ezweb\Workflow\Elements;

abstract class Element implements \JsonSerializable
{
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
        return md5(static::getName() . '.' . implode('.', $hashes));
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

    /**
     * Is this Element call valid?
     * @param array $vars
     * @param array $childrenValues
     * @return bool
     */
    abstract protected function isValid(array $vars, array $childrenValues): bool;
}
