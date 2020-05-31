<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\WeatherCondition;
use App\Http\Controllers\WeatherController;

class ProductController extends Controller
{
    public function index(Request $request) {
        // For now it will have a fixed limit of 1000.
        $lst = Product::limit(1000)->get();
        return response()->json(['data' => $lst, 'source' => 'Weather information source: LHMT meteo.lt'], 200);
    }
    public function currentWeatherRecommendationsByCity(Request $request) {
        // Get city name from route params
        $cityName = $request->route()->parameters()['city'];
        // Initialize condition code
        $conditionCode = '';
        // Initialize output object
        $output = new \stdClass();
        // Initialize wether controller so we can use its function
        $wController = new WeatherController();
        // Initialize weatherInfo, which will be the result from the weather controller's function
        $weatherInfo = null;

        try {
            $weatherInfo = $wController->getForecastArea($cityName); // It will be long-term for default
            $weatherInfo = json_decode($weatherInfo);
            if (count($weatherInfo->forecastTimestamps) > 0) {
                $conditionCode = $weatherInfo->forecastTimestamps[0]->conditionCode;
            }
        } catch (\Exception $ex) {
            $jsfmt = $ex->getMessage();
            try {
                $jsfmt = json_decode($jsfmt); // try to get json from the string.
                return response()->json($jsfmt, $ex->getCode());
            } catch (\Throwable $th) {
                // If we can't, ignore it, and just pass the string as error message
                return response()->json(['data' => $jsfmt], $ex->getCode());
            }
        }

        //Get condition from current weather
        $condition = WeatherCondition::where('name', '=', $conditionCode)->get()->first();

        // Set up our output variable with all informations we need
        $output->city = $cityName;
        $output->current_weather = $conditionCode; // Got from the weather controller
        $output->recommended_products = [];
        if (isset($condition)) {
            $output->recommended_products = Product::join('weather_product_recommendations', 'products.id', '=', 'weather_product_recommendations.product_id')
            ->select('products.sku', 'products.name', 'products.price')
            ->where('weather_product_recommendations.weather_condition_id', '=', $condition->id)
            ->get();
        }
        return response()->json(['data' => $output, 'source' => 'Weather information source: LHMT meteo.lt'], 200);
    }
}
