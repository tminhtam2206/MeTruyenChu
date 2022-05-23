<?php

namespace App\Http\Controllers;

use App\Models\TruyenDanhGia;
use Illuminate\Http\Request;

class TruyenDanhGiaController extends Controller{
    public static function add(Request $request){
        $evaluate = new TruyenDanhGia();
        $evaluate->marks = $request->marks;
        $evaluate->content = $request->content;
        $evaluate->truyen_id = $request->truyen_id;
        $evaluate->user_id = $request->user_id;
        $evaluate->save();
    }

    public static function getMarks($truyen_id){
        $evaluate = TruyenDanhGia::where('truyen_id', $truyen_id)->get();
        $marks = 0;

        if(count($evaluate) == 0) return ['marks' => 0, 'num' => 0];
        else{
            foreach($evaluate as $val){
                $marks += $val->marks;
            }
            $marks = ROUND($marks/count($evaluate));

            return ['marks' => $marks, 'num' => count($evaluate)];
        }
    }

    public static function get($truyen_id){
        return TruyenDanhGia::where('truyen_id', $truyen_id)->get();
    }
}
