<?php

namespace App\Http\Controllers;

use App\Models\Truyen_VanDe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TruyenVanDeController extends Controller{
    public static function add(Request $request){
        $problem = new Truyen_VanDe();
        $problem->truyen_id = $request->truyen_id;
        $problem->user_id = $request->user_id;
        $problem->problem = $request->problem;
        $problem->save();

        TruyenController::updateVanDe($request->truyen_id, 1);
    }

    public static function show($truyen_id, $num){
        return Truyen_VanDe::where('truyen_id', $truyen_id)
            ->where('check', 'N')
            ->paginate($num);
    }

    public static function updateStatus(Request $request){
        $problem = Truyen_VanDe::find($request->id);
        $problem->check = 'Y';
        $problem->save();
        TruyenController::updateVanDe($problem->truyen_id, -1);
    }

    public static function getForUser(){
        return Truyen_VanDe::where('user_id', Auth::user()->id)
        ->where('check', 'N')
        ->orderBy('created_at', 'desc')
        ->paginate(5);
    }
}
