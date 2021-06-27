<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plate extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'restaurant_id',
        'name',
        'description',
        'image',
        'price',
        'visible',
    ];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class);
    }
}
