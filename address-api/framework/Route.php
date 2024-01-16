<?php

namespace Framework;

class Route
{
    public function __construct(protected string $method, protected string $path, protected string $controller, protected string $action)
    {
    }

    public function getArgs(): array
    {
        return [];
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }
}