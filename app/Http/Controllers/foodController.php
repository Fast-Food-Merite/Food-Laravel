<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class foodController extends Controller
{
    // get all food
    public function All()
    {

        // $food = DB::table('food')->get();

        $food = Food::all();

        return $food;
    }

    // get one food
    public function One($id)
    {
        // $response = DB::select('select * from food where id = ?',[$id]);
        $response = DB::table('food')->where("id", '=', $id)->get();

        return $response;
    }

    // create food
    public function Create(Request $req)
    {

        if ($req->filled(['type', 'price', 'name', 'description', 'image', 'animation'])) {
            try {
                // $response = DB::table('food')->insert([
                //     'type' => $req->type,
                //     'price' => $req->price,
                //     'name' => $req->name,
                //     'description' => $req->description,
                //     'image' => $req->image,
                //     'animation' => $req->animation,
                // ]);

                // $food = new Food;

                // instanciation
                // $food->type = $req->type;
                // $food->name = $req->name;
                // $food->price = $req->price;
                // $food->description = $req->description;
                // $food->image = $req->image;
                // $food->animation = $req->animation;

                // $food->save();

                // create
                $food = Food::create([
                    'type' => $req->type,
                    'name' => $req->name,
                    'price' => $req->price,
                    'description' => $req->description,
                    'image' => $req->image,
                    'animation' => $req->animation,
                ]);
            } catch (Throwable $e) {
                return [
                    "code" => "error",
                    "message" => $e->getMessage(),
                ];
            }


            if ($food) {
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

    // update food
    public function Update(Request $req, $id)
    {
        if ($req->filled(['type', 'price', 'name', 'description', 'image', 'animation'])) {
            try {
                // $update = DB::table('food')
                //     ->where('id', $id)
                //     ->update([
                //         'type' => $req->type,
                //         'name' => $req->name,
                //         'price' => $req->price,
                //         'description' => $req->description,
                //         'image' => $req->image,
                //         'animation' => $req->animation,
                //     ]);
                $food = Food::find($id);

                $food->type = $req->type;
                $food->name = $req->name;
                $food->price = $req->price;
                $food->description = $req->description;
                $food->image = $req->image;
                $food->animation = $req->animation;

                $food->save();
            } catch (Throwable $e) {
                return [
                    "code" => "error",
                    "message" => $e->getMessage(),
                ];
            }
            if ($food) {
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
                'code' => 'validation erronne',
                'message' => 'voir les donnees entrees',
            ];
        }
    }

    // delete food
    public function Delete($id)
    {
        // $delete = DB::table('food')->where('id', '=', $id)->delete();
        $food = Food::find($id);

        if ($food) {
            $delete = $food->delete();

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
}
