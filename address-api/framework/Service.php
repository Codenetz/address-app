<?php

namespace Framework;

class Service
{
    public function __construct(protected string $name, protected string $serviceClass)
    {
    }
}