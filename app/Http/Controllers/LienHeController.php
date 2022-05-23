<?php

namespace App\Http\Controllers;

use App\Models\LienHe;
use Illuminate\Http\Request;

class LienHeController extends Controller{
    public static function add(Request $request){
        $lienhe = new LienHe();
        $lienhe->email = $request->email;
        $lienhe->message = $request->message;
        $lienhe->save();
    }

    public static function get($num){
        return LienHe::orderBy('created_at', 'desc')->paginate($num);
    }

    public static function getAll(){
        return LienHe::orderBy('created_at', 'desc')->get();
    }
}
