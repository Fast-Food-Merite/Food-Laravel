<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'prenom',
        'adresse',
        'tel',
        'age',  
        'user_id' 
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
