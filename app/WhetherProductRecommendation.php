<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WhetherProductRecommendation extends Model
{
    protected $fillable = ['product_id', 'whether_condition_id'];

    // The attributes excluded from the model's JSON
    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];
    
}
