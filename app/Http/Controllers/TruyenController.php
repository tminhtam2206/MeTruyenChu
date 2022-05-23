<?php

namespace App\Http\Controllers;

use App\Models\Chuong;
use App\Models\ThanhVien;
use App\Models\Truyen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Auth;
use Image;

class TruyenController extends Controller{
    public static function getIdTruyen($name_slug){
        return Truyen::where('name_slug', $name_slug)->first()->id;
    }

    public static function getNameSlug($id){
        return Truyen::find($id)->name_slug;
    }

    public static function showOneRecord($name_slug){
        return Truyen::where('name_slug', $name_slug)->first();
    }

    public static function getTruyenByID($id){
        return Truyen::find($id);
    }

    public static function getTruyenDaDang_DESC($num){
        return ThanhVien::join('truyen', 'truyen.id', '=', 'thanh_viens.truyen_id')
        ->where('thanh_viens.user_id', getIdUser())
        ->where('truyen.delete', '=', 'N')
        ->orderBy('truyen.updated_at', 'desc')
        ->select('truyen.*')
        ->paginate($num);
    }

    public static function add(Request $request){
        try{
            $truyen = new Truyen();
            $truyen->name = formatName($request->name);
            $truyen->name_slug = Str::slug($request->name).getNewIDTruyen();
            $truyen->author = formatName($request->author);
            $truyen->type_story = $request->type_story;
            $truyen->description = $request->description;
            if(strlen($request->source) > 0)
                $truyen->source = $request->source;
            else
                $truyen->source = 'metruyenchu.epizy.com';
            $truyen->user_id = Auth::user()->id;
            $truyen->save();

            TangEXP(Auth::user()->id, 15);

            return [
                'status' => 'true',
                'id' => $truyen->id
            ];
        }catch(Exception $e){
            return [
                'status' => 'false'
            ];
        }
    }

    public static function edit(Request $request){
        try{
            $truyen = Truyen::find($request->id);
            $truyen->name = formatName($request->name);
            $truyen->name_slug = Str::slug($request->name).'-'.$request->id;

            $link_remove = storage_path().'/app/public/story_img/';
            $image = $request->file('cover');
            if($image != null){
                if($truyen->cover != 'cover.jpg'){
                    try{
                        unlink($link_remove.$truyen->cover);
                    }catch(Exception $e){

                    }
                }

                // $filename = $image->getClientOriginalName();
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(564, 798);
                $new_name = 'COVER_'.date('YmdHis').uniqid().'.jpg';
                $image_resize->save($link_remove.'/'.$new_name);
                $truyen->cover = $new_name;
            }

            //thumb
            $link_remove_thumb = storage_path().'/app/public/story_thumb/';
            $image_thumb = $request->file('thumb');
            if($image_thumb != null){
                if($truyen->thumb != 'thumb.jpg'){
                    try{
                        unlink($link_remove_thumb.$truyen->thumb);
                    }catch(Exception $e){

                    }
                }

                // $filename = $image->getClientOriginalName();
                $image_resize_thumb = Image::make($image_thumb->getRealPath());
                // $image_resize_thumb->resize(564, 798);
                $new_name_thumb = 'THUMB_'.date('YmdHis').uniqid().'.jpg';
                $image_resize_thumb->save($link_remove_thumb.'/'.$new_name_thumb);
                $truyen->thumb = $new_name_thumb;
            }
            //end thumb

            $truyen->author = formatName($request->author);
            $truyen->type_story = $request->type_story;
            $truyen->status = $request->status;
            $truyen->description = $request->description;
            
            if(strlen($request->source) > 0)
                $truyen->source = $request->source;
            else
                $truyen->source = 'metruyenchu.epizy.com';
            
            if(strlen($request->link_craw) > 0)
                $truyen->link_craw = $request->link_craw;
            else
                $truyen->link_craw = '';

            $truyen->user_id = Auth::user()->id;
            $truyen->timestamps = false;
            $truyen->save();

            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public static function updateNumChap($id){
        $truyen = Truyen::find($id);
        $truyen->num_chaps = $truyen->num_chaps + 1;
        $truyen->save();
    }

    public static function updateNumChap_Delete($id){
        $truyen = Truyen::find($id);
        $truyen->num_chaps = $truyen->num_chaps - 1;
        $truyen->timestamps = false;
        $truyen->save();
    }

    public static function updateDateUpdate($id){
        $truyen = Truyen::find($id);
        $truyen->updated_at = date('Y-m-d H:i:s'); //2021-09-26 05:54:34
        $truyen->save();
    }

    public static function updateSetting(Request $request){
        $truyen = Truyen::find($request->id);

        if($request->has('public')){
            $truyen->public = 'Y';
        }else{
            $truyen->public = 'N';
        }

        if($request->has('lock_comment')){
            $truyen->lock_comment = 'Y';
        }else{
            $truyen->lock_comment = 'N';
        }

        if($request->has('auto_craw')){
            $truyen->auto_craw = 'YES';
        }else{
            $truyen->auto_craw = 'NO';
        }

        if(Auth::user()->role == 'mode' || Auth::user()->role == 'admin'){
            if($request->has('lock')){
                $truyen->lock = 'Y';
            }else{
                $truyen->lock = 'N';
            }
        }
        $truyen->timestamps = false;
        $truyen->save();
    }

    //trang chu
    public static function getTruyenHot($num){
        return Truyen::select('id', 'name', 'name_slug', 'cover', 'thumb', 'author', 'num_chaps', 'updated_at')
        ->where('public', 'Y')
        ->where('delete', 'N')
        ->orderBy('vote', 'desc')
        ->paginate($num);
    }

    public static function getTruyenMoiCapNhat($num){
        return Truyen::select('id', 'name', 'name_slug', 'cover', 'thumb', 'author', 'num_chaps', 'updated_at')
        ->where('public', 'Y')
        ->where('delete', 'N')
        ->orderBy('updated_at', 'desc')
        ->paginate($num);
    }

    public static function getTruyenHoanThanh($num){
        return Truyen::select('id', 'name', 'name_slug', 'cover', 'thumb', 'author', 'num_chaps', 'updated_at')
        ->where('public', 'Y')
        ->where('delete', 'N')
        ->where('status', 'Hoàn thành')
        ->orderBy('updated_at', 'desc')
        ->paginate($num);
    }

    public static function countTruyenHoanThanh(){
        return Truyen::where('public', 'Y')
        ->where('delete', 'N')
        ->where('status', 'Hoàn thành')
        ->orderBy('updated_at', 'desc')
        ->count();
    }

    public static function getDanhSachTruyen(){
        return Truyen::select('id', 'name', 'name_slug', 'cover', 'thumb', 'author', 'num_chaps', 'updated_at')
        ->where('public', 'Y')
        ->where('delete', 'N')
        ->orderBy('updated_at', 'desc')
        ->paginate(30);
    }

    public static function getDeltailTruyen($truyen_id){
        return Truyen::find($truyen_id);
    }

    public static function getTruyenCungTacGia($truyen_id){
        return Truyen::where('public', 'Y')
        ->where('delete', 'N')
        ->where('author', Truyen::find($truyen_id)->author)
        ->orderBy('views', 'desc')->get();
    }

    public static function getTruyenTheoTheLoai($name_slug, $num){
        return Truyen::join('truyen_theloai', 'truyen_theloai.truyen_id', '=', 'truyen.id')
        ->select('truyen.id', 'truyen.name', 'truyen.name_slug', 'truyen.cover', 'truyen.thumb', 'truyen.author', 'truyen.num_chaps', 'truyen.updated_at')
        ->where('truyen_theloai.name_slug', '=', $name_slug)
        ->where('truyen.public', '=', 'Y')
        ->where('truyen.delete', '=', 'N')
        ->orderBy('truyen.views', 'desc')
        ->select('truyen.name', 'truyen.name_slug', 'truyen.num_chaps', 'truyen.cover')
        ->paginate($num);
    }

    public static function countGetTruyenTheoTheLoai($name_slug){
        return Truyen::join('truyen_theloai', 'truyen_theloai.truyen_id', '=', 'truyen.id')
        ->select('truyen.id', 'truyen.name', 'truyen.name_slug', 'truyen.cover', 'truyen.thumb', 'truyen.author', 'truyen.num_chaps', 'truyen.updated_at')
        ->where('truyen_theloai.name_slug', '=', $name_slug)
        ->where('truyen.public', '=', 'Y')
        ->where('truyen.delete', '=', 'N')
        ->orderBy('truyen.views', 'desc')
        ->select('truyen.name', 'truyen.name_slug', 'truyen.num_chaps', 'truyen.cover')
        ->count();
    }

    public static function getTimTruyen($name){
        return Truyen::select('id', 'name', 'name_slug', 'cover', 'thumb', 'author', 'num_chaps', 'updated_at')
        ->where('public', 'Y')
        ->where('delete', 'N')
        ->where('name_slug', 'like', '%'.Str::slug($name).'%')
        ->get();
    }

    public static function getTruyenTheoLoaiTruyen($name, $num){
        return Truyen::where('public', 'Y')
        ->where('delete', 'N')
        ->where('type_story', $name)
        ->paginate($num);
    }

    public static function countgetTruyenTheoLoaiTruyen($name){
        return Truyen::where('public', 'Y')
        ->where('delete', 'N')
        ->where('type_story', $name)
        ->count();
    }

    public static function getTruyen_TacGia($name, $num){
        return Truyen::where('public', 'Y')
        ->where('delete', 'N')
        ->where('author', $name)
        ->paginate($num);
    }

    public static function CountGetTruyen_TacGia($name){
        return Truyen::where('public', 'Y')
        ->where('delete', 'N')
        ->where('author', $name)
        ->count();
    }

    public static function getNameByID($truyen_id){
        return Truyen::find($truyen_id)->name;
    }

    public static function updateViews($truyen_id){
        $truyen = Truyen::find($truyen_id);
        $truyen->views = $truyen->views + 1;
        $truyen->timestamps = false;
        $truyen->save();
    }

    public static function updateDeCu(Request $request){
        $truyen = Truyen::find($request->truyen_id);
        $truyen->vote = $truyen->vote + 1;
        $truyen->timestamps = false;
        $truyen->save();
    }  
    
    public static function updateBookmarks($truyen_id, $num){
        $truyen = Truyen::find($truyen_id);
        $truyen->bookmarks = $truyen->bookmarks + $num;
        $truyen->timestamps = false;
        $truyen->save();
    }

    public static function getTruyenTuSach($num){
        return Truyen::join('tu_sach', 'tu_sach.truyen_id', '=', 'truyen.id')
            ->where('tu_sach.user_id', '=', getIdUser())
            ->where('truyen.public', '=', 'Y')
            ->where('truyen.delete', '=', 'N')
            ->orderBy('tu_sach.created_at', 'desc')
            ->select('truyen.id', 'truyen.name', 'truyen.name_slug', 'truyen.author', 'truyen.status', 'truyen.num_chaps', 'truyen.cover', 'tu_sach.created_at', 'tu_sach.created_at', 'truyen.author')
            ->paginate($num);
    }

    public static function countGetTruyenTuSach(){
        return Truyen::join('tu_sach', 'tu_sach.truyen_id', '=', 'truyen.id')
            ->where('tu_sach.user_id', '=', getIdUser())
            ->where('truyen.public', '=', 'Y')
            ->where('truyen.delete', '=', 'N')
            ->orderBy('tu_sach.created_at', 'desc')
            ->select('truyen.id', 'truyen.name', 'truyen.name_slug', 'truyen.author', 'truyen.status', 'truyen.num_chaps', 'truyen.cover', 'tu_sach.created_at', 'tu_sach.created_at', 'truyen.author')
            ->count();
    }

    public static function updateVanDe($truyen_id, $num){
        $truyen = Truyen::find($truyen_id);
        $truyen->problem = $truyen->problem + $num;
        $truyen->timestamps = false;
        $truyen->save();
    }

    public static function getAll(){
        return Truyen::orderBy('created_at', 'desc')->get();
    }

    public static function updateLock(Request $request){
        $truyen = Truyen::find($request->id);
        $truyen->lock = $request->lock;
        $truyen->timestamps = false;
        $truyen->save();
    }

    public static function count(){
        return Truyen::count();
    }

    public static function delete(Request $data){
        $truyen = Truyen::find($data->id);

        if($truyen->delete == 'N'){
            $truyen->name = $truyen->name . ' [Xóa]';
            $truyen->name_slug = Str::slug($truyen->name).'-'.$truyen->id;
            $truyen->delete = 'Y';
        }else{
            $truyen->delete = 'N';
        }
        $truyen->timestamps = false;
        $truyen->save();
        
        return 'ok';
    }

    public static function Count_BinhThuong(){
        $tong = Truyen::count();
        $kq = Truyen::where('delete', 'N')
        ->where('lock', 'N')
        ->where('public', 'Y')
        ->count();
        if($tong == 0) $tong = 1;

        return ($kq/$tong)*100;
    }

    public static function Count_BiKhoa(){
        $tong = Truyen::count();
        $kq = Truyen::where('lock', 'Y')->count();
        if($tong == 0) $tong = 1;

        return ($kq/$tong)*100;
    }

    public static function Count_BiXoa(){
        $tong = Truyen::count();
        $kq = Truyen::where('delete', 'Y')->count();
        if($tong == 0) $tong = 1;

        return ($kq/$tong)*100;
    }

    public static function Count_HoanThanh(){
        $tong = Truyen::count();
        $kq = Truyen::where('status', 'Hoàn thành')->count();
        if($tong == 0) $tong = 1;

        return ($kq/$tong)*100;
    }

    public static function Count_DangCapNhat(){
        $tong = Truyen::count();
        $kq = Truyen::where('status', 'Đang cập nhật')->count();
        if($tong == 0) $tong = 1;

        return ($kq/$tong)*100;
    }

    public static function Count_Ngung(){
        $tong = Truyen::count();
        $kq = Truyen::where('status', 'Ngừng')->count();
        if($tong == 0) $tong = 1;
        
        return ($kq/$tong)*100;
    }

    public static function TruyenMoiCapNhat_Index(){
        return Truyen::where('user_id', Auth::user()->id)
        ->where('delete', 'N')
        ->orderBy('updated_at', 'desc')
        ->paginate(2);
    }

    public static function updateNumLetters($truyen_id){
        $total = 0;
        foreach(Chuong::where('truyen_id', $truyen_id)->where('public', 'Y')->get() as $val){
            $total += $val->number_letters;
        }
        
        $truyen = Truyen::find($truyen_id);
        $truyen->number_letters = $total;
        $truyen->save();
    }
}
