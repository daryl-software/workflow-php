<?php

namespace Ezweb\Workflow\Providers;

abstract class Element
{
    /**
     * @var mixed[]
     */
    protected static array $instance = [];
    /**
     * @var mixed[]
     */
    protected array $registeredElement = [];

    abstract public static function getProviderType(): string;

    final protected function __construct()
    {
    }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        $providerType = static::getProviderType();
        if (!is_a($providerType, \Ezweb\Workflow\Elements\Element::class, true)) {
            throw new \RuntimeException('Cannot get instance of ' . $providerType . ' provider');
        }

        if (!isset(static::$instance[$providerType])) {
            static::$instance[$providerType] = new static();
        }

        return static::$instance[$providerType];
    }

    /**
     * @param string $element
     * @return $this
     */
    public function register(string $element): self
    {
        // get provider instance type
        $providerType = static::getProviderType();
        // check if we can register this type of element
        if (!is_a($element, $providerType, true)) {
            throw new \InvalidArgumentException(
                'To register an ' . $providerType . ', you must extends ' . $providerType
            );
        }
        // then register it
        /** @var \Ezweb\Workflow\Elements\Element $element */
        $this->registeredElement[$providerType][$element::getName()] = $element;
        return $this;
    }

    /**
     * @param \Ezweb\Workflow\Elements\Element $element
     * @return static
     */
    public function unregister(\Ezweb\Workflow\Elements\Element $element): self
    {
        // get provider instance type
        $providerType = static::getProviderType();
        // check if we can unregister this type of element
        if (!is_a($element, $providerType)) {
            //todo : add some suitable text
            throw new \InvalidArgumentException(
                'Cannot unregister ' . get_class($element) . ' from ' . $providerType . ' provider'
            );
        }

        if (isset($this->registeredElement[$providerType][$element::getName()])) {
            unset($this->registeredElement[$providerType][$element::getName()]);
        }
        return $this;
    }

    /**
     * @param string $element
     * @return string
     */
    public function getClass(string $element): string
    {
        if (!isset($this->registeredElement[static::getProviderType()][$element])) {
            throw new \RuntimeException('Class "' . $element . '" is not registered');
        }
        return $this->registeredElement[static::getProviderType()][$element];
    }
}
