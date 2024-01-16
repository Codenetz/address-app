<?php

namespace Service\Geocoding\Providers\Google;

use Service\Geocoding\Interface\GeocodingResponseInterface;

class GoogleMapsGeocodingResponse implements GeocodingResponseInterface
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