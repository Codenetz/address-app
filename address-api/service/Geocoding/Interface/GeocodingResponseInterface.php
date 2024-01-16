<?php

namespace Service\Geocoding\Interface;

interface GeocodingResponseInterface
{
    public function getLat(): string;
    public function getLng(): string;
}