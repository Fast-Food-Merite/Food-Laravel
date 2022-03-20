<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class CommandeController extends Controller
{
    public function order(Request $req)
    {
        if ($req->filled('food_id', 'user_id', 'price', 'commandeDate', 'number')) {
            try {
                $commande = Commande::create([
                    'food_id' => $req->food_id,
                    'user_id' => $req->user_id,
                    'validation' => false,
                    'price' => $req->price,
                    'commandeDate' => $req->commandeDate,
                    'number' => $req->number
                ]);
            } catch (Throwable $e) {
                return [
                    "status" => "error",
                    "message" => "champ incomplet",
                    "erreur" => $e
                ];
            }

            if ($commande) {
                return [
                    'status' => "success",
                    'message' => "ca marche",
                ];
            } else {
                return [
                    'message' => "donnees non envoyees ou mal envoyees"
                ];
            }
        } else {
            return [
                'code' => 'validation erronne',
                'message' => 'voir les donnees entrees',
            ];
        }
    }

    public function getOrder()
    {

        $commande = Commande::with('user', 'food')->get();
        if ($commande->count() < 1) {
            return response([
                'success' => false,
                'message' => 'There are no posts!'
            ]);
        } else {
            return response([
                'success' => true,
                'data' => $commande,
                'message' => 'Succefully retreived all posts!'
            ]);
        }
    }

    public function delete($id)
    {
        $commande = Commande::find($id);

        if ($commande) {
            $delete = $commande->delete();

            if ($delete) {
                return [
                    'code' => "succes",
                    'message' => "effectue avec success",
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

    public function myOrder($id)
    {
        $commande = Commande::where('user_id', $id)->with('food')->get();

        if ($commande) {
            return response([
                'status' => 'commandes presentes',
                'message' => 'voici vos commandes',
                'data' => $commande
            ], 202);
        } else {
            return [
                'status' => 'pas de commandes',
                'message' => 'pas encore commander',
            ];
        }
    }

    public function One($id)
    {
        $commande = Commande::where('id', $id)->with('food', 'user')->get();
        if ($commande) {
            $int = $commande[0]->user_id;
            $contact = User::where('id', $int)->with('contact')->get();
            return response([
                'success' => true,
                'data' => $commande,
                'contact' => $contact,
                'message' => 'Succefully retreived all posts!'
            ]);
        } else {
            return response([
                'success' => false,
                'message' => 'There are no posts!'
            ]);
        }
    }

    public function validation($id, Request $req){
        if ($req->filled(['validation',])) {
            try {
                
                $commande = Commande::find($id);
                $commande->validation = $req->validation;

                $commande->save();
            } catch (Throwable $e) {
                return [
                    "code" => "error",
                    "message" => $e->getMessage(),
                ];
            }
            if ($commande) {
                return [
                    'code' => "succes",
                    'message' => "commande validee",
                ];
            } else {
                return [
                    'code' => "default",
                    'message' => "ca marche pas",
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
