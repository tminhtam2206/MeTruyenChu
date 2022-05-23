<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ThanhVien;
use App\Models\Truyen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThanhVienController extends Controller{
    public function getThanhVien_Truyen(Request $request){
        $truyen_id = $request->truyen_id;
        $thanhvien = ThanhVien::where('truyen_id', $truyen_id)->get();

        $data = '';

        foreach($thanhvien as $val){
            $data .= '<div class="col-md-3 mb-2 position-relative">
                <span class="position-absolute" style="top: 3px; right: 29px; z-index: 999; cursor: pointer;">
                    <i class="fas fa-times-square" onclick="deleteMember(`'.$val->id.'`)" style="font-size: 20px;"></i>
                </span>
                <div class="user-avatar user-avatar-xl fileinput-button">
                    <img src="'.getAvatar_ThanhVien($val->user_id).'" alt="">
                </div>
            </div>';
        }

        echo $data;
    }

    public static function getThanhVien_Select($truyen_id){
        return User::join('thanh_viens', 'users.id', '!=', 'thanh_viens.user_id')
        ->where('thanh_viens.truyen_id', '=', $truyen_id)
        ->select('users.id', 'users.display_name')
        ->get();
    }

    public function ajaxThemThanhVien(Request $request){
        if(ThanhVien::where('user_id', $request->user_id)->where('truyen_id', $request->truyen_id)->count() == 0){
            $thanhvien = new ThanhVien();
            $thanhvien->user_id = $request->user_id;
            $thanhvien->truyen_id = $request->truyen_id;
            $thanhvien->save();
        }
    }

    public static function addThanhVien($truyen_id){
        $thanhvien = new ThanhVien();
        $thanhvien->user_id = getIdUser();
        $thanhvien->truyen_id = $truyen_id;
        $thanhvien->save();
    }

    public static function addThanhVien2($user_id, $truyen_id){
        $thanhvien = new ThanhVien();
        $thanhvien->user_id = $user_id;
        $thanhvien->truyen_id = $truyen_id;
        $thanhvien->save();
    }


    public function ajaxXoaThanhVien(Request $request){
        $thanhvien = ThanhVien::find($request->id);

        $truyen = Truyen::find($thanhvien->truyen_id);

        if($thanhvien->user_id != $truyen->user_id){
            $thanhvien->delete();
        }
    }

    public static function checkThanhVien($truyen_id){
        if(ThanhVien::where('truyen_id', $truyen_id)->where('user_id', getIdUser())->count() > 0){
            return true;
        }else{
            return false;
        }
    }

    public static function getTruyen($num){
        return ThanhVien::join('truyen', 'truyen.id', '=', 'thanh_viens.truyen_id')
        ->where('thanh_viens.user_id', getIdUser())
        ->where('truyen.public', '=', 'Y')
        ->where('truyen.delete', '=', 'N')
        ->orderBy('truyen.created_at', 'desc')
        ->select('truyen.*')
        ->paginate($num);
    }
}
