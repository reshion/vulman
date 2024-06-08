## About Laravel

-   Install all dependencies and libraries after cloning. Check php83 image version.

```console
docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html laravelsail/php83-composer:latest composer install --ignore-platform-reqs
```

-   Import postgres backup inside Container

```console
pg_restore --dbname=vuldb --username=postgres --password --verbose  init-backup.sql
```

- Xdebug launch setup
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

