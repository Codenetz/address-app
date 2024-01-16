<?php
require __DIR__ . '/vendor/autoload.php';

use Framework\Kernel\HttpKernel;
use Framework\Route;
use Framework\Env;
use Framework\Request;
use Framework\Response;
use Framework\Resolver\ControllerResolver;
use Framework\DependencyInjectionContainer\ServiceDefinition;

$httpKernel = new HttpKernel(new Env(__DIR__ . '/.env'));
$httpKernel->setRequest(new Request());
$httpKernel->setResponse(new Response());

new ServiceDefinition($httpKernel);

$controllerResolver = new ControllerResolver([
    new Route('GET', '/get-cords', Address\Controller\AddressController::class, 'getCords'),
    new Route('GET', '/test', Address\Controller\AddressController::class, 'getCords'),
], $httpKernel);

ob_start();
$controllerResolver->resolveController();
ob_end_flush();