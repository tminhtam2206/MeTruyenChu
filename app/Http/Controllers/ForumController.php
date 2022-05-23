<?php

namespace App\Http\Controllers;

use App\Models\DienDan_BaiDang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller{
    public function __construct(){
        ThongKeController::add();
    }
    
    public function index(){
        $baidang = DienDanBaiDangController::getAll();
        return view('forum.index', compact('baidang'));
    }

    public function getDangBai(){
        if(!Auth::check()){
            return redirect()->route('trangchu.dang_nhap');
        }
        return view('forum.dangbai');
    }

    public function postDangBai(Request $request){
        DienDanBaiDangController::add($request);
        return redirect()->route('forum.index');
    }

    public function getBaiDang($title){
        $baidang = DienDanBaiDangController::get(splitID($title));
        return view('forum.noidung', compact('baidang'));
    }
}
