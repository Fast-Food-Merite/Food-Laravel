<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Throwable;

class ContactController extends Controller
{
    public function contact(Request $req)
    {
        if ($req->filled(["name", "prenom", "adresse", "tel", "user_id"])) {
            try {

                // $req->validate([
                //     'tel' => 'required|numeric|min:8|max:11',
                // ]);

                $contact = Contact::create([
                    "name" => $req->name,
                    "prenom" => $req->prenom,
                    "adresse" => $req->adresse,
                    "tel" => $req->tel,
                    "user_id" => $req->user_id
                ]);
            } catch (Throwable $e) {
                return [
                    "code" => "error",
                    "message" => $e->getMessage(),
                    "error" => $e,
                ];
            }
            if ($contact) {
                return response([
                    'status' => 'reussite',
                    'message' => 'donnees de facturation enregistres'
                ], 202);
            } else {
                return [
                    'status' => 'champ manquant ou email repetitif',
                    'message' => 'verifiez les champs que vous avez rempli',
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
