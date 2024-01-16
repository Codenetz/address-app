<?php

namespace Service\Geocoding\Interface;

interface GeocodingStrategyInterface
{
    public function getCoordinates($address): ?GeocodingResponseInterface;
}