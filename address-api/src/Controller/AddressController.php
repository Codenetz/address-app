<?php

namespace Address\Controller;

use Framework\Controller;
use Framework\DependencyInjectionContainer\Container;
use Framework\Kernel\HttpKernel;
use Service\Geocoding\Interface\GeocodingResponseInterface;
use Service\Geocoding\Providers\Google\GoogleMapsGeocodingResponse;

class AddressController extends Controller
{
    public function getCords(HttpKernel $kernel)
    {
        $request = $kernel->getRequest();

        /** @TODO Use VO */
        $address = $request->get('address');

        $googleMapsGeocodingService = Container::getInstance()->get('google.geocoding');
        $osmGeocodingService = Container::getInstance()->get('osm.geocoding');

        /** @var GeocodingResponseInterface $googleMapsGeocodingCords */
        $googleMapsGeocodingCords = $googleMapsGeocodingService->getCoordinates($address);

        /** @var GeocodingResponseInterface $osmGeocodingCords */
        $osmGeocodingCords = $osmGeocodingService->getCoordinates($address);

        $kernel->getResponse()->contentOk()->jsonResponse([
            'google_geocoding' => [
                $googleMapsGeocodingCords?->getLat(),
                $googleMapsGeocodingCords?->getLng()
            ],
            'osm_geocoding' => [
                $osmGeocodingCords?->getLat(),
                $osmGeocodingCords?->getLng()
            ]
        ]);
    }
}