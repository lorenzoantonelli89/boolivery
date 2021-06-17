<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'user_id', 
        'restaurant',
        'address',
        'phone',
        'email',
        'description',
        'image_cover',
        'image_profile',
        'popular',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function plates(){
        return $this->hasMany(Plate::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
