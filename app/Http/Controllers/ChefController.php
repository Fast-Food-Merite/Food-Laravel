<?php

namespace App\Http\Controllers;

use App\Models\Chefs;
use Illuminate\Http\Request;
use Throwable;

class ChefController extends Controller
{
    public function all(){
        $chefs = Chefs::all();

        return $chefs;
    }

    public function create(Request $req)
    {
        if ($req->filled([ 'name', 'role', 'image',])) {
            try {
                
                // create
                $chef = Chefs::create([
                    'name' => $req->name,
                    'role' => $req->role,
                    'image' => $req->image,
                ]);
            } catch (Throwable $e) {
                return [
                    "code" => "error",
                    "message" => $e->getMessage(),
                ];
            }


            if ($chef) {
                return [
                    'code' => "succes",
                    'message' => "ca marche",
                ];
            } else {
                return [
                    'error' => "donnees non envoyees ou mal envoyees"
                ];
            }
        } else {
            return [
                'code' => 'validation erronne',
                'message' => 'voir les donnees entrees',
            ];
        }
    }
}
