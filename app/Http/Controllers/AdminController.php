<?php

namespace App\Http\Controllers;

use App\Models\TheLoaiTruyen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class AdminController extends Controller{
    public function __construct(){
        
    }

    public function dashboard(){
        $users = UserController::count();
        $truyen = TruyenController::count();
        $theloai = TheLoaiTruyenController::count();
        $days = Carbon::today();

        $truyen_binhthuong = TruyenController::Count_BinhThuong();
        $truyen_bikhoa = TruyenController::Count_BiKhoa();
        $truyen_bixoa = TruyenController::Count_BiXoa();
        $truyen_hoanthanh = TruyenController::Count_HoanThanh();
        $truyen_dangcapnhat = TruyenController::Count_DangCapNhat();
        $truyen_ngung = TruyenController::Count_Ngung();

        $user_thanhvien = UserController::count_ThanhVien();
        $user_chapsu = UserController::count_ChapSu();
        $user_quantri = UserController::count_QuanTri();

        $day7 = date('Y-m-d', strtotime($days));
        $day6 = date('Y-m-d', strtotime($days->addDays(-1)));
        $day5 = date('Y-m-d', strtotime($days->addDays(-1)));
        $day4 = date('Y-m-d', strtotime($days->addDays(-1)));
        $day3 = date('Y-m-d', strtotime($days->addDays(-1)));
        $day2 = date('Y-m-d', strtotime($days->addDays(-1)));
        $day1 = date('Y-m-d', strtotime($days->addDays(-1)));

        $val_day7 = ThongKeController::get($day7);
        $val_day6 = ThongKeController::get($day6);
        $val_day5 = ThongKeController::get($day5);
        $val_day4 = ThongKeController::get($day4);
        $val_day3 = ThongKeController::get($day3);
        $val_day2 = ThongKeController::get($day2);
        $val_day1 = ThongKeController::get($day1);

        $lienhe = LienHeController::get(5);
        $phanhoi = PhanHoiController::get(5);

        return view('admin.index', compact(
            'users',
            'truyen',
            'theloai',
            'day7',
            'day6',
            'day5',
            'day4',
            'day3',
            'day2',
            'day1',
            'val_day7',
            'val_day6',
            'val_day5',
            'val_day4',
            'val_day3',
            'val_day2',
            'val_day1',
            'truyen_binhthuong',
            'truyen_bikhoa',
            'truyen_bixoa',
            'truyen_hoanthanh',
            'truyen_dangcapnhat',
            'truyen_ngung',
            'user_thanhvien',
            'user_chapsu',
            'user_quantri',
            'lienhe',
            'phanhoi',
        ));
    }

    //Hồ sơ cá nhân
    public function Account_Profile(){
        $tusach = TruyenController::getTruyenTuSach(5);
        $truyen_dadang = TruyenController::getTruyenDaDang_DESC(5);

        return view('admin.account.overview', compact(
            'tusach',
            'truyen_dadang'
        ));
    }

    public function Account_Setting(){
        return view('admin.account.profile_setting_profile');
    }

    //Chi tiết tài khoản
    public function Account_Setting_Detail(){
        return view('admin.account.profile_setting_account');
    }

    public function UpdateDetailAccount(Request $request){
        UserController::updateDetailAccount_Admin($request);
        return redirect()->route('admin.account.setting.detail');
    }

    public function getHoatDong_Account(){
        $record = UserRecordController::show(25);

        return view('admin.account.profile_diary', compact('record'));
    }

    public function getBinhLuan_Account(){
        $comment = TruyenBinhLuanController::getCommentByUser(25);

        return view('admin.account.profile_comment', compact('comment'));
    }

    public function Account_Setting_Notify(){
        return view('admin.account.profile_setting_notify');
    }

    public function Account_Setting_Billing(){
        return view('admin.account.profile_setting_billing');
    }

    public function ChangeDisplayNameAndStatus(Request $request){
        $user = User::find(Auth::user()->id);
        $user->display_name = $request->display_name;
        $user->status = $request->status;
        $user->save();
        if(!empty($request->display_name)){
            ghiLog('Đổi tên hiển thị từ ['.$request->oldName.'] thành ['.$request->display_name.']');
        }
        if(!empty($request->status)){
            ghiLog('Thay đổi trạng thái');
        }
        return redirect()->route('admin.account.setting');
    }

    //Hệ thống cảnh giới
    public function CanhGioi(){
        return view('admin.canh_gioi');
    }

    //Thể loại truyện
    public function TheLoaiTruyen(){
        $theloai_truyen = TheLoaiTruyenController::showAll();

        return view('admin.the_loai_truyen', compact('theloai_truyen'));
    }

    public function ajaxXoaTheLoaiTruyen(Request $request){
        TheLoaiTruyenController::delete($request);
    }

    public function TheLoaiTruyen_Add(Request $request){
        if(TheLoaiTruyenController::add($request)){
            ghiLog('Thêm thể loại ['.$request->name.']');
            Toastr::success("Thêm thể loại thành công!");
            return redirect()->route('admin.type_story');
        }
        else{
            Toastr::error('Thể loại ['.$request->name.'] đã tồn tại');
            return redirect()->route('admin.type_story');
        }
    }

    public function TheLoaiTruyen_Edit(Request $request){
        if(TheLoaiTruyenController::edit($request)){
            ghiLog('Sửa thể loại ['.$request->oldName.'] thành ['.$request->name.']');
            return redirect()->route('admin.type_story');
        }
        else{
            return redirect()->route('admin.type_story')->with('message', 'Thể loại ['.$request->name.'] đã tồn tại');
        }
    }

    //Chính sách
    public function getChinhSach(){
        $chinhsach = ThietLapWebController::getChinhSach();

        return view('admin.chinhsach', compact('chinhsach'));
    }

    public function postChinhSach(Request $request){
        ThietLapWebController::saveChinhSach($request);

        return redirect()->route('admin.policy');
    }

    //Điều khoản
    public function getDieuKhoan(){
        $dieukhoan = ThietLapWebController::getDieuKhoan();

        return view('admin.dieukhoan', compact('dieukhoan'));
    }

    public function postDieuKhoan(Request $request){
        ThietLapWebController::saveDieuKhoan($request);

        return redirect()->route('admin.rules');
    }

    //Hướng dẫn
    public function getHuongDan(){
        $huongdan = ThietLapWebController::getHuongDan();
        return view('admin.huongdan', compact('huongdan'));
    }

    public function postHuongDan(Request $request){
        ThietLapWebController::saveHuongDan($request);
        return redirect()->route('admin.instruct');
    }

    //Thành viên
    public function getThanhVien(){
        $thanhvien = UserController::getAll();
        return view('admin.thanhvien', compact('thanhvien'));
    }

    public function postUpdateRole(Request $request){
        UserController::updateRole($request);
        Toastr::success("Cập nhật thành công!");
        return redirect()->route('admin.users');
    }

    public function postKhoaTaiKhoan(Request $request){
        UserController::LockAccount($request);
        Toastr::success("Cập nhật thành công!");
        return redirect()->route('admin.users');
    }

    //Danh sách truyện
    public function getDanhSachTruyen(){
        $truyen = TruyenController::getAll();
        return view('admin.truyen', compact('truyen'));
    }

    public function postUpdateLockTruyen(Request $request){
        TruyenController::updateLock($request);
        return redirect()->route('admin.stories');
    }

    public function ajaxDeleteTruyen(Request $request){
        TruyenController::delete($request);
    }

    //Phản hồi
    public function getPhanHoi(){
        $phanhoi = PhanHoiController::getAll();
        return view('admin.phanhoi', compact('phanhoi'));
    }

    //Liên hệ
    public function getLienHe(){
        $lienhe = LienHeController::getAll();
        return view('admin.lienhe', compact('lienhe'));
    }

    //Cấu hình hệ thống
    public function getCauHinhHeThong(){
        $config = ConfigSystemController::getConfigSystem();
        return view('admin.cauhinh_hethong', compact('config'));
    }

    //Cập nhật trạng thái bảo trì
    public function ajaxBaoTri(){
        ConfigSystemController::updateMaintenance();
    }

    //Craw data
    public function ajaxCrawData(){
        ConfigSystemController::updateCrawData();
    }

    //Google login
    public function ajaxGoogleLogin(){
        ConfigSystemController::updateGoogleLogin();
    }

    //Facebook login
    public function ajaxFacebookLogin(){
        ConfigSystemController::updateFacebookLogin();
    }
}
