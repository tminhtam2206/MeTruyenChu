<?php

namespace App\Http\Controllers;

use App\Models\TruyenBinhLuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TruyenBinhLuanController extends Controller{
    public static function add(Request $request){
        $comment = new TruyenBinhLuan();
        $comment->chap = $request->chap;
        $comment->content = $request->content;
        $comment->truyen_id = $request->truyen_id;
        $comment->user_id = $request->user_id;
        $comment->save();
    }

    public static function show($truyen_id){
        return TruyenBinhLuan::where('truyen_id', $truyen_id)
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public static function getCommentByUser($num){
        return TruyenBinhLuan::where('user_id', getIdUser())
        ->orderBy('created_at', 'desc')
        ->paginate($num);
    }

    public static function getCommentByIdTruyen($truyen_id, $num){
        return TruyenBinhLuan::where('truyen_id', $truyen_id)
        ->orderBy('created_at', 'desc')
        ->paginate($num);
    }
}
