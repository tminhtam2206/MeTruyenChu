<?php

namespace App\Http\Controllers;

use App\Models\Chuong;
use App\Models\Truyen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChuongController extends Controller{
    public static function getDanhSachChuong($truyen_id, $item){
        return Chuong::where('truyen_id', $truyen_id)
        ->where('public', 'Y')
        ->orderBy('numchap', 'asc')
        ->paginate($item);
    }

    public static function getDanhSachChuong_Short($truyen_id, $item){
        return Chuong::select('id', 'numchap', 'name', 'public', 'lock', 'view', 'number_letters', 'created_at')
        ->where('truyen_id', $truyen_id)
        ->where('public', 'Y')
        ->orderBy('numchap', 'desc')
        ->paginate($item);
    }

    public static function getDanhSachChuong_DEL($truyen_id){
        return Chuong::where('truyen_id', $truyen_id)
        ->where('public', 'N')
        ->orderBy('numchap', 'asc')
        ->get();
    }

    public static function getOneRecord($id){
        return Chuong::find($id);
    }

    public static function add(Request $request){
        $chuong = new Chuong();
        $chuong->truyen_id = $request->truyen_id;
        $chuong->user_id = Auth::user()->id;
        $chuong->numchap = $request->numchap;

        if(strlen(trim($request->name)) <= 0){
            $chuong->name = "Vô Đề";
        }else{
            $chuong->name = formatName($request->name);
        }
        
        $chuong->content = $request->content;
        $chuong->number_letters = WK_COUNT($request->content);
        $chuong->save();
    }

    public static function edit(Request $request){
        $chuong = Chuong::find($request->id);
        $chuong->user_id = Auth::user()->id;
        $chuong->numchap = $request->numchap;
        $chuong->name = formatName($request->name);
        $chuong->content = $request->content;
        $chuong->number_letters = WK_COUNT($request->content);
        $chuong->save();
    }

    public static function deleteHide($id){
        $chuong = Chuong::find($id);
        $chuong->public = 'N';
        $chuong->save();
        TruyenRecordController::add($chuong->truyen_id, $chuong->numchap, 'Xóa chương');
        TruyenController::updateNumChap_Delete($chuong->truyen_id);
    }

    public static function updateShow($id){
        $chuong = Chuong::find($id);
        $chuong->public = 'Y';
        $chuong->save();
        TruyenRecordController::add($chuong->truyen_id, $chuong->numchap, 'Hiện chương');
        TruyenController::updateNumChap($chuong->truyen_id);
    }

    public static function retypeNumChapter($truyen_id){
        $i = 1;
        foreach(Chuong::where('truyen_id', $truyen_id)->where('public', 'Y')->orderBy('id', 'asc')->get() as $val){
            $chuong = Chuong::find($val->id);
            $chuong->numchap = $i;
            $chuong->name_slug = Str::slug($chuong->name, '-') . "-" . $truyen_id. "-". $chuong->id;
            $chuong->save();
            TruyenRecordController::add($chuong->truyen_id, $chuong->numchap, 'Đánh lại số chương');
            $i++;
        }
    }

    public static function deleteForever($truyen_id){
        foreach(Chuong::where('truyen_id', $truyen_id)->where('public', 'N')->get() as $val){
            if(countDays($val->updated_at) > 30){
                $chuong = Chuong::find($val->id);
                $chuong->public = 'D';
                $chuong->save();
            }
        }
    }

    public static function deleteForever_UserClick($truyen_id){
        foreach(Chuong::where('truyen_id', $truyen_id)->where('public', 'N')->get() as $val){
            Chuong::find($val->id)->delete();
        }
    }

    public static function lockChap($chuong_id){
        $chuong = Chuong::find($chuong_id);
        $chuong->lock = 'Y';
        $chuong->save();
        TruyenRecordController::add($chuong->truyen_id, $chuong->numchap, 'Khóa chương');
    }

    public static function unLockChap($chuong_id){
        $chuong = Chuong::find($chuong_id);
        $chuong->lock = 'N';
        $chuong->save();
        TruyenRecordController::add($chuong->truyen_id, $chuong->numchap, 'Mở khóa chương');
    }

    public static function get5ChuongMoiNhat($truyen_id){
        return Chuong::where('truyen_id', $truyen_id)
        ->where('public', 'Y')
        ->orderBy('numchap', 'desc')
        ->limit(5)
        ->get();
    }

    public static function getChuong($truyen_id){
        return Chuong::where('truyen_id', $truyen_id)
        ->where('public', 'Y')
        ->orderBy('numchap', 'asc')
        ->paginate(25);
    }

    public static function getIdTruyenByIdChuong($chuong_id){
        return Chuong::find($chuong_id)->truyen_id;
    }

    public static function getDetailChap($chuong_id){
        return Chuong::find($chuong_id);
    }

    public static function getDetailChapByNumChap($truyen_id, $numchap){
        return Chuong::where('truyen_id', $truyen_id)
        ->where('numchap', $numchap)->first();
    }

    public static function getNameSlugById($chuong_id){
        return Chuong::find($chuong_id)->name_slug;
    }

    public static function getNameSlugNewAdd($truyen_id){
        return Chuong::where('truyen_id', $truyen_id)
        ->orderBy('id', 'desc')
        ->first()
        ->name_slug;
    }

    public static function updateViews($chuong_id){
        $chuong = Chuong::find($chuong_id);
        $chuong->view = $chuong->view + 1;
        $chuong->save();
    }

    public static function updateLike($chuong_id){
        $chuong = Chuong::find($chuong_id);
        $chuong->like = $chuong->like + 1;
        $chuong->save();
    }

    public static function getShowChap($truyen_id, $name_slug, $numchap){
        $chuong = Chuong::where('truyen_id', $truyen_id)
        ->where('numchap', $numchap)->first();

        if($chuong == null){
            return 'disabled';
        }else{
            return route('member.my_story.list_chapter.get_edit', ['name_slug'=>$name_slug, 'chuong_id'=>$chuong->id]);
        }
    }

    public static function getShowChap_mod($truyen_id, $numchap){
        $chuong = Chuong::where('truyen_id', $truyen_id)
        ->where('numchap', $numchap)->first();

        if($chuong == null){
            return 'disabled';
        }else{
            return route('mod.truyen_da_dang.sua_chuong', ['name_slug'=>$chuong->name_slug]);
        }
    }

    public static function LamMoiSoChu_Chuong($truyen_id){
        foreach(Chuong::where('truyen_id', $truyen_id)->where('public', 'Y')->select('id', 'content')->get() as $val){
            $chuong = Chuong::find($val->id);
            $chuong->number_letters = WK_COUNT($val->content);
            $chuong->save();
        }
    }

    public static function LamMoiSoChuByID($chuong_id){
        $chuong = Chuong::find($chuong_id);
        $chuong->number_letters = WK_COUNT($chuong->content);
        $chuong->save();
    }
}
