<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function search($id){
        $category = Category::find($id)->food()->get();

        return $category;
    }
        
    
}
