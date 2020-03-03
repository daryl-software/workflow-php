<?php

namespace Ezweb\Workflow\InternalFunction\Providers;


class InternalFunctionProvider
{
    private static ?self $instance = null;

    private function __construct()
    {
    }

    /**
     * @var array<string>
     */
    private array $registeredOperators = [];

    /**
     * @param string $internalFunctionClassname
     * @return self
     */
    public function register(string $internalFunctionClassname): self
    {
        if (!is_a($internalFunctionClassname, \Ezweb\Workflow\InternalFunction\InternalFunction::class, true)) {
            //@TODO make an exception
        }
        $this->registeredOperators[$internalFunctionClassname::getName()] = $internalFunctionClassname;
        return $this;
    }

    /**
     * @param \Ezweb\Workflow\Operators\Operator $type
     * @return self
     */
    public function unregister(\Ezweb\Workflow\Operators\Operator $type): self
    {
        if (isset($this->registeredOperators[$type::getOperator()])) {
            unset($this->registeredOperators[$type::getOperator()]);
        }
        return $this;
    }

    /**
     * @param string $internalFunction
     * @return string|null
     */
    public function getClassFromInternalFunction(string $internalFunction): ?string
    {
        return $this->registeredOperators[$internalFunction] ?? null;
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}