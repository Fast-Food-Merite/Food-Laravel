<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "commande_id",
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function commande(){
        return $this->belongsTo(Commande::class);
    }
}
