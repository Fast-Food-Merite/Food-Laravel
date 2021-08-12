<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function all(){
        $category = Category::all();

        return $category;
    }

    public function search($id){
        $category = Category::find($id)->food()->get();

        return $category;
    }
        
    
}
