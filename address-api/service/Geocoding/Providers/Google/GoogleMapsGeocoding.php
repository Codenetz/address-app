<?php

namespace Service\Geocoding\Providers\Google;

use Service\Geocoding\Interface\GeocodingStrategyInterface;

class GoogleMapsGeocoding implements GeocodingStrategyInterface
{
    const GOOGLE_GEOCODE_API = "https://maps.googleapis.com/maps/api/geocode/json?address=%s&key=%s";

    public function __construct(protected string $apiKey)
    {
    }

    public function getCoordinates($address): ?GoogleMapsGeocodingResponse
    {
        $response = file_get_contents(sprintf(self::GOOGLE_GEOCODE_API, $address, $this->apiKey));
        $data = json_decode($response);

        if ($data->status === "OK")
            return new GoogleMapsGeocodingResponse($data->results[0]->geometry->location->lat, $data->results[0]->geometry->location->lng);

        return null;
    }
}