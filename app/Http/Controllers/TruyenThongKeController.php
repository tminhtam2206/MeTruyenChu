<?php

namespace App\Http\Controllers;

use App\Models\TruyenThongKe;
use Illuminate\Http\Request;

class TruyenThongKeController extends Controller{
    public static function addViews($id){
        $current_date = date('Y-m-d');
        $thongke = TruyenThongKe::where('curr_date', $current_date)
        ->where('truyen_id', $id)
        ->first();

        if($thongke == null){
            $new_thongke = new TruyenThongKe();
            $new_thongke->truyen_id = $id;
            $new_thongke->views = 1;
            $new_thongke->vote = 0;
            $new_thongke->save();
        }else{
            $thongke->views = $thongke->views + 1;
            $thongke->save();
        }
    }

    public static function addVote($id){
        $current_date = date('Y-m-d');
        $thongke = TruyenThongKe::where('curr_date', $current_date)
        ->where('truyen_id', $id)
        ->first();

        if($thongke == null){
            $new_thongke = new TruyenThongKe();
            $new_thongke->truyen_id = $id;
            $new_thongke->views = 1;
            $new_thongke->vote = 0;
            $new_thongke->save();
        }else{
            $thongke->vote = $thongke->vote + 1;
            $thongke->save();
        }
    }

    public static function get($truyen_id, $date){
        $thongke = TruyenThongKe::where('curr_date', $date)
        ->where('truyen_id', $truyen_id)
        ->first();

        if($thongke == null){
            $new_thongke = new TruyenThongKe();
            $new_thongke->truyen_id = $truyen_id;
            $new_thongke->views = 1;
            $new_thongke->vote = 0;
            $new_thongke->curr_date = $date;
            $new_thongke->save();

            return $new_thongke;
        }

        return $thongke;
    }
}
