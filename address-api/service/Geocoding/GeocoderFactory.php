<?php

namespace Service\Geocoding;

use Service\Geocoding\Providers\Google\GoogleMapsGeocoding;
use Service\Geocoding\Providers\OSM\OSMGeocoding;

class GeocoderFactory
{
    public static function createGeocoder($strategyType, $apiKey = null) {
        switch ($strategyType) {
            case 'google':
                return new GoogleMapsGeocoding($apiKey);
            case 'osm':
                return new OSMGeocoding();
            default:
                throw new \InvalidArgumentException("Invalid strategy type");
        }
    }
}