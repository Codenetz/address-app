<?php

namespace Service\Geocoding\Providers\OSM;

use Service\Geocoding\Interface\GeocodingResponseInterface;
use Service\Geocoding\Interface\GeocodingStrategyInterface;

class OSMGeocoding implements GeocodingStrategyInterface
{
    const OSM_GEOCODE_API = "https://nominatim.openstreetmap.org/search?format=json&q=%s";

    public function getCoordinates($address): ?GeocodingResponseInterface
    {
        $address = trim($address ?? '');

        if(mb_strlen($address, 'UTF-8') === 0)
            return null;

        $options = [
            'http' => [
                'header' => "User-Agent: Example-address-app",
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents(sprintf(self::OSM_GEOCODE_API, urlencode($address)), false, $context);

        $data = json_decode($response);

        if (!empty($data) && isset($data[0]))
            return new OSMGeocodingResponse($data[0]->lat, $data[0]->lon);

        return null;
    }
}