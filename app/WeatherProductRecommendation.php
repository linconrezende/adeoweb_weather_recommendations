<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeatherProductRecommendation extends Model
{
    protected $fillable = ['product_id', 'weather_condition_id'];

    // The attributes excluded from the model's JSON
    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];
    
}
