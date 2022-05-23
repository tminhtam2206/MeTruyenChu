<?php

namespace App\Http\Controllers;

use App\Models\TheLoaiTruyen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;


class TheLoaiTruyenController extends Controller{
    public static function showAll(){
        return TheLoaiTruyen::orderBy('name', 'asc')->get();
    }

    public static function getNameByNameSlug($name_slug){
        return TheLoaiTruyen::where('name_slug', $name_slug)->first()->name;
    }

    public static function add(Request $request){
        try{
            $theloai = new TheLoaiTruyen();
            $theloai->name = $request->name;
            $theloai->name_slug = Str::slug($request->name);
            $theloai->save();
        }catch(Exception $e){
            return false;
        }

        return true;
    }

    public static function edit(Request $request){
        try{
            $theloai = TheLoaiTruyen::find($request->id);
            $theloai->name = $request->name;
            $theloai->name_slug = Str::slug($request->name);
            $theloai->save();
        }catch(Exception $e){
            return false;
        }

        return true;
    }

    public static function delete(Request $request){
        TheLoaiTruyen::find($request->id)->delete();
    }

    public static function count(){
        return TheLoaiTruyen::count();
    }
}
