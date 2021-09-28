<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadImgController extends Controller
{
    public function index(Request $req){

        $data = Storage::put('/public', $req->image);

        return response([
            "code" => "success",
            "url" => Storage::url($data)
        ], 200) ;

    }
}
