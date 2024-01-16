<?php

namespace Service\Geocoding\Providers\OSM;

use Service\Geocoding\Interface\GeocodingResponseInterface;

class OSMGeocodingResponse implements GeocodingResponseInterface
{
    public function __construct(protected $lat, protected $lng)
    {
    }

    public function getLat(): string
    {
        return (string)$this->lat;
    }

    public function getLng(): string
    {
        return (string)$this->lng;
    }
}