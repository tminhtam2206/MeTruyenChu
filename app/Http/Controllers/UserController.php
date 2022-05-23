<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;

use function GuzzleHttp\Psr7\str;

class UserController extends Controller{
    public function dashboard(){
        return view('user.index');
    }

    public function CropAvatar(Request $request){
        $link_remove = storage_path().'/app/public/avatar/';
        $file = $request->file('avatar');
        $new_image_name = 'IMG_'.date('YmdHis').uniqid().'.jpg';
        //upload file
        if(Auth::user()->avatar != 'default-avatar.jpeg'){
            unlink($link_remove.Auth::user()->avatar);
        }
        $file->move($link_remove, $new_image_name);

        $user = User::find(Auth::user()->id);
        $user->avatar = $new_image_name;
        $user->save();

        ghiLog('Thay đổi avatar');

        return response()->json([
            'status' => 1,
            'msg' => 'Cập nhật ảnh đại diện thành công!',
            'name' => $new_image_name
        ]);
    }

    public function CropAvatar_Cover(Request $request){
        $link_remove = storage_path().'/app/public/avatar_cover/';
        $file = $request->file('Avatar_Cover');
        $new_image_name = 'COVER_'.date('YmdHis').uniqid().'.jpg';
        //upload file
        if(Auth::user()->avatar_cover != '' && Auth::user()->avatar_cover != 'default.jpeg'){
            unlink($link_remove.Auth::user()->avatar_cover);
        }
        $move = $file->move($link_remove, $new_image_name);

        $user = User::find(Auth::user()->id);
        $user->avatar_cover = $new_image_name;
        $user->save();

        ghiLog('Thay đổi ảnh bìa');

        return response()->json([
            'status' => 1,
            'msg' => 'Cập nhật ảnh bìa thành công!',
            'name' => $new_image_name
        ]);
    }

    public static function updateNumComment(){
        $user = User::find(Auth::user()->id);
        $user->binh_luan = $user->binh_luan + 1;
        $user->save();
    }

    public static function updateTuTruyen_Tang(){
        $user = User::find(Auth::user()->id);
        $user->tu_truyen = $user->tu_truyen + 1;
        $user->save();
    }

    public static function updateTuTruyen_Giam(){
        $user = User::find(Auth::user()->id);
        $user->tu_truyen = $user->tu_truyen - 1;
        $user->save();
    }

    public static function updateTruyenDaDang(){
        $user = User::find(Auth::user()->id);
        $user->truyen_da_dang = $user->truyen_da_dang + 1;
        $user->save();
    }

    public function updateDetailAccount(Request $request){
        $user = User::find(Auth::user()->id);
        
        if(Hash::check($request->confirm_pass, $user->password) == true){
            if($request->new_password != ''){
                try{
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = bcrypt($request->new_password);
                    $user->save();

                    Toastr::success('Cập nhật thành công!');
                    return redirect()->route('member.account.setting.detail');
                }catch(Exception $e){
                    Toastr::error('Tên đăng nhập hoặc email đã tồn tại!');
                    return redirect()->route('member.account.setting.detail');
                }
            }else{
                //doi username
                try{
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->save();
                    
                    Toastr::success('Cập nhật thành công!');
                    return redirect()->route('member.account.setting.detail');
                }catch(Exception $e){
                    Toastr::error('Tên đăng nhập hoặc email đã tồn tại!');
                    return redirect()->route('member.account.setting.detail');
                }
            }
        }else{
            Toastr::error('Xác nhận mật khẩu không đúng!');
            return redirect()->route('member.account.setting.detail');
        }
    }

    public function updateDetailAccount_Mod(Request $request){
        $user = User::find(Auth::user()->id);
        
        if(Hash::check($request->confirm_pass, $user->password) == true){
            if($request->new_password != ''){
                try{
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = bcrypt($request->new_password);
                    $user->save();

                    Toastr::success('Cập nhật thành công!');
                    return redirect()->route('mod.tai_khoan.thiet_lap.chi_tiet');
                }catch(Exception $e){
                    Toastr::error('Tên đăng nhập hoặc email đã tồn tại!');
                    return redirect()->route('mod.tai_khoan.thiet_lap.chi_tiet');
                }
            }else{
                //doi username
                try{
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->save();
                    
                    Toastr::success('Cập nhật thành công!');
                    return redirect()->route('mod.tai_khoan.thiet_lap.chi_tiet');
                }catch(Exception $e){
                    Toastr::error('Tên đăng nhập hoặc email đã tồn tại!');
                    return redirect()->route('mod.tai_khoan.thiet_lap.chi_tiet');
                }
            }
        }else{
            Toastr::error('Xác nhận mật khẩu không đúng!');
            return redirect()->route('mod.tai_khoan.thiet_lap.chi_tiet');
        }
    }

    public static function updateDetailAccount_Admin(Request $request){
        $user = User::find(Auth::user()->id);
        
        if(Hash::check($request->confirm_pass, $user->password) == true){
            if($request->new_password != ''){
                try{
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = bcrypt($request->new_password);
                    $user->save();
                    Toastr::success('Cập nhật thành công!');
                }catch(Exception $e){
                    Toastr::error('Tên đăng nhập hoặc email đã tồn tại!');
                }
            }else{
                //doi username
                try{
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->save();
                    Toastr::success('Cập nhật thành công!');
                }catch(Exception $e){
                    Toastr::error('Tên đăng nhập hoặc email đã tồn tại!');
                }
            }
        }else{
            Toastr::error('Xác nhận mật khẩu không đúng!');
        }
    }

    public static function login(Request $request){
        $user = User::where('email', $request->email)
            ->where('name', $request->email)
            ->where('password', $request->password)
            ->count();
    }

    public static function getAll(){
        return User::orderBy('created_at', 'desc')
        ->get();
    }
    
    public static function updateRole(Request $request){
        $user = User::find($request->id);
        $user->role = $request->role;
        $user->save();
    }

    public static function count(){
        return User::count();
    }

    public static function updateAddTuSach(){
        $user = User::find(Auth::user()->id);
        $user->tu_truyen = $user->tu_truyen + 1;
        $user->save();
    }

    public static function updateDeleteTuSach(){
        $user = User::find(Auth::user()->id);
        $user->tu_truyen = $user->tu_truyen - 1;
        $user->save();
    }

    public static function count_ThanhVien(){
        $tong = User::count();
        $kq = User::where('role', 'member')->count();
        return ($kq/$tong)*100;
    }

    public static function count_ChapSu(){
        $tong = User::count();
        $kq = User::where('role', 'mod')->count();
        return ($kq/$tong)*100;
    }

    public static function count_QuanTri(){
        $tong = User::count();
        $kq = User::where('role', 'admin')->count();
        return ($kq/$tong)*100;
    }

    public static function LockAccount(Request $request){
        $user = User::find($request->id);
        $user->lock = $request->lock;
        $user->save();
    }

    public static function KhoiPhucMatKhau(Request $request){
        $user = User::where('name', $request->name)
        ->where('email', $request->email)->first();

        if($user == null) return false;
        else{
            $pass = Str::random(8);
            $user->password = bcrypt($pass);
            $user->save();
            return $pass;
        }
    }

    public static function GetThanhVien(){
        return User::where('id', '!=', getIdUser())
        ->get();
    }

    public static function getThanhVien2($truyen_id){
        return User::join('thanh_viens', 'users.id', '=', 'thanh_viens.user_id')
        ->where('thanh_viens.truyen_id', $truyen_id)
        ->where('users.id');
    }

    public static function plusCoin($number){
        $user = User::find(getIdUser());
        $user->coin = ($user->coin + $number);
        $user->save();
    }

    public static function minusCoin(){
        $user = User::find(getIdUser());
        $user->coin = ($user->coin - 1);
        $user->save();
    }

    
}
