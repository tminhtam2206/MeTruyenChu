<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Carbon;
use App\Models\User;

class ModController extends Controller{
    public function dashboard(){
        $record = UserRecordController::show(5);
        $bug = TruyenVanDeController::getForUser();
        $truyen = TruyenController::TruyenMoiCapNhat_Index();

        return view('mod.index', compact(
            'record',
            'bug',
            'truyen',
        ));
    }

    //Đăng truyện
    public function DangTruyen(){
        $theloai_truyen = TheLoaiTruyenController::showAll();
        return view('mod.dang_truyen', compact('theloai_truyen'));
    }

    public function postDangTruyen(Request $request){
        $this->validate($request, [
            'name' => ['required', 'unique:truyen'],
            'author' => ['required'],
            'source' => ['max:255'],
            'description' => [''],
        ]);

        $truyen = TruyenController::add($request);

        if($truyen['status'] == 'true'){
            if($request->input('the_loai_truyen') != null){
                foreach($request->input('the_loai_truyen') as $value){
                    TruyenTheLoaiController::add($truyen['id'], $value);
                }
            }

            ghiLog('Đăng truyện ['.$request->name.']');
            UserController::updateTruyenDaDang();
            TangEXP(getIdUser(), 15);
            Toastr::success('Đăng truyện ['.$request->name.'] thành công!');
            ThanhVienController::addThanhVien($truyen['id']);
            UserController::plusCoin(10);

            ThongBaoController::add('Tạo truyện thành công', route('mod.truyen_da_dang'));

            return redirect()->route('mod.truyen_da_dang');
        }else{
            Toastr::error('Truyện ['.$request->name.'] đã tồn tại!');
            return redirect()->route('mod.dang_truyen');
        }
    }

    //Sửa truyện
    public function SuaTruyen($name_slug){
        $truyen = TruyenController::showOneRecord($name_slug);
        $theloai_truyen = TheLoaiTruyenController::showAll();
        $truyen_theloai = TruyenTheLoaiController::show(splitID($name_slug));
            
        return view('mod.sua_truyen', compact(
            'truyen', 
            'theloai_truyen', 
            'truyen_theloai'
        ));
    }

    public function postSuaTruyen(Request $request){
        if(TruyenController::edit($request)){
            TruyenTheLoaiController::delete($request->id);
            if($request->input('the_loai_truyen') != null){
                foreach($request->input('the_loai_truyen') as $value){
                    TruyenTheLoaiController::add($request->id, $value);
                }
            }
            ghiLog('Chỉnh sửa truyện ['.$request->name.']');
            Toastr::success('Chỉnh sửa truyện ['.$request->name.'] thành công!');
            
            return redirect()->route('mod.truyen_da_dang');
        }else{
            Toastr::error('Truyện ['.$request->name.'] đã tồn tại!');
            return redirect()->route('mod.dang_truyen.sua', ['name_slug' => $request->name_slug]);
        }
    }

    //Truyện của tôi | Truyện đã đăng
    public function TruyenDaDang(){
        $truyen = TruyenController::getTruyenDaDang_DESC(25);
        return view('mod.truyen_da_dang', compact('truyen'));
    }

    //Chi tiết truyện
    public static function ChiTietTruyen($name_slug){
        $truyen = TruyenController::showOneRecord($name_slug);
        $chuong = ChuongController::getDanhSachChuong_Short($truyen->id, 5);
        $record = TruyenRecordController::get($truyen->id, 5);
        $comment = TruyenBinhLuanController::getCommentByIdTruyen($truyen->id, 5);
        $danhgia = TruyenDanhGiaController::getMarks($truyen->id);
        
        $days = Carbon::today();
        $day7 = date('Y-m-d', strtotime($days));
        $day6 = date('Y-m-d', strtotime($days->addDays(-1)));
        $day5 = date('Y-m-d', strtotime($days->addDays(-1)));
        $day4 = date('Y-m-d', strtotime($days->addDays(-1)));
        $day3 = date('Y-m-d', strtotime($days->addDays(-1)));
        $day2 = date('Y-m-d', strtotime($days->addDays(-1)));
        $day1 = date('Y-m-d', strtotime($days->addDays(-1)));

        $val_day7 = TruyenThongKeController::get($truyen->id, $day7);
        $val_day6 = TruyenThongKeController::get($truyen->id, $day6);
        $val_day5 = TruyenThongKeController::get($truyen->id, $day5);
        $val_day4 = TruyenThongKeController::get($truyen->id, $day4);
        $val_day3 = TruyenThongKeController::get($truyen->id, $day3);
        $val_day2 = TruyenThongKeController::get($truyen->id, $day2);
        $val_day1 = TruyenThongKeController::get($truyen->id, $day1);

        return view('mod.truyen.chi_tiet_truyen', compact(
            'truyen', 
            'chuong', 
            'record',
            'comment',
            'danhgia',
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
        ));
    }

    //Thêm chương
    public function getThemChuong($name_slug){
        $truyen = TruyenController::showOneRecord($name_slug);
        if($truyen->lock == 'N'){
            return view('mod.them_chuong', compact('truyen'));
        }

        return abort(404);
    }

    public function postThemChuong(Request $request){
        ChuongController::add($request);
        TruyenController::updateNumChap($request->truyen_id);
        TruyenController::updateDateUpdate($request->truyen_id);
        TruyenRecordController::add($request->truyen_id, $request->numchap, 'Thêm chương');
        TangEXP(getIdUser(), 5);
        Toastr::success('Thêm chương thành công!');
        ThongBaoController::getThongBaoTuSach($request->truyen_id);
        TruyenController::updateNumLetters($request->truyen_id);
        UserController::plusCoin(1);
        
        if($request->submit  == 'save_and_edit'){
            return redirect()->route('mod.truyen_da_dang.sua_chuong', ['name_slug' => ChuongController::getNameSlugNewAdd($request->truyen_id)]);
        }else{
            return redirect()->route('mod.truyen_da_dang.danh_sach_chuong', ['name_slug' => $request->truyen_name_slug]);
        }
    }

    //Vấn đề phát sinh
    public function getVanDePhatSinh($name_slug){
        $truyen = TruyenController::showOneRecord($name_slug);
        $vande = TruyenVanDeController::show($truyen->id, 25);
        $danhgia = TruyenDanhGiaController::getMarks($truyen->id);

        return view('mod.truyen.van_de', compact(
            'truyen', 
            'vande',
            'danhgia',
        ));
    }

    //Ajax đã fix vấn đề
    public function ajaxUpdateCheckProblem(Request $request){
        TruyenVanDeController::updateStatus($request);
    }

    //Danh sách chương -> chi tiết truyện
    public function getDanhSachChuong($name_slug){
        $truyen = TruyenController::showOneRecord($name_slug);
        ChuongController::deleteForever($truyen->id);
        $chuong = ChuongController::getDanhSachChuong($truyen->id, 25);
        $chuong_del = ChuongController::getDanhSachChuong_DEL($truyen->id);
        $danhgia = TruyenDanhGiaController::getMarks($truyen->id);

        return view('mod.truyen.danh_sach_chuong', compact(
            'truyen', 
            'chuong', 
            'chuong_del',
            'danhgia',
        ));
    }

    //Thêm chương -> chi tiết truyện
    public function getTruyen_ThemChuong($name_slug){
        $truyen = TruyenController::showOneRecord($name_slug);
        if($truyen->lock == 'N'){
            return view('mod.truyen.them_chuong', compact('truyen'));
        }

        return abort(404);
    }

    public function postTruyen_ThemChuong(Request $request){
        ChuongController::add($request);
        TruyenController::updateNumChap($request->truyen_id);
        TruyenController::updateDateUpdate($request->truyen_id);
        TruyenRecordController::add($request->truyen_id, $request->numchap, 'Thêm chương');
        Toastr::success('Thêm chương thành công!');
        TruyenController::updateNumLetters($request->truyen_id);

        ThongBaoController::getThongBaoTuSach($request->truyen_id);
        UserController::plusCoin(1);
        
        if($request->submit  == 'save_and_edit'){
            return redirect()->route('mod.truyen_da_dang.sua_chuong', ['name_slug' => ChuongController::getNameSlugNewAdd($request->truyen_id)]);
        }else{
            return redirect()->route('mod.truyen_da_dang.danh_sach_chuong', ['name_slug' => $request->truyen_name_slug]);
        }
    }

    //Sửa chương -> chi tiết truyện
    public function getTruyen_SuaChuong($name_slug){
        $truyen = TruyenController::getTruyenByID(getIDTruyenByNameChuong($name_slug));
        $chuong = ChuongController::getOneRecord(splitID($name_slug));
        $prev_chuong = ChuongController::getShowChap_mod($truyen->id, $chuong->numchap-1);
        $next_chuong = ChuongController::getShowChap_mod($truyen->id, $chuong->numchap+1);

        return view('mod.truyen.sua_chuong', compact(
            'truyen', 
            'chuong',
            'prev_chuong',
            'next_chuong',
        ));
    }

    public function postTruyen_SuaChuong(Request $request){
        ChuongController::edit($request);
        TruyenRecordController::add($request->truyen_id, $request->numchap, 'Sửa chương');
        Toastr::success('Sửa chương thành công!');
        TruyenController::updateNumLetters($request->truyen_id);

        if($request->submit  == 'save_and_edit'){
            return redirect()->route('mod.truyen_da_dang.sua_chuong', ['name_slug' => ChuongController::getNameSlugById($request->id)]);
        }
        else{
            return redirect()->route('mod.truyen_da_dang.danh_sach_chuong', ['name_slug' => $request->truyen_name_slug]);
        }
    }

    //Ajax xóa chương | ẩn chương -> public
    public function getTruyen_DeleteChuong_Hide(Request $request){
        ChuongController::deleteHide($request->id);
        ChuongController::LamMoiSoChuByID($request->id);
        $truyen_id = ChuongController::getIdTruyenByIdChuong($request->id);
        TruyenController::updateNumLetters($truyen_id);
    }

    //Ajax khôi phục chương | hiển thị chương -> public
    public function getTruyen_DeleteChuong_Show(Request $request){
        ChuongController::updateShow($request->id);
        ChuongController::LamMoiSoChuByID($request->id);        
        $truyen_id = ChuongController::getIdTruyenByIdChuong($request->id);
        TruyenController::updateNumLetters($truyen_id);
    }

    //Ajax đánh lại số chương
    public function DanhLaiSoChuong(Request $request){
        ChuongController::retypeNumChapter($request->truyen_id);
    }

    //Ajax khóa chương
    public function KhoaChuong(Request $request){
        ChuongController::lockChap($request->id);
    }

    //Ajax mở khóa chương
    public function MoKhoaChuong(Request $request){
        ChuongController::unLockChap($request->id);
    }

    //Nhật ký chi tiết truyện
    public function NhatKyTruyen($name_slug){
        $truyen = TruyenController::showOneRecord($name_slug);
        $record = TruyenRecordController::show(splitID($name_slug));
        $danhgia = TruyenDanhGiaController::getMarks($truyen->id);

        return view('mod.truyen.nhat_ky', compact(
            'record', 
            'truyen',
            'danhgia',
        ));
    }

    //Cấu hình truyện | Thiết lập truyện
    public function TruyenThietLap($name_slug){
        $truyen = TruyenController::showOneRecord($name_slug);
        $danhgia = TruyenDanhGiaController::getMarks($truyen->id);

        return view('mod.truyen.thiet_lap', compact('truyen', 'danhgia'));
    }

    public function postTruyenThietLap(Request $request){
        TruyenController::updateSetting($request);
        $truyen = TruyenController::showOneRecord($request->name_slug);

        return redirect()->route('mod.truyen_da_dang.thiet_lap', ['name_slug'=>$request->name_slug]);
    }

    //Craw chương
    public function getCrawChuong($name_slug){
        if(getCraw() == 'Y'){
            $truyen = TruyenController::showOneRecord($name_slug);
            $danhgia = TruyenDanhGiaController::getMarks($truyen->id);

            return view('mod.truyen.craw_chuong', compact('truyen', 'danhgia'));
        }

        return abort(404);
    }

    public function ajax_CrawChuong(Request $request){
        $html = file_get_html($request->source);
        $title_ = $html->find(".chapter-title");
		$content_ = $html->find(".chapter-c");

        $numchap = getNumchap($title_[0]->plaintext);
        $title = getName($title_[0]->plaintext);
        $content = $content_[0]->plaintext;
        $content = str_replace("\n", "<br/>", $content);
        $content = str_replace("truyenfull.vn", "", $content);
        $content = str_replace("TruyenFull.vn", "", $content);
        $content = str_replace("Quảng cáo", "", $content);

        return response()->json([
            'num'=>$numchap,
            'title'=>$title, 
            'content'=>$content
        ]);
    }

    // //Thành viên của truyện
    // public function getThanhVien_Truyen($name_slug){
    //     return view('member.truyen.thanh_vien');
    // }

    //Tài khoản
    public function Account_Profile(){
        $tusach = TruyenController::getTruyenTuSach(5);
        $truyen = TruyenController::getTruyenDaDang_DESC(5);

        return view('mod.account.overview', compact('tusach', 'truyen'));
    }

    //Hồ sơ tài khoản | Đổi ảnh đại diện
    public function Account_Setting(){
        return view('mod.account.profile_setting_profile');
    }

    //Đổi tên hiển thị và trạng thái
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

        return redirect()->route('mod.tai_khoan.thiet_lap');
    }

    //Chi tiết tài khoản
    public function Account_Setting_Detail(){
        return view('mod.account.profile_setting_account');
    }

    //Cài đặt nhận thông báo
    public function Account_Setting_Notify(){
        return view('mod.account.profile_setting_notify');
    }

    //Cài đặt thanh toán
    public function Account_Setting_Billing(){
        return view('mod.account.profile_setting_billing');
    }

    //Hoạt động gần đây
    public function getHoatDong_Account(){
        $record = UserRecordController::show(25);
        return view('mod.account.profile_diary', compact('record'));
    }

    //Bình luận gần đây
    public function getBinhLuan_Account(){
        $comment = TruyenBinhLuanController::getCommentByUser(25);
        return view('mod.account.profile_comment', compact('comment'));
    }

    //Xem thông báo
    public function getThongBao(){
        $thongbao = ThongBaoController::get();
        ThongBaoController::updateStatus();

        return view('mod.thongbao', compact('thongbao'));
    }

    //Ajax đã xem tất cả thông báo
    public function ajaxUpdateStatusThongBao(){
        ThongBaoController::updateStatus();
    }

    //Tủ sách của tôi
    public function getTuSachCuaToi(){
        $tusach = TruyenController::getTruyenTuSach(25);
        return view('mod.tusach', compact('tusach'));
    }

    //Danh sách truyện
    public function getDanhSachTruyen(){
        $truyen = TruyenController::getAll();
        return view('mod.danh_sach_truyen', compact('truyen'));
    }

    //Khóa truyện
    public function postUpdateLockTruyen(Request $request){
        TruyenController::updateLock($request);
        return redirect()->route('mod.danh_sach_truyen');
    }

    public function ajaxDeleteTruyen(Request $request){
        TruyenController::delete($request);
    }

    public function getLamMoiSoChu_Truyen($truyen_id){
        $truyen = TruyenController::getDeltailTruyen($truyen_id);
        ChuongController::LamMoiSoChu_Chuong($truyen_id);
        TruyenController::updateNumLetters($truyen_id);
        return redirect()->route('mod.truyen_da_dang.danh_sach_chuong', ['name_slug' => $truyen->name_slug]);
    }
}
