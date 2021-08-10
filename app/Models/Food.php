<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'animation',
        'type',
        'image',
        'description',
        'category_id',
        'restaurant_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
}
