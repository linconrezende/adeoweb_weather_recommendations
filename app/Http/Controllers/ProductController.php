<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\WeatherCondition;

class ProductController extends Controller
{
    public function index(Request $request) {
        // For now it will have a fixed limit of 1000.
        $lst = Product::limit(1000)->get();
        return response()->json(['data' => $lst], 200);
    }
    public function currentWeatherRecommendationsByCity(Request $request) {
        // TODO: Get current weather
        $cityName = $request->route()->parameters()['city'];

        $output = new \stdClass();
        $output->city = $cityName;
        $output->current_weather = 'heavy-snow'; // Get from the weather API
        $output->recommended_products = [];
        
        //Get condition from current weather
        $condition = WeatherCondition::where('name', '=', $output->current_weather)->get()->first();
        if (isset($condition)) {
            $output->recommended_products = Product::join('weather_product_recommendations', 'products.id', '=', 'weather_product_recommendations.product_id')
            ->select('products.sku', 'products.name', 'products.price')
            ->where('weather_product_recommendations.weather_condition_id', '=', $condition->id)
            ->get();
        }
        // $products = Product::where('');
        return response()->json($output, 200);
    }
}
