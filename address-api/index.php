<?php
require __DIR__ . '/vendor/autoload.php';

use Framework\DependencyInjectionContainer\Container;
use Framework\Kernel\HttpKernel;
use Definition\Routes;
use Definition\Services;
use Framework\Env;
use Framework\Request;
use Framework\Response;
use Framework\Resolver\ControllerResolver;
use Framework\DependencyInjectionContainer\ServiceDefinition;

$httpKernel = new HttpKernel(new Env(__DIR__ . '/.env'));
$httpKernel->setRequest(new Request());
$httpKernel->setResponse(new Response());

$container = Container::getInstance();

$services = (new Services($httpKernel))->getDefinitions();
foreach ($services as $serviceName => $definition) {
    $container->set($serviceName, $definition);
}

$controllerResolver = new ControllerResolver((new Routes($httpKernel))->getDefinitions(), $httpKernel);

ob_start();
$controllerResolver->resolveController();
ob_end_flush();