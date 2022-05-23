<?php

namespace App\Http\Controllers;

use App\Models\TuSach;
use Illuminate\Http\Request;

class TuSachController extends Controller{
    public static function add(Request $request){
        $tusach = new TuSach();
        $tusach->truyen_id = $request->truyen_id;
        $tusach->user_id = getIdUser();
        $tusach->save();
        TruyenController::updateBookmarks($request->truyen_id, 1);
        UserController::updateAddTuSach();
    }

    public static function delete(Request $request){
        $tusach = TuSach::where('truyen_id', $request->truyen_id)
        ->where('user_id', getIdUser())
        ->first();

        if($tusach != null){
            $tusach->delete();
            TruyenController::updateBookmarks($request->truyen_id, -1);
            UserController::updateDeleteTuSach();
            return 'success';
        }else{
            return 'fail';
        }
    }
}
