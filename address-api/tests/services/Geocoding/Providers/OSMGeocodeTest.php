<?php

namespace tests\service\Geocoding\Providers;

use PHPUnit\Framework\TestCase;
use Service\Geocoding\Interface\GeocodingResponseInterface;
use Service\Geocoding\Interface\GeocodingStrategyInterface;
use Service\Geocoding\Providers\OSM\OSMGeocoding;

class OSMGeocodeTest extends TestCase
{
    public function testAddressToCords()
    {
        $geoCoder = new OSMGeocoding();
        $this->assertInstanceOf(GeocodingStrategyInterface::class, $geoCoder);
        $this->assertInstanceOf(GeocodingResponseInterface::class, $geoCoder->getCoordinates('Sofia'));
        $this->assertEquals(null, $geoCoder->getCoordinates('Tatooine earth'));
        $this->assertInstanceOf(GeocodingResponseInterface::class, $geoCoder->getCoordinates('     Sofia     '));
        $this->assertEquals(null, $geoCoder->getCoordinates('        '));
    }
}