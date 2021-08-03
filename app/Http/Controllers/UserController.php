<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    public function Create(Request $req)
    {
        if ($req->filled('name', 'email', 'password')) {
            try {
                $user = User::create([
                    'name' => $req->name,
                    'email' => $req->email,
                    'password' => $req->password
                ]);
            } catch (Throwable $e) {
                return [
                    "code" => "error",
                    "message" => $e->getMessage(),
                ];
            }
            if ($user) {
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
