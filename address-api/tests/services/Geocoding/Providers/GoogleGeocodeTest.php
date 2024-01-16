<?php

namespace tests\service\Geocoding\Providers;

use Framework\Env;
use PHPUnit\Framework\TestCase;
use Service\Geocoding\Interface\GeocodingResponseInterface;
use Service\Geocoding\Interface\GeocodingStrategyInterface;
use Service\Geocoding\Providers\Google\GoogleMapsGeocoding;

class GoogleGeocodeTest extends TestCase
{
    public function testAddressToCords()
    {
        $geoCoder = new GoogleMapsGeocoding('');
        $this->assertInstanceOf(GeocodingStrategyInterface::class, $geoCoder);
        $this->assertEquals(null, $geoCoder->getCoordinates('Sofia')); //null because no api key is provided

        $env = new Env(__DIR__ . '/../../../../.env');
        $geoCoder = new GoogleMapsGeocoding($env->get('GOOGLE_API_KEY'));
        $this->assertInstanceOf(GeocodingStrategyInterface::class, $geoCoder);
        $this->assertInstanceOf(GeocodingResponseInterface::class, $geoCoder->getCoordinates('Sofia'));
        $this->assertInstanceOf(GeocodingResponseInterface::class, $geoCoder->getCoordinates('     Sofia     '));
        $this->assertEquals(null, $geoCoder->getCoordinates('        '));
    }
}