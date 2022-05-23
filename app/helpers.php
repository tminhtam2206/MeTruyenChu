<?php
use Illuminate\Support\Facades\Auth;
use App\Models\CanhGioi;
use App\Models\User;
use App\Models\Truyen;
use App\Models\Chuong;
//use Illuminate\Support\Facades\Excep;
use App\Exceptions\InvalidOrderException;
use App\Http\Controllers\CanhGioiController;
use App\Http\Controllers\ConfigSystemController;
use App\Http\Controllers\ThongBaoController;
use App\Http\Controllers\UserRecordController;
use Illuminate\Support\Facades\Date;
use App\Models\TuSach;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

////////////////
const app_version = 'v2022.01.31';
const tbl_fields = [
    'user' => [
        'name' => 42,
        'display_name' => 42,
        'email' => 50,
        'password' => 255,
        'status' => 300
    ],
    'canhgioi' =>[
        'name' => 24
    ],
    'theloaitruyen' =>[
        'name' => 42
    ],
    'truyen' => [
        'name' => 255,
        'author' => 255,
        'source' => 255,
        'notify' => 255
    ],
    'truyen_theloai' => [
        'name' => 42
    ],
    'chuong' => [
        'name' => 255
    ],
    'truyen_vande' => [
        'problem' => 255
    ],
    'nhanvat' => [
        'name' => 42,
        'review' => 255
    ],
    'truyen_binhluan' => [
        'content' => 255
    ],
    'truyen_vande' => [
        'problem' => 255
    ],
];

///////////////
function KiemTraCanhGioi_Add($name, $point){
    if(CanhGioi::where('name', $name)->count() > 0){
        return false;
    }else if(CanhGioi::where('point', $point)->count() > 0){
        return false;
    }

    return true;
}

function TangEXP($id, $point){
    if(getIdUser() > 0){
        $user = User::find($id);
        $newPoint = ($user->exp + $point);
        $user->exp = $newPoint;
        $user->exp_level = CheckNameFromEXP($newPoint);
        try{
            if(Auth::user()->exp_level != $user->exp_level){
                CanhGioiController::updateMember();
            }
        }catch(Exception $e){

        }
        $user->save();
    }
}

function CheckNameFromEXP($point){
    foreach(CanhGioi::orderBy('point', 'asc')->get() as $val){
        if($val->point >= $point){
            return $val->name;
        }
    }

    return "Phàm Nhân";
}

function ReturnPointByEXP($point){
    foreach(CanhGioi::orderBy('point', 'asc')->get() as $val){
        if($val->point >= $point){
            return $val->point;
        }
    }

    return 0;
}

function TinhPhamTramEXP($point){
    return ($point/ReturnPointByEXP($point)) * 100;
}

function ActiveLink($link, $active){
    if(request()->is($link)){
        return $active;
    }
}

function ActiveLink2($link, $active){
    if (strlen(strstr(url()->current(), $link)) > 0) {
        return $active;
    }
}

function ActiveLink3($link, $active){
    if(Str::contains(url()->current(), $link)){
        return $active;
    }
}

function hasActive($link){
    if(request()->is($link)){
        return 'has-active';
    }
}

function getAvatar($name){
    return asset('storage/app/public/avatar').'/'.$name;
}

function getAvatarCover($name){
    return asset('storage/app/public/avatar_cover').'/'.$name;
}

function getNewIDTruyen(){
    try{
        $truyen = Truyen::orderBy('created_at', 'desc')->first();
        return '-'.($truyen->id + 1);
    }catch(Exception $e){
        return '-1';
    }
}

function getStoryCover($name){
    return asset('storage/app/public/story_img').'/'.$name;
}

function getStoryThumb($name){
    return asset('storage/app/public/story_thumb').'/'.$name;
}

function splitID($name_slug){
    $arr = explode("-", $name_slug);
    return $arr[count($arr)-1];
}

function getIP(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

function ghiLog($action){
    UserRecordController::add($action);
}

function showLog(){
    return UserRecordController::show(25);
}

function getShortText($text){
    for($i = 0; $i < count($text); $i++){
        
    }
}

function WK_COUNT($string){
    $string = str_replace("\n", " ", $string);
    $string = str_replace("<br />", "", $string);
    $string = trim($string);
    $array = explode(' ', $string);
    $count = 0;
    for($i = 0; $i < count($array); $i++){
        if(ord($array[$i]) != 13){
            $count++;
        }
    }
    return $count;
}

function getNewIDChuong($truyen_id){
    try{
        $chuong = Chuong::orderBy('created_at', 'desc')->first();
        return '-'.$truyen_id.'-'.($chuong->id + 1);
    }catch(Exception $e){
        return '-'.$truyen_id.'-1';
    }
}

function getIDTruyenByNameChuong($name_slug){
    $arr = explode("-", $name_slug);
    return $arr[count($arr)-2];
}

function countDays($date){
   $date1 = new DateTime($date);
   $date2 = new DateTime(date('Y-m-d H:i:s'));
   $interval = $date1->diff($date2);
   return $interval->format('%a');
}

function getIdUser(){
    if(isset(Auth::user()->id)){
        return Auth::user()->id;
    }

    return 0;
}

function getFirstChap($truyen_id){
    $truyen = Truyen::find($truyen_id);
    $chuong = Chuong::where('truyen_id', $truyen_id)->where('numchap', '1')->first();

    if (isset($_COOKIE['read-'.$truyen_id])) {
        return route('trangchu.chuong', ['truyen'=>$truyen->name_slug, 'chuong'=>$_COOKIE['read-'.$truyen_id]]);
    } else{
        if($chuong != null){
            return route('trangchu.chuong', ['truyen'=>$truyen->name_slug, 'chuong'=>'chuong-1']);
        }else{
            return 'disabled';
        }
    }
}

function getPrevChap($truyen_id, $numchap){
    $truyen = Truyen::find($truyen_id);
    
    $chuong = Chuong::where('truyen_id', $truyen->id)
    ->where('public', 'Y')
    ->where('numchap', $numchap - 1)
    ->count();

    if($chuong > 0){
        return route('trangchu.chuong', ['truyen'=>$truyen->name_slug, 'chuong'=>'chuong-'.$numchap - 1]);
    }else{
        return 'disabled';
    }
}

function getNextChap($truyen_id, $numchap){
    $truyen = Truyen::find($truyen_id);

    $chuong = Chuong::where('truyen_id', $truyen->id)
    ->where('public', 'Y')
    ->where('numchap', $numchap + 1)
    ->count();

    if($chuong > 0){
        return route('trangchu.chuong', ['truyen'=>$truyen->name_slug, 'chuong'=>'chuong-'.$numchap - 1]);
    }else{
        return 'disabled';
    }
}

function checkAvatar(){
    if(isset(Auth::user()->id)){
        return getAvatar(Auth::user()->avatar);
    }else{
        return asset('public/images/default-avatar.jpeg');
    }
}

function checkTuSach($truyen_id){
    $sach = TuSach::where('truyen_id', $truyen_id)
        ->where('user_id', getIdUser())->count();
    
    if($sach > 0) return 'fas';
    else return 'far';
}

function getIdSach($truyen_id){
    $sach = TuSach::where('truyen_id', $truyen_id)
        ->where('user_id', getIdUser())->first();
    
    if($sach != null) return $sach->id;
    else return 0;
}


function formatName($value){
    $value = Str::lower($value);
    $value = Str::title($value);

    return $value;
}

function TachMang($num){
    settype($num, "string");
    $arr = array();

    for ($i=0; $i < strlen($num) ; $i++) { 
        $arr[$i] = $num[$i];
    }

    return $arr;
}

function ConverNumber($num){
    $ky_tu = strlen($num);
    $arr = TachMang($num);

    if($ky_tu <= 3){
        return $num;
    }
    else if($ky_tu == 4){
        if($arr[1] > 0){
           return $arr[0].".".$arr[1]."K";    
        }
        return $arr[0]."K";
    }
    else if($ky_tu == 5){
        if($arr[2] > 0){
           return $arr[0].$arr[1].".".$arr[2]."K";    
        }
        return $arr[0].$arr[1]."K";
    }
    else if($ky_tu == 6){
        if($arr[3] > 0){
           return $arr[0].$arr[1].$arr[2].".".$arr[3]."K";    
        }
        return $arr[0].$arr[1].$arr[2]."K";
    }
    else if($ky_tu == 7){
        if($arr[1] > 0){
           return $arr[0].".".$arr[1]." Tr";    
        }
        return $arr[0]." Tr";
    }
    else if($ky_tu == 8){
        if($arr[2] > 0){
           return $arr[0].$arr[1].".".$arr[2]." Tr";    
        }
        return $arr[0].$arr[1]." Tr";
    }
    else if($ky_tu == 9){
        if($arr[3] > 0){
           return $arr[0].$arr[1].$arr[2].".".$arr[3]." Tr";    
        }
        return $arr[0].$arr[1].$arr[2]." Tr";
    }
}

function returnCookiePage(){
    if (isset($_COOKIE['tangkinhcac_bgColor'])){
        return 'style="background:'.$_COOKIE['tangkinhcac_bgColor'].';"';
    }
}

function getThongBao(){
    return ThongBaoController::get();
}

function getSoThongBaoMoi(){
    return ThongBaoController::getNewNotify();
}

function getSizeDB(){
    $tong = 0;

    $SizeDB = DB::table('information_schema.TABLES')
    ->select(['data_length as DataLength','index_length as IndexLength'])
    ->where('information_schema.TABLES.table_schema','=',config('database.connections.'.config('database.default').'.database'))
    ->get()
    ->map(function($eachDatabse){

        $dataIndex = $eachDatabse->DataLength + $eachDatabse->IndexLength;

        $modifiedObject = new \StdClass;
        $kbSize = ($dataIndex/1024);
        $modifiedObject->SizeInKb = $kbSize;

        return (object)array_merge((array)$eachDatabse,(array)$modifiedObject);

    });
    
    for($i = 0; $i< count($SizeDB); $i++){
        $tong += $SizeDB[$i]->SizeInKb;
    }

    //$resutl = round(($tong/31457.3)*100, 2);
    $resutl = round($tong/1024, 2);
    return $resutl.'MB';
}

function getCraw(){
    return ConfigSystemController::getConfigSystem()->craw;
}

function getNumchap($str){
    $arr = explode(':', $str);
    $arr = explode('  ', $arr[0]);
    return trim($arr[1]);
}

function getNumchap2($str){
    $arr = explode(':', $str);
    $arr = explode(' ', $arr[0]);
    return trim($arr[1]);
}

function getName($str){
    $arr = explode(':', $str);
    if(count($arr) == 1){
        return "Vô Đề";
    }
    return trim($arr[1]);
}

function getIPForUser($user_id){
    return UserRecordController::getIP($user_id);
}

function disibleButtonPrev($current_page){
    if($current_page <= 1){
        echo 'disabled';
    }
}

function disibleButtonNext($current_page, $max_page){
    if($current_page >= $max_page){
        echo 'disabled';
    }
}

function statusCheck($status){
    if($status == 'Hoàn thành' || $status == 'Ngừng'){
        echo 'disabled'; 
    }
}

function clearHTML_DTruyen($string){
    $resutl = '';

    for($i = 0; $i < strlen($string); $i++){
        if($i > 5){
            $resutl .= $string[$i];
        }
    }

    $resutl = (string) $resutl;

    // $arr = explode(' ', trim($resutl));
        
    // $result = '';

    // for($i = 0; $i < count($arr); $i++){
    //     if(ord($arr[$i]) != 13){
    //         $result .= $arr[$i].' ';
    //     }
    // }

    return trim($resutl);
}

function getAvatar_ThanhVien($user_id){
    $user = User::find($user_id);
    return getAvatar($user->avatar);
}

function getCoin(){
    if(getIdUser() > 0){
        $user = User::find(getIdUser());
        return $user->coin;
    }
    
    return 0;
}