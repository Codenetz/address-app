<?php

namespace Framework;

/**
 *
 */
class Env
{
    public function __construct(protected string $path)
    {
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function get($name): ?string
    {
        return $_ENV[$name] ?? null;
    }

    public function load(): void
    {
        if (!file_exists($this->path))
            throw new \RuntimeException('The .env file does not exist.');

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            if (strpos($line, '#') === 0 || trim($line) === '')
                continue;

            list($key, $value) = explode('=', $line, 2);

            $_ENV[trim($key)] = trim($value);
            $_SERVER[trim($key)] = trim($value);
        }
    }
}