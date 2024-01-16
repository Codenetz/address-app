<?php

namespace Framework\DependencyInjectionContainer;

class Container
{
    private static Container $instance;

    private array $services = [];

    private function __construct()
    {
    }

    public static function getInstance(): Container
    {
        if (!isset(self::$instance))
            self::$instance = new self();

        return self::$instance;
    }

    public function get($id)
    {
        if (!$this->has($id))
            throw new \Exception("Service $id not found.");

        return $this->services[$id]();
    }

    public function has($id): bool
    {
        return isset($this->services[$id]);
    }

    public function set($id, callable $serviceDefinition): void
    {
        $this->services[$id] = $serviceDefinition;
    }

    public function getServices(): array
    {
        return $this->services;
    }
}