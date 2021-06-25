<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id', 
        'name',
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
