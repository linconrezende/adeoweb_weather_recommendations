<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WhetherProductRecommendation extends Model
{
    protected $fillable = [];

    // The attributes excluded from the model's JSON
    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];
    
}
