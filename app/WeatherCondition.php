<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeatherCondition extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    // The attributes excluded from the model's JSON
    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];
}
