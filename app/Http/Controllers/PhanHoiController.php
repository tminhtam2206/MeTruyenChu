<?php

namespace App\Http\Controllers;

use App\Models\PhanHoi;
use Illuminate\Http\Request;

class PhanHoiController extends Controller{
    public static function add(Request $request){
        $phanhoi = new PhanHoi();
        $phanhoi->name = $request->name;
        $phanhoi->message = $request->message;
        $phanhoi->save();
    }

    public static function get($num){
        return PhanHoi::orderBy('created_at', 'desc')->paginate($num);
    }

    public static function getAll(){
        return PhanHoi::orderBy('created_at', 'desc')->get();
    }
}
