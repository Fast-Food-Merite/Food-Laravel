<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_id',
        'user_id',
        'validation',
        'commandeDate',
        'price',
        'number'

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function food(){
        return $this->belongsTo(Food::class);
    }

    public function paiement(){
        return $this->hasOne(Paiement::class);
    }
}
