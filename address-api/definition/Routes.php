<?php

namespace Definition;

use Framework\Kernel\Kernel;
use Framework\Route;
use Address\Controller\AddressController;

class Routes
{
    public function __construct(protected Kernel $kernel)
    {
    }

    /** Defines endpoints */
    public function getDefinitions(): array
    {
        return [
            new Route('GET', '/get-cords', AddressController::class, 'getCords'),
            new Route('GET', '/get-cords-from-default', AddressController::class, 'getCordsFromDefault'),
            new Route('GET', '/test', AddressController::class, 'test'),
        ];
    }
}

