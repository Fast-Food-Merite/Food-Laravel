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

        // $food = Food::all();

        $food = Food::with('category')->get(); 
        if($food->count() < 1) {
            return response([
                'success' => false,
                'message' => 'There are no food!'
            ]);
        }else {
            return response([
                'success' => true,
                'data' => $food,
                'message' => 'Succefully retreived all food!'
            ]);
        }
    }

    // get one food
    public function One($id)
    {
        // $response = DB::select('select * from food where id = ?',[$id]);
        // $response = DB::table('food')->where("id", '=', $id)->get();
        $response = Food::find($id);
       
        return $response;
    }

    // create food
    public function Create(Request $req)
    {
        if ($req->filled(['category_id', 'price', 'name', 'description', 'image',])) {
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
                    'category_id' => $req->category_id,
                    'name' => $req->name,
                    'price' => $req->price,
                    'description' => $req->description,
                    'image' => $req->image,
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
        if ($req->filled(['price', 'name', 'description', 'image',])) {
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

                // $food->category_id = $req->category_id;
                $food->name = $req->name;
                $food->price = $req->price;
                $food->description = $req->description;
                $food->image = $req->image;

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

    // recuperer les pizza
    public function pizza()
    {
        $pizza = Food::where('category_id', '1')->get();
        return $pizza;
    }

    // recuperer des burger
    public function burger()
    {
        $burger = Food::where('category_id', '2')->get();
        return $burger;
    }

    // recuperer des cocktails
    public function cocktail()
    {
        $cocktail = Food::where('category_id', '3')->get();
        return $cocktail;
    }

    // speciality
    public function speciality(){
        $speciality = Food::where('category_id', '1')->take(3)->get();
        return $speciality;
    }
}