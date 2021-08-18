<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signIn(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return [
                "message" => "informations erronees",
            ];
        }

        return $user->createToken("token")->plainTextToken;

    }

    public function signUp(Request $req)
    {

       $user = User::create([
           "email" => $req->email,
           "password" => bcrypt($req->password),
           "role_id" => "1",
       ]);

       return $user;

    }
}
