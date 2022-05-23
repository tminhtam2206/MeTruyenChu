<?php

namespace App\Http\Controllers;

use App\Models\DienDan_BaiDang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DienDanBaiDangController extends Controller{
    public static function add(Request $request){
        $baidang = new DienDan_BaiDang();
        $baidang->user_id = $request->user_id;
        $baidang->title = $request->title;
        $baidang->title_u = Str::slug($request->title)."-".DienDanBaiDangController::getNewID();
        $baidang->content = $request->content;
        $baidang->tag = $request->tag;
        $baidang->save();
    }

    public static function getAll(){
        return DienDan_BaiDang::orderBy('updated_at', 'desc')->get();
    }

    public static function getNewID(){
        $baidang = DienDan_BaiDang::orderBy('id', 'desc')->first();
        if($baidang == null) return 1;
        else return $baidang->id + 1;
    }

    public static function get($id){
        return DienDan_BaiDang::find($id);
    }
}
