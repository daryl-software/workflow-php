<?php

namespace Ezweb\Workflow\Operators\Providers;



class OperatorProvider
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
     * @param string $operatorClassname
     * @return self
     */
    public function register(string $operatorClassname): self
    {
        if (!is_a($operatorClassname, \Ezweb\Workflow\Operators\Operator::class, true)) {
            //@TODO make an exception
        }
        $this->registeredOperators[$operatorClassname::getOperator()] = $operatorClassname;
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
     * @param string $operator
     * @return string|null
     */
    public function getClassFromOperator(string $operator): ?string
    {
        return $this->registeredOperators[$operator] ?? null;
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}