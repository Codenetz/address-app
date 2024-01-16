# Set the environment

API
```sh
$ cp ./address-api/dist.env .env
$ cp ./address-api/dist.phpunit.xml phpunit.xml
```

UI
```sh
$ cp ./address-web-ui/dist.env .env
```

# Run the application

```sh
$ docker-compose up --build
```

# Run api tests

```sh
$ docker exec -it address-app_api_1 vendor/bin/phpunit tests
```

# Links

**[WEB UI]** http://localhost:8033

**[API]** http://localhost:8032

# API envs

`GOOGLE_API_KEY` Configures the Google geocode service.

`DEFAULT_GEOCODING_API` Configuring the `default.geocoding` service. Supports `google` or `osm`.

# How to add new geocode services
1. Create new provider inside `service/Geocoding/Providers`.
2. The geocoding service should implement the `GeocodingStrategyInterface`.
3. Open `service/Geocoding/GeocoderFactory` and register your provider.
4. [Optional] Open `definitions/Services` and register your provider as a service using the factory.  

# Endpoints

Gets address coordinates based on the default geocode service.
- [GET] `/get-cords-from-default?address=Sofia`

Gets address coordinates from Google and OSM.
- [GET] `/get-cords?address=Sofia`

# Author

Hristo Boyarov

hristo939393@gmail.com