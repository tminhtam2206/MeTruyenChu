<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chuong;
use App\Models\Truyen;
use Illuminate\Support\Str;

class GenSourceController extends Controller{
    public static function genChap($truyen_id){
        for($i = 1; $i<= 100; $i++){
            $chuong = new Chuong();
            $chuong->truyen_id = $truyen_id;
            $chuong->user_id = Auth::user()->id;
            $chuong->numchap = $i;
            $chuong->name = 'test chuong';
            $chuong->name_slug = Str::slug('test chuong')."-".$truyen_id."-".getNewIDChuong($truyen_id);
            $chuong->content = '';
            $chuong->save();

            TruyenController::updateNumChap($truyen_id);
            TruyenController::updateDateUpdate($truyen_id);
        }
    }

    public static function genTruyen(){
        // for($i = 0; $i < 100; $i++){
        //     $truyen = new Truyen();
        //     $truyen->name = 'truyen-'.$i;
        //     $truyen->name_slug = 'truyen-'.$i.getNewIDTruyen();
        //     $truyen->author = 'Thai Thuong Lao';
        //     $truyen->type_story = 'Hoàn thành';
        //     $truyen->description = '';
        //     $truyen->source = 'http://tangkinhcac.atwebpages.com';
        //     $truyen->user_id = Auth::user()->id;
        //     $truyen->save();
        // }

        for($i = 100; $i < 200; $i++){
            $truyen = new Truyen();
            $truyen->name = 'truyen-'.$i;
            $truyen->name_slug = 'truyen-'.$i.getNewIDTruyen();
            $truyen->author = 'Thai Thuong Lao';
            $truyen->type_story = 'Truyện dịch';
            $truyen->status = 'Hoàn thành';
            $truyen->description = '';
            $truyen->source = 'http://tangkinhcac.atwebpages.com';
            $truyen->user_id = Auth::user()->id;
            $truyen->save();
        }
    }
}
