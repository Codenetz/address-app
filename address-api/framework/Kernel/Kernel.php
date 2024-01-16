<?php

namespace Framework\Kernel;

use Framework\Env;

class Kernel
{
    public function __construct(protected Env $env)
    {
        $this->env->load();
    }

    public function getEnv(): Env
    {
        return $this->env;
    }

    public function setEnv(Env $env): void
    {
        $this->env = $env;
    }
}