<?php

namespace App\Http\Controllers;

use App\Models\UserRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRecordController extends Controller{
    public static function add($action){
        $record = new UserRecord();
        $record->user_id = Auth::user()->id;
        $record->ip = getIP();
        $record->log = $action;
        $record->save();
    }

    public static function show($num){
        return UserRecord::where('user_id', Auth::user()->id)
        ->orderBy('created_at', 'desc')
        ->paginate($num);
    }

    public static function getIP($user_id){
        $user_ip = UserRecord::where('user_id', $user_id)
        ->orderBy('created_at', 'desc')
        ->first();

        if($user_ip == null) return 'null';
        else return $user_ip->ip;
    }
}
