<?php

namespace App\Http\Controllers;

use App\Models\ThietLapWeb;
use Illuminate\Http\Request;

class ThietLapWebController extends Controller{
    public static function getChinhSach(){
        $chinhsach = ThietLapWeb::first();

        if($chinhsach == null){
            $chinhsach = new ThietLapWeb();
            $chinhsach->chinhsach = '';
            $chinhsach->dieukhoan = '';
            $chinhsach->huongdan = '';
            $chinhsach->save();

            $chinhsach = ThietLapWeb::first();
        }

        return $chinhsach->chinhsach;
    }

    public static function saveChinhSach(Request $request){
        $chinhsach = ThietLapWeb::first();
        $chinhsach->chinhsach = $request->chinhsach;
        $chinhsach->save();
    }

    public static function getDieuKhoan(){
        $chinhsach = ThietLapWeb::first();

        if($chinhsach == null){
            $chinhsach = new ThietLapWeb();
            $chinhsach->chinhsach = '';
            $chinhsach->dieukhoan = '';
            $chinhsach->huongdan = '';
            $chinhsach->save();

            $chinhsach = ThietLapWeb::first();
        }

        return $chinhsach->dieukhoan;
    }

    public static function saveDieuKhoan(Request $request){
        $chinhsach = ThietLapWeb::first();
        $chinhsach->dieukhoan = $request->dieukhoan;
        $chinhsach->save();
    }

    public static function getHuongDan(){
        $chinhsach = ThietLapWeb::first();

        if($chinhsach == null){
            $chinhsach = new ThietLapWeb();
            $chinhsach->chinhsach = '';
            $chinhsach->dieukhoan = '';
            $chinhsach->huongdan = '';
            $chinhsach->save();

            $chinhsach = ThietLapWeb::first();
        }

        return $chinhsach->huongdan;
    }

    public static function saveHuongDan(Request $request){
        $chinhsach = ThietLapWeb::first();
        $chinhsach->huongdan = $request->huongdan;
        $chinhsach->save();
    }
}
