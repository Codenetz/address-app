<?php

namespace Definition;

use Address\Services\GeocodingService;
use Framework\Kernel\Kernel;
use Service\Geocoding\GeocoderFactory;

class Services
{
    public function __construct(protected Kernel $kernel)
    {
    }

    /** Defines services */
    public function getDefinitions(): array
    {
        $geocoders = [
            'google.geocoding' => function () {
                return GeocoderFactory::createGeocoder('google', $this->kernel->getEnv()->get('GOOGLE_API_KEY'));
            },
            'osm.geocoding' => function () {
                return GeocoderFactory::createGeocoder('osm');
            }
        ];

        $defaultGeocoder = [
            'default.geocoding' => function () use ($geocoders) {
                if (!isset($geocoders[$this->kernel->getEnv()->get('DEFAULT_GEOCODING_API') . '.geocoding']))
                    throw new \Exception('Geocoding strategy cannot be found');

                return new GeocodingService($geocoders[$this->kernel->getEnv()->get('DEFAULT_GEOCODING_API') . '.geocoding']());
            }
        ];

        return [
            ...$geocoders,
            ...$defaultGeocoder
        ];
    }
}