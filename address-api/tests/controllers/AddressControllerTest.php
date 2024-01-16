<?php

namespace tests\controllers;

use Address\Controller\AddressController;
use Definition\Services;
use Framework\Controller;
use Framework\DependencyInjectionContainer\Container;
use Framework\DependencyInjectionContainer\ServiceDefinition;
use Framework\Env;
use Framework\Kernel\HttpKernel;
use Framework\Request;
use Framework\Response;
use PHPUnit\Framework\TestCase;

class AddressControllerTest extends TestCase
{
    public function testAddressController()
    {
        $controller = new AddressController();
        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function testGetCords()
    {
        $httpKernel = new HttpKernel(new Env(__DIR__ . '/../../.env'));
        $httpKernel->setRequest(new Request());
        $httpKernel->setResponse(new Response());

        $container = Container::getInstance();

        $services = (new Services($httpKernel))->getDefinitions();
        foreach ($services as $serviceName => $definition) {
            $container->set($serviceName, $definition);
        }

        $controller = new AddressController();

        ob_start();
        $controller->getCords($httpKernel);
        $output = ob_get_clean();

        $this->assertEquals(true, is_array(json_decode($output, true)));

    }
}