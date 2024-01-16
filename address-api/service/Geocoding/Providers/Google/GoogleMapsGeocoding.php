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
        $address = trim($address ?? '');

        if(mb_strlen($address, 'UTF-8') === 0)
            return null;

        $response = file_get_contents(sprintf(self::GOOGLE_GEOCODE_API, urlencode($address), urlencode(trim($this->apiKey))));
        $data = json_decode($response);

        if (!$data)
            return null;

        if ($data->status === "OK")
            return new GoogleMapsGeocodingResponse($data->results[0]->geometry->location->lat, $data->results[0]->geometry->location->lng);

        return null;
    }
}