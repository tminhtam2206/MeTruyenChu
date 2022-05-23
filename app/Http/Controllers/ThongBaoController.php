<?php

namespace App\Http\Controllers;

use App\Models\ThongBao;
use App\Models\TuSach;
use App\Models\Chuong;
use App\Models\Truyen;
use Illuminate\Http\Request;

class ThongBaoController extends Controller{
    public static function add($title, $content){
        $thongbao = new ThongBao();
        $thongbao->user_id = getIdUser();
        $thongbao->title = $title;
        $thongbao->content = $content;
        $thongbao->save();
    }

    public static function get(){
        return ThongBao::where('user_id', getIdUser())
            ->orderBy('created_at', 'desc')
            ->paginate(25);
    }

    public static function updateStatus(){
        foreach(ThongBao::where('user_id', getIdUser())->get() as $val){
            $thongbao = ThongBao::find($val->id);
            $thongbao->status = 'Y';
            $thongbao->save();
        }
    }

    public static function getNewNotify(){
        return ThongBao::where('user_id', getIdUser())
            ->where('status', 'N')
            ->count();
    }

    public static function getThongBaoTuSach($truyen_id){
        $tusach = TuSach::where('user_id', getIdUser())
        ->where('truyen_id', $truyen_id)
        ->first();

        if($tusach != null){
            $truyen = Truyen::find($truyen_id);
            $link = route('trangchu.chuong', ['truyen'=>$truyen->name_slug, 'chuong'=>$truyen->num_chaps]);
    
            $thongbao = new ThongBao();
            $thongbao->user_id = getIdUser();
            $thongbao->title = 'Truyện '.$tusach->Truyen->name.' có chương mới';
            $thongbao->content = $link;
            $thongbao->save();
        }
    }

    public static function delete(){
        ThongBao::where('user_id', getIdUser())->delete();
    }
}
