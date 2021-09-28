<?php

namespace App\Http\Controllers;

use App\Models\Commande;
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
        // $commande = Commande::find(1);
        // $commande = Commande::all();


        // $commande->user;
        // $commande->food;
        // $commande = Commande::with('users')->get();

        // foreach ($commande as $category) {
        //     $category->user;
        //     $category->food;
        //     return response([
        //         $category
        //     ]);
        // }
        $commande = Commande::with('user','food')->get(); 
        if($commande->count() < 1) {
            return response([
                'success' => false,
                'message' => 'There are no posts!'
            ]);
        }else {
            return response([
                'success' => true,
                'data' => $commande,
                'message' => 'Succefully retreived all posts!'
            ]);
        }
        // return response([
        //     $commande,
        // ]);
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
        $commande = Commande::find($id);
        $order = $commande->food;

        if ($order) {
            return response([
                'status' => 'commandes presentes',
                'message' => 'voici vos commandes',
                'data' => $order
            ], 202);
        } else {
            return [
                'status' => 'pas de commandes',
                'message' => 'pas encore commander',
            ];
        }
    }
}
