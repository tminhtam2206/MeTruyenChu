<?php

namespace App\Http\Controllers;

use App\Models\CanhGioi;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class CanhGioiController extends Controller{
    public function index(){
        $canh_gioi = CanhGioi::orderBy('point', 'asc')->get();
        return view('admin.canh_gioi', compact('canh_gioi'));
    }

    public function postAdd(Request $data){
        if(KiemTraCanhGioi_Add($data->name, $data->point) == true){
            $canh_gioi = new CanhGioi();
            $canh_gioi->name = $data->name;
            $canh_gioi->point = $data->point;
            $canh_gioi->save();
            ghiLog('Thêm cảnh giới ['.$data->name.']');
            Toastr::success("Thêm cảnh giới thành công!");
        }
        else{
            Toastr::error('Tên hoặc điểm kinh nghiệm bị trùng!');
        }
        return redirect()->route('admin.level');
    }

    public function postEdit(Request $data){
        $canh_gioi = CanhGioi::find($data->id);
        $canh_gioi->name = $data->name;
        $canh_gioi->point = $data->point;
        $canh_gioi->save();
        ghiLog('Chỉnh sửa cảnh giới ['.$data->name.']');
        Toastr::success("Cập nhật thành công!");

        return redirect()->route('admin.level');
    }

    public function Delete(Request $data){
        $canh_gioi = CanhGioi::find($data->id);

        if($canh_gioi->member > 0){
            return 'error';
        }
        $canh_gioi->delete();
        return 'ok';
    }

    public static function updateMember(){
        $canh_gioi = CanhGioi::where('name', Auth::user()->exp_level)->first();
        $canh_gioi->member = $canh_gioi->member + 1;
        $canh_gioi->save();
    }
}
