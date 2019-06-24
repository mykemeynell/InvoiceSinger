# InvoiceSinger Readme

## Setup with Docker

1. Clone the latest version of the InvoiceSinger repository from GitHub and 
change into that directory.

```$> git clone git@github.com:mykemeynell/InvoiceSinger.git```

```$> cd InvoiceSinger```

2. Copy the ```.env.example``` file to ```.env``` and update any credentials/details with:

```$> cp .env.example .env```

3. If you changed the ```MYSQL_ROOT_PASSWORD``` or ```MYSQL_DATABASE``` values in ```docker-compose.yml```, 
you should update the values in ```.env``` to match.

4. Install the required composer dependencies with:

```composer install```

5. Generate an application key using Artisan.

```$> php artisan key:generate```

6. Run ```docker-compose up``` to get the ```app```, ```mysql``` and ```webserver``` containers spun upp.

## Extras & Development

InvoiceSinger comes with [PHP Insights](https://phpinsights.com) - you can publish the vendor files using:


```$> php artisan vendor:publish --provider="NunoMaduro\PhpInsights\Application\Adapters\Laravel\InsightsServiceProvider"```

Run ```$> php artisan insights``` to get code quality, style, complexity and other metrics as you develop.

