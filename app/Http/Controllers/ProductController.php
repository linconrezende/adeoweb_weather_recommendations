<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\WhetherCondition;

class ProductController extends Controller
{
    public function index(Request $request) {
        // For now it will have a fixed limit of 1000.
        $lst = Product::limit(1000)->get();
        return response()->json(['data' => $lst], 200);
    }
    public function currentWhetherRecommendationsByCity(Request $request) {
        // TODO: Get current whether
        $cityName = $request->route()->parameters()['city'];

        $output = new \stdClass();
        $output->city = $cityName;
        $output->current_weather = 'heavy-snow'; // Get from the whether API
        $output->recommended_products = [];
        
        //Get condition from current whether
        $condition = WhetherCondition::where('name', '=', $output->current_weather)->get()->first();
        if (isset($condition)) {
            $output->recommended_products = Product::join('whether_product_recommendations', 'products.id', '=', 'whether_product_recommendations.product_id')
            ->select('products.sku', 'products.name', 'products.price')
            ->where('whether_product_recommendations.whether_condition_id', '=', $condition->id)
            ->get();
        }
        // $products = Product::where('');
        return response()->json($output, 200);
    }
}
