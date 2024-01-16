<?php

namespace Service\Geocoding\Providers\OSM;

use Service\Geocoding\Interface\GeocodingResponseInterface;
use Service\Geocoding\Interface\GeocodingStrategyInterface;

class OSMGeocoding implements GeocodingStrategyInterface
{

    public function getCoordinates($address): ?GeocodingResponseInterface
    {

        $request_url = "https://nominatim.openstreetmap.org/search?format=json&q=" . urlencode($address);

        $options = [
            'http' => [
                'header' => "User-Agent: Example-address-app",
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($request_url, false, $context);

        $data = json_decode($response);

        if (!empty($data) && isset($data[0]))
            return new OSMGeocodingResponse($data[0]->lat, $data[0]->lon);

        return null;
    }
}