<?php

namespace Framework\DependencyInjectionContainer;

use Framework\Kernel\Kernel;
use Service\Geocoding\GeocoderFactory;

class ServiceDefinition
{
    public function __construct(protected Kernel $kernel)
    {
        $definitions = [
            'google.geocoding' => function () {
                return GeocoderFactory::createGeocoder('google', $this->kernel->getEnv()->get('GOOGLE_API_KEY'));
            },
            'osm.geocoding' => function () {
                return GeocoderFactory::createGeocoder('osm');
            }
        ];

        $container = Container::getInstance();
        foreach ($definitions as $serviceName => $definition) {
            $container->set($serviceName, $definition);
        }
    }
}