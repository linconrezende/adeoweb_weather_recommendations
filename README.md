# AdeoWeb Weather Recommendations
Simple REST API which returns product recommendations depending on current weather on Lithuanian cities.
URL: GET /api/products/recommended/:city
## DEMO
(not yet available)

## Weather API
Using https://api.meteo.lt/

## Example city names: https://api.meteo.lt/v1/places
**abromiskes** | **acokavai** | **adakavas** | **adomyne** | **adutiskis** | **agluonai** | **agluonenai** | **aistiskiai** | **aizkraukle** | **akademija** | **akademija**-2 | **aklasis**-ezeras | **akmene** | **akmene**-ii | **akmene**-iii | **akmeniskes** | **akmenynai** | **akmenyne**

## API call example
GET /api/products/recommended/akademija-2

## Installation
### Clone folder:
git clone https://github.com/linconrezende/adeoweb_weather_recommendations

### Install dependencies:
composer install

### Migrate database:
php artisan migrate

### Seed weather conditions:
php artisan db:seed --class=WeatherConditionSeeder

### Seed demo data made with faker:
php artisan db:seed --class=WeatherProductRecommendationSeeder

### Serve application
php artisan serve


