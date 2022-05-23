<?php

namespace App\Http\Controllers;

use App\Models\Truyen_Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TruyenRecordController extends Controller{
    public static function add($truyen_id, $numchap, $action){
        $record = new Truyen_Record();
        $record->truyen_id = $truyen_id;
        $record->user_id = Auth::user()->id;
        $record->numchap = $numchap;
        $record->log = $action;
        $record->save();
    }

    public static function show($truyen_id){
        return Truyen_Record::where('truyen_id', $truyen_id)
        ->orderBy('id', 'desc')
        ->paginate(25);
    }

    public static function get($truyen_id, $num){
        return Truyen_Record::where('truyen_id', $truyen_id)
        ->orderBy('id', 'desc')
        ->paginate($num);
    }
}
