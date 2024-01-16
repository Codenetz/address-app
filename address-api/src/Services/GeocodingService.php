<?php

namespace Address\Services;

use Service\Geocoding\Interface\GeocodingResponseInterface;
use Service\Geocoding\Interface\GeocodingStrategyInterface;

class GeocodingService
{
    public function __construct(protected GeocodingStrategyInterface $geocoding)
    {
    }

    public function getCordinatesFromAddress($address): ?GeocodingResponseInterface
    {
        return $this->geocoding->getCoordinates($address);
    }
}