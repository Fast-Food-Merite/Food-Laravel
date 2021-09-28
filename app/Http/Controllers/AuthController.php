<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        if (!$user) {
            return response([
                "status" => "error",
                "message" => "Cet utilisateur n'existe pas",
            ], 404);
        } else if (!Hash::check($request->password, $user->password)) {
            return response([
                "status" => "error",
                "message" => "Votre mot de passe est incorrecte",
            ], 403);
        }

        return response([
            "status" => "success",
            "message" => "vous etes connecte",
            "token" => $user->createToken("token")->plainTextToken,
            "data" => $user,
            "ip" => $request->ip(),
        ], 202);
    }

    public function signUp(Request $req)
    {

        $user = User::create([
            "name" => $req->name,
            "email" => $req->email,
            "password" => bcrypt($req->password),
            "role_id" => "2",
        ]);

        if ($user) {
            return response([
                'status' => 'reussite',
                'message' => 'compte crée'
            ], 202);
        } else {
            return [
                'status' => 'champ manquent ou email repetitif',
                'message' => 'erronnee',
            ];
        }
    }

    public function admin(Request $req)
    {

        $user = User::create([
            "name" => $req->name,
            "email" => $req->email,
            "password" => bcrypt($req->password),
            "role_id" => "1",
        ]);

        if ($user) {
            return [
                'status' => 'reussite',
                'message' => 'utilisateur cree'
            ];
        } else {
            return [
                'status' => 'champ manquent ou email repetitif',
                'message' => 'erronnee',
            ];
        }
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            $delete = $user->delete();

            if ($delete) {
                return [
                    'code' => "succes",
                    'message' => "ca marche",
                ];
            } else {
                return [
                    'code' => "default",
                    'message' => "ca marche pas",
                ];
            }
        } else {
            return [
                'code' => "error",
                'message' => "L'élément n'existe plus",
            ];
        }
    }

    public function One($id)
    {
        $response = User::find($id);
        if ($response) {
            return response([
                'status' => 'reussite',
                'message' => 'compte crée',
                'data' =>  $response->contact
            ], 202);
        } else {
            return [
                'status' => 'champ manquent ou email repetitif',
                'message' => 'erronnee',
            ];
        }

    }
}
