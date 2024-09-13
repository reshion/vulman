## Pre-requisites

-   [Install Docker and Docker Compose](https://docs.docker.com/compose/install/)
-   If you are on windows, install [WSL2](https://docs.microsoft.com/en-us/windows/wsl/install)
-   Make sure WSL2 is running and set as default

## About Laravel

-   Install all dependencies and libraries after cloning. Check php83 image version.

```console
docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html laravelsail/php83-composer:latest composer install --ignore-platform-reqs
```

-   Import postgres backup inside Container

```console
pg_restore --dbname=vuldb --username=postgres --password --verbose  init-backup.sql
```

-   Xdebug launch setup

```console
{
    "version": "0.2.0",
    "configurations": [
        {
            "name": "SAIL - Listen for Xdebug ",
            "type": "php",
            "request": "launch",
            "port": 9003,
            "hostname": "0.0.0.0",
            "pathMappings": {
                "/var/www/html": "${workspaceFolder}/subfolder/"
            }
        }
    ]
}
```

-   Create alias for sail - Open .bashrc and add following line

```console
alias sail='bash vendor/bin/sail'
```

-   Run Laravel Backend

```console
sail up
```

-   Run the laravel backend in the background

```console
sail up -d
```

-   Run the laravel queue worker

```console
sail artisan queue:work
```

-   Open Swagger UI

```console
http://localhost/api/documentation
```

-   Show all routes from cmd

```console
sail artisan route:list
```

-   Regenerate Swagger Docs after changes in code

```console
sail artisan l5-swagger:generate
```

-   Get API documentation in JSON format

```console
http://localhost/api/documentation/json
```
