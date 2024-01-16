<?php

namespace tests\service\Geocoding;

use PHPUnit\Framework\TestCase;
use Service\Geocoding\GeocoderFactory;
use Service\Geocoding\Providers\Google\GoogleMapsGeocoding;
use Service\Geocoding\Providers\OSM\OSMGeocoding;

class GeocoderFactoryTest extends TestCase
{
    public function testCreateGoogleGeocode()
    {
        $googleGeocoder = GeocoderFactory::createGeocoder('google', '');
        $this->assertInstanceOf(GoogleMapsGeocoding::class, $googleGeocoder);
    }

    public function testCreateOSMGeocode()
    {
        $googleGeocoder = GeocoderFactory::createGeocoder('osm', '');
        $this->assertInstanceOf(OSMGeocoding::class, $googleGeocoder);
    }
}