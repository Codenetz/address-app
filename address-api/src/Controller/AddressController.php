<?php

namespace Address\Controller;

use Address\Services\GeocodingService;
use Framework\Controller;
use Framework\DependencyInjectionContainer\Container;
use Framework\Kernel\HttpKernel;
use Service\Geocoding\GeocoderFactory;
use Service\Geocoding\Interface\GeocodingResponseInterface;
use Service\Geocoding\Interface\GeocodingStrategyInterface;

/**
 *
 */
class AddressController extends Controller
{
    /**
     * @param HttpKernel $httpKernel
     * @return void
     * @throws \Exception
     */
    public function getCordsFromDefault(HttpKernel $httpKernel)
    {
        $request = $httpKernel->getRequest();
        $address = $request->get('address');

        /** @var GeocodingService $defaultGeocoding */
        $defaultGeocoding = Container::getInstance()->get('default.geocoding');

        $cords = $defaultGeocoding->getCordinatesFromAddress($address);

        $httpKernel->getResponse()->contentOk()->jsonResponse([
            $cords?->getLat(),
            $cords?->getLng()
        ]);
    }

    /**
     * @param HttpKernel $httpKernel
     * @return void
     * @throws \Exception
     */
    public function getCords(HttpKernel $httpKernel)
    {
        $request = $httpKernel->getRequest();
        $address = $request->get('address');

        $googleMapsGeocodingService = Container::getInstance()->get('google.geocoding');
        $osmGeocodingService = Container::getInstance()->get('osm.geocoding');

        /** @var GeocodingResponseInterface $googleMapsGeocodingCords */
        $googleMapsGeocodingCords = $googleMapsGeocodingService->getCoordinates($address);

        /** @var GeocodingResponseInterface $osmGeocodingCords */
        $osmGeocodingCords = $osmGeocodingService->getCoordinates($address);

        $httpKernel->getResponse()->contentOk()->jsonResponse([
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

    /**
     * @param HttpKernel $kernel
     * @return \Framework\Response
     */
    public function test(HttpKernel $kernel)
    {
        return $kernel->getResponse()->contentCreated();
    }
}