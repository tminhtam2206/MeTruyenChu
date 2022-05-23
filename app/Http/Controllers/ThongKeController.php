<?php

namespace App\Http\Controllers;

use App\Models\ThongKe;
use Illuminate\Http\Request;

class ThongKeController extends Controller{
    public static function add(){
        $current_date = date('Y-m-d');
        $statistical = ThongKe::where('curr_date', $current_date)->first();

        if($statistical == null){
            $statistic = new ThongKe();
            $statistic->views = 0;
            $statistic->curr_date = $current_date;
            $statistic->save();
        }else{
            $statistical->views = $statistical->views + 1;
            $statistical->save();
        }
    }

    public static function get($date){
        $statistical = ThongKe::where('curr_date', $date)->first();

        if($statistical == null){
            $statistic = new ThongKe();
            $statistic->views = 0;
            $statistic->curr_date = $date;
            $statistic->save();

            return ThongKe::where('curr_date', $date)->first()->views;
        }

        return $statistical->views;
    }
}
