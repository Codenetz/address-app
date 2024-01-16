<?php

namespace Framework;

/**
 *
 */
class Request
{
    /**
     * @return string
     */
    public function getRequestURI(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getRequestHttpMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return parse_url($this->getRequestURI())['path'];
    }

    /**
     * @return array
     */
    public function getQuery(): array
    {
        return $_GET;
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return $_POST;
    }

    public function get($param): string|int|float|null
    {
        return $this->getQuery()[$param] ?? $this->getPayload()[$param] ?? null;
    }
}