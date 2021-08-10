<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role'
    ];

    public function contact(){
        return $this->hasMany(Contact::class);
    }

    public function commande(){
        return $this->hasMany(Commande::class);
    }
}
