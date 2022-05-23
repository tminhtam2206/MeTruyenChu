<?php

namespace App\Http\Controllers;

use App\Models\Truyen_TheLoai;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TruyenTheLoaiController extends Controller{
    public static function show($truyen_id){
        return Truyen_TheLoai::where('truyen_id', $truyen_id)->get();
    }

    public static function add($truyen_id, $name){
        $truyen_theloai = new Truyen_TheLoai();
        $truyen_theloai->truyen_id = $truyen_id;
        $truyen_theloai->name = $name;
        $truyen_theloai->name_slug = Str::slug($name);
        $truyen_theloai->save();
    }

    public static function delete($truyen_id){
        Truyen_TheLoai::where('truyen_id', $truyen_id)->delete();
    }
    
}
