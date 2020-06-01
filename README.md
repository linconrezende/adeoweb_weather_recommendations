# AdeoWeb Weather Recommendations
Simple REST API which returns product recommendations depending on current weather on Lithuanian cities.
URL: GET /api/products/recommended/:city
# DEMO
http://adeoweb.linconrezende.a2hosted.com/api/products/recommended/kaunas

## About the project
https://laravel.com/

This project is part of the selection process to work for [Adeo Web](https://www.adeoweb.biz/)

It was fun doing it. Laravel is a very powerful framework, the project is working but still a lot of features that I could do. Of course, it's allways a matter of time.
I did this project to demonstrate my skills with Laravel.
I never took any course, I just read the Laravel manual and learned from mistakes. I still have a lot to learn and I'm always reading the news, each new version of Laravel is a different surprise.
To reproduce exactly the same result that I have today, I would use Lumen insted of Laravel, just because it's too simple but anyways I didn't know the scalability of this project so I did what was asked.

## Weather API
Using https://api.meteo.lt/

## Example city names: https://api.meteo.lt/v1/places
**abromiskes** | **acokavai** | **adakavas** | **adomyne** | **adutiskis** | **agluonai** | **agluonenai** | **aistiskiai** | **aizkraukle** | **akademija** | **akademija**-2 | **aklasis**-ezeras | **akmene** | **akmene**-ii | **akmene**-iii | **akmeniskes** | **akmenynai** | **akmenyne**

## API call example
GET /api/products/recommended/akademija-2

## Installation
### REQUIREMENTS
PHP >= 7.3 AND database connection
### Clone folder:
git clone https://github.com/linconrezende/adeoweb_weather_recommendations

### Install dependencies:
composer install

### Configuration
Create a copy of the .env.example file and change it accordingly
(database connection)

### Generate a new key
php artisan key:generate

### Migrate database:
php artisan migrate

### Seed weather conditions:
php artisan db:seed --class=WeatherConditionSeeder

### Seed demo data made with faker:
php artisan db:seed --class=WeatherProductRecommendationSeeder

### Serve application
php artisan serve


