# Set the environment

```sh
$ cp ./address-api/dist.env .env
$ cp ./address-api/dist.phpunit.xml phpunit.xml
```

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

# Author

Hristo Boyarov

hristo939393@gmail.com