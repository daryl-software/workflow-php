<?php

namespace Ezweb\Workflow\Types\Providers;


class TypeProvider
{
    private static ?self $instance = null;

    private function __construct()
    {
    }

    /**
     * @var array<string>
     */
    private array $registredTypes = [];

    /**
     * @param string $typeClass
     * @return self
     */
    public function register(string $typeClass): self
    {
        if (!is_a($typeClass, \Ezweb\Workflow\Types\Type::class, true)) {
            //@TODO make an exception
        }
        $this->registredTypes[$typeClass::getType()] = $typeClass;
        return $this;
    }

    /**
     * @param string $type
     * @return self
     */
    public function unregister(string $type): self
    {
        if (isset($this->registredTypes[$type::getType()])) {
            unset($this->registredTypes[$type::getType()]);
        }
        return $this;
    }

    /**
     * @param string $type
     * @return string|null
     */
    public function getClassFromType(string $type): ?string
    {
        return $this->registredTypes[$type] ?? null;
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}