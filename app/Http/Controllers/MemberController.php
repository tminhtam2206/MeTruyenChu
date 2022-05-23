<?php

namespace App\Http\Controllers;

use App\Models\Truyen;
use App\Models\User;
use Aws\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class MemberController extends Controller{
    public function dashboard(){
        $record = UserRecordController::show(5);
        $bug = TruyenVanDeController::getForUser();
        $truyen = TruyenController::TruyenMoiCapNhat_Index();

        return view('member.index', compact(
            'record',
            'bug',
            'truyen',
        ));
    }

    //Đăng truyện
    public function DangTruyen(){
        $theloai_truyen = TheLoaiTruyenController::showAll();
        return view('member.dang_truyen', compact('theloai_truyen'));
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
            UserController::plusCoin(10);
            Toastr::success('Đăng truyện ['.$request->name.'] thành công!');
            ThanhVienController::addThanhVien($truyen['id']);

            ThongBaoController::add('Tạo truyện thành công', route('member.dashboard.my_story'));

            return redirect()->route('member.dashboard.my_story');
        }else{
            Toastr::error('Truyện ['.$request->name.'] đã tồn tại!');
            return redirect()->route('member.dashboard.post');
        }
    }

    //Sửa truyện
    public function SuaTruyen($name_slug){
        $truyen = TruyenController::showOneRecord($name_slug);
        $theloai_truyen = TheLoaiTruyenController::showAll();
        $truyen_theloai = TruyenTheLoaiController::show(splitID($name_slug));
            
        return view('member.sua_truyen', compact(
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
            
            return redirect()->route('member.dashboard.my_story');
        }else{
            Toastr::error('Truyện ['.$request->name.'] đã tồn tại!');
            return redirect()->route('member.dashboard.my_story.edit', ['name_slug' => $request->name_slug]);
        }
    }

    //Truyện của tôi | Truyện đã đăng
    public function TruyenDaDang(){
        $truyen = TruyenController::getTruyenDaDang_DESC(25);
        return view('member.truyen_da_dang', compact('truyen'));

        //backup data
        // foreach(Truyen::where('user_id', getIdUser())->where('delete', 'N')->get() as $val){
        //     ThanhVienController::addThanhVien2($val->user_id, $val->id);
        // }
    }

    //Chi tiết truyện
    public static function ChiTietTruyen($name_slug){
        $truyen = TruyenController::showOneRecord($name_slug);
        $chuong = ChuongController::getDanhSachChuong_Short($truyen->id, 5);
        $record = TruyenRecordController::get($truyen->id, 5);
        $comment = TruyenBinhLuanController::getCommentByIdTruyen($truyen->id, 5);
        $danhgia = TruyenDanhGiaController::getMarks($truyen->id);
        $thanhvien = UserController::GetThanhVien();
        
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

        return view('member.truyen.chi_tiet_truyen', compact(
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
            'thanhvien'
        ));
    }

    //Thêm chương
    public function getThemChuong($name_slug){
        $truyen = TruyenController::showOneRecord($name_slug);
        if($truyen->lock == 'N'){
            return view('member.them_chuong', compact('truyen'));
        }

        return abort(404);
    }

    public function postThemChuong(Request $request){
        ChuongController::add($request);
        TruyenController::updateNumChap($request->truyen_id);
        //TruyenController::updateDateUpdate($request->truyen_id);
        TruyenRecordController::add($request->truyen_id, $request->numchap, 'Thêm chương');
        TangEXP(getIdUser(), 5);
        Toastr::success('Thêm chương thành công!');
        ThongBaoController::getThongBaoTuSach($request->truyen_id);
        TruyenController::updateNumLetters($request->truyen_id);
        UserController::plusCoin(1);
        
        return redirect()->route('member.dashboard.my_story.add_chapter', ['name_slug' => $request->truyen_name_slug]);
    }

    public function postCrawChuong(Request $request){
        ChuongController::add($request);
        TruyenController::updateNumChap($request->truyen_id);
        //TruyenController::updateDateUpdate($request->truyen_id);
        TruyenRecordController::add($request->truyen_id, $request->numchap, 'Thêm chương');
        TangEXP(getIdUser(), 5);
        Toastr::success('Thêm chương thành công!');
        ThongBaoController::getThongBaoTuSach($request->truyen_id);
        TruyenController::updateNumLetters($request->truyen_id);
        UserController::plusCoin(1);
        
        return redirect()->route('member.story.craw', ['name_slug' => $request->truyen_name_slug]);
    }

    //Vấn đề phát sinh
    public function getVanDePhatSinh($name_slug){
        $truyen = TruyenController::showOneRecord($name_slug);
        $vande = TruyenVanDeController::show($truyen->id, 25);
        $danhgia = TruyenDanhGiaController::getMarks($truyen->id);
        $thanhvien = UserController::GetThanhVien();

        return view('member.truyen.van_de', compact(
            'truyen', 
            'vande',
            'danhgia',
            'thanhvien'
        ));
    }

    //Danh sách chương -> chi tiết truyện
    public function getDanhSachChuong($name_slug){
        $truyen = TruyenController::showOneRecord($name_slug);
        ChuongController::deleteForever($truyen->id);
        $chuong = ChuongController::getDanhSachChuong_Short($truyen->id, 25);
        $danhgia = TruyenDanhGiaController::getMarks($truyen->id);
        $thanhvien = UserController::GetThanhVien();

        return view('member.truyen.danh_sach_chuong', compact(
            'truyen', 
            'chuong',
            'danhgia',
            'thanhvien'
        ));
    }

    //Thêm chương -> chi tiết truyện
    public function getTruyen_ThemChuong($name_slug){
        $truyen = TruyenController::showOneRecord($name_slug);
        if($truyen->lock == 'N'){
            return view('member.truyen.them_chuong', compact('truyen'));
        }

        return abort(404);
    }

    public function postTruyen_ThemChuong(Request $request){
        ChuongController::add($request);
        TruyenController::updateNumChap($request->truyen_id);
        //TruyenController::updateDateUpdate($request->truyen_id);
        TruyenRecordController::add($request->truyen_id, $request->numchap, 'Thêm chương');
        Toastr::success('Thêm chương thành công!');
        TruyenController::updateNumLetters($request->truyen_id);

        ThongBaoController::getThongBaoTuSach($request->truyen_id);
        UserController::plusCoin(1);
        
        if($request->submit  == 'save_and_edit'){
            return redirect()->route('member.my_story.list_chapter.get_edit', ['name_slug' => ChuongController::getNameSlugNewAdd($request->truyen_id)]);
        }else{
            return redirect()->route('member.dashboard.my_story.list_chapter.add_chap', ['name_slug' => $request->truyen_name_slug]);
        }
    }

    //Sửa chương -> chi tiết truyện
    public function getTruyen_SuaChuong($name_slug, $chuong_id){
        $array = explode("-", $name_slug);
        $truyen = TruyenController::getTruyenByID($array[count($array) - 1]);
        $chuong = ChuongController::getOneRecord($chuong_id);
        $prev_chuong = ChuongController::getShowChap($truyen['id'], $truyen['name_slug'], $chuong->numchap-1);
        $next_chuong = ChuongController::getShowChap($truyen->id, $truyen['name_slug'], $chuong->numchap+1);

        return view('member.truyen.sua_chuong', compact(
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
            return redirect()->route('member.my_story.list_chapter.get_edit', ['name_slug'=>$request->truyen_name_slug, 'chuong_id'=>$request->id]);
        }
        else{
            return redirect()->route('member.dashboard.my_story.list_chapter', ['name_slug' => $request->truyen_name_slug]);
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

    //Đánh lại số chương
    public function DanhLaiSoChuong(Request $request){
        ChuongController::retypeNumChapter($request->truyen_id);
        return redirect()->route('member.dashboard.my_story.list_chapter', ['name_slug' => TruyenController::getNameSlug($request->truyen_id)]); 
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
        $thanhvien = UserController::GetThanhVien();

        return view('member.truyen.nhat_ky', compact(
            'record', 
            'truyen',
            'danhgia',
            'thanhvien'
        ));
    }

    //Cấu hình truyện | Thiết lập truyện
    public function TruyenThietLap($name_slug){
        $truyen = TruyenController::showOneRecord($name_slug);
        $danhgia = TruyenDanhGiaController::getMarks($truyen->id);
        $thanhvien = UserController::GetThanhVien();

        return view('member.truyen.thiet_lap', compact(
            'truyen', 
            'danhgia',
            'thanhvien'
        ));
    }

    public function postTruyenThietLap(Request $request){
        TruyenController::updateSetting($request);
        $truyen = TruyenController::showOneRecord($request->name_slug);

        return redirect()->route('member.story.setting', ['name_slug'=>$request->name_slug]);
    }

    //Craw chuong
    public function getCrawChuong($name_slug){
        if(getCraw() == 'Y'){
            $truyen = TruyenController::showOneRecord($name_slug);
            $danhgia = TruyenDanhGiaController::getMarks($truyen->id);
            $thanhvien = UserController::GetThanhVien();

            return view('member.truyen.craw_chuong', compact(
                'truyen', 
                'danhgia',
                'thanhvien'
            ));
        }

        return abort(404);
    }

    public function ajax_CrawChuong(Request $request){
        if(Str::contains($request->source, 'truyenfull.vn') == true){
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
                'num'       =>  $numchap,
                'title'     =>  trim($title), 
                'content'   =>  $content
            ]);
        }

        if(Str::contains($request->source, 'wattpad.vn') == true){
            $html = file_get_html($request->source);
            $title_ = $html->find(".rv-chapt-title");
            $content_ = $html->find(".container1 p");

            $numchap = getNumchap2($title_[0]->plaintext);
            $title = getName($title_[0]->plaintext);
            $content = $content_[0]->plaintext;
            $content = str_replace("\n", "<br/>", $content);
            $content = clearHTML_DTruyen($content);

            return response()->json([
                'num'       =>  $numchap,
                'title'     =>  trim($title), 
                'content'   =>  $content
            ]);
        }

        if(Str::contains($request->source, 'sstruyen.com') == true){
            $html = file_get_html($request->source);
            $title_ = $html->find(".rv-chapt-title");
            $content_ = $html->find(".container1 p");

            $numchap = getNumchap2($title_[0]->plaintext);
            $title = getName($title_[0]->plaintext);
            $content = $content_[0]->plaintext;
            $content = str_replace("\n", "<br/>", $content);
            $content = clearHTML_DTruyen($content);

            return response()->json([
                'num'       =>  $numchap,
                'title'     =>  trim($title), 
                'content'   =>  $content
            ]);
        }
    }

    //Thành viên của truyện
    public function getThanhVien_Truyen(){
        
    }

    ///Tài khoản
    public function Account_Profile(){
        $tusach = TruyenController::getTruyenTuSach(5);
        $truyen = TruyenController::getTruyenDaDang_DESC(5);

        return view('member.account.overview', compact('tusach', 'truyen'));
    }

    //Hồ sơ tài khoản | Đổi ảnh đại diện
    public function Account_Setting(){
        return view('member.account.profile_setting_profile');
    }

    //Chi tiết tài khoản
    public function Account_Setting_Detail(){
        return view('member.account.profile_setting_account');
    }

    //Cài đặt nhận thông báo
    public function Account_Setting_Notify(){
        return view('member.account.profile_setting_notify');
    }

    //Cài đặt thanh toán
    public function Account_Setting_Billing(){
        return view('member.account.profile_setting_billing');
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

        return redirect()->route('member.account.setting');
    }

    //Ajax kiểm tra vấn đề lỗi truyện
    public function ajaxUpdateCheckProblem(Request $request){
        TruyenVanDeController::updateStatus($request);
    }

    //Hoạt động gần đây
    public function getHoatDong_Account(){
        $record = UserRecordController::show(25);
        return view('member.account.profile_diary', compact('record'));
    }

    //Bình luận gần đây
    public function getBinhLuan_Account(){
        $comment = TruyenBinhLuanController::getCommentByUser(25);
        return view('member.account.profile_comment', compact('comment'));
    }

    //Ajax đã xem tất cả thông báo
    public function ajaxUpdateStatusThongBao(){
        ThongBaoController::updateStatus();
    }

    //Ajax delete tất cả thông báo
    public function ajaxDeleteNotification(){
        ThongBaoController::delete();
    }

    //Ajax xem thông báo hoạt động
    public function getThongBao(){
        $thongbao = ThongBaoController::get();
        ThongBaoController::updateStatus();

        return view('member.thongbao', compact('thongbao'));
    }

    //Tủ sách của tôi
    public function getTuSachCuaToi(){
        $tusach = TruyenController::getTruyenTuSach(25);
        return view('member.tusach', compact('tusach'));
    }

    //Làm mới số chử trong chương
    public function getLamMoiSoChu_Truyen($truyen_id){
        $truyen = TruyenController::getDeltailTruyen($truyen_id);
        ChuongController::LamMoiSoChu_Chuong($truyen_id);
        TruyenController::updateNumLetters($truyen_id);
        return redirect()->route('member.dashboard.my_story.list_chapter', ['name_slug' => $truyen->name_slug]);
    }

    public function deleteChuong_UserClick($truyen_id){
        $truyen = TruyenController::getDeltailTruyen($truyen_id);
        ChuongController::deleteForever_UserClick($truyen->id);
        return redirect()->route('member.dashboard.my_story.list_chapter', ['name_slug' => $truyen->name_slug]);
    }

    public function ajaxGetChuong_HienThi(Request $request){
        $truyen = TruyenController::getTruyenByID($request->id);
        $chuong = ChuongController::getDanhSachChuong($truyen->id, 25);
        $data = '<div class="card card-fluid mt-3">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th width="25">#</th>
                            <th> SỐ CHƯƠNG</th>
                            <th> TÊN CHƯƠNG</th>
                            <th> CÔNG KHAI</th>
                            <th> KHÓA CHƯƠNG</th>
                            <th> LƯỢT ĐỌC</th>
                            <th> SỐ CHỮ</th>
                            <th> THỜI GIAN</th>
                            <th class="text-right" width="125"> HÀNH ĐỘNG&nbsp;&nbsp;&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>';

        $i = 1;
        foreach($chuong as $val){
            $data .= '<tr id="chuong-'.$val->id.'">
            <td class="align-middle font-weight-bold" width="25">'.$i.'</td>
            <td class="align-middle">Chương '.$val->numchap.'</td>
            <td class="align-middle"><a href="'.route('trangchu.chuong', ['truyen'=>$truyen->name_slug, 'chuong'=>$val->name_slug]).'" target="_blank">'.$val->name.'</a></td>
            <td class="align-middle"><i class="fas fa-eye"></i> Có</td>';

            if($val->lock == 'Y'){
                $data .= '<td class="align-middle">
                    <span id="check-'.$val->id.'" style="color: red;"><i id="icon-lock-'.$val->id.'" class="fas fa-lock-alt"></i> Khóa</span>
                </td>';
            }else{
                $data .= '<td class="align-middle">
                    <span id="check-'.$val->id.'"><i id="icon-lock-'.$val->id.'" class="fas fa-unlock-alt"></i> Không</span>
                </td>';
            }

            $data .= '<td class="align-middle">'.number_format($val->view).'</td>
                <td class="align-middle">'.number_format($val->number_letters).'</td>
                <td class="align-middle">'.$val->created_at->diffForHumans().'</td>
                <td class="align-middle text-right">
                    <a href="'.route('member.my_story.list_chapter.get_edit', ['name_slug'=>$val->name_slug]).'" class="btn btn-sm btn-icon btn-secondary">
                        <i class="far fa-edit"></i>
                    </a>
                    <button class="btn btn-sm btn-icon btn-secondary" onclick="RequestLockChap(`'.$val->id.'`, `'.$val->name.'`)">
                        <i class="fas fa-lock-alt"></i>
                    </button>
                    <button class="btn btn-sm btn-icon btn-secondary" onclick="Confirm_Delete(`'.$val->id.'`, `'.$val->name.'`)">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>';
            $i++;
        }

        $data .= '</tbody></table></div></div>';
        echo $data;
    }

    public function ajaxGetChuong_BiAn(Request $request){
        $chuong_del = ChuongController::getDanhSachChuong_DEL($request->id);
        $data_1 = '';
        $i = 1;
        foreach($chuong_del as $val){
            $data_1 .= '<tr id="chuong-del-'.$val->id.'">
                <td class="align-middle font-weight-bold" width="25">'.$i.'</td>
                <td class="align-middle">Chương '.$val->numchap.'</td>
                <td class="align-middle">'.$val->name.'</td>
                <td class="align-middle"><span style="color: red;"><i class="fas fa-eye-slash"></i> Không</span></td>';
            
            if($val->lock == 'Y'){
                $data_1 .= '<td class="align-middle">
                    <span id="check-'.$val->id.'" style="color: red;"><i id="icon-lock-'.$val->id.'" class="fas fa-lock-alt"></i> Khóa</span>
                </td>';
            }else{
                $data_1 .= '<td class="align-middle">
                    <span id="check-'.$val->id.'"><i id="icon-lock-'.$val->id.'" class="fas fa-unlock-alt"></i> Không</span>
                </td>';
            }

            $data_1 .= '<td class="align-middle">'.number_format($val->views).'</td>
                <td class="align-middle">'.$val->created_at->diffForHumans().'</td>
                <td class="align-middle text-center">
                    <button class="btn btn-sm btn-icon btn-secondary" onclick="Confirm_Restore(`'.$val->id.'`, `'.$val->name.'`)">
                        <i class="fas fa-trash-restore"></i>
                    </button>
                </td>
            </tr>';
            $i++;
        }

        $data_2 = '<div class="alert alert-warning" role="alert">
            <i class="fas fa-exclamation-triangle"></i> Chương sẽ tự động xóa vĩnh viễn sau 30 ngày, kể từ ngày bỏ chương vào thùng rác. ';

        if(count($chuong_del) > 0){
            $data_2 .= '<a href="'.route("member.delete__userclick", ['truyen_id'=>$request->id]).'" onclick="return confirm(`Xóa vĩnh viễn, không cần đợi 30 ngày?`)"><i class="fas fa-trash"></i> Xóa vĩnh viễn</a>';
        }
        
        $data_2 .= '
        </div>
        <div class="card card-fluid mt-3">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th width="25">#</th>
                            <th> SỐ CHƯƠNG</th>
                            <th> TÊN CHƯƠNG</th>
                            <th> CÔNG KHAI</th>
                            <th> KHÓA CHƯƠNG</th>
                            <th> LƯỢT ĐỌC</th>
                            <th> THỜI GIAN</th>
                            <th class="text-right" width="125"> HÀNH ĐỘNG&nbsp;&nbsp;&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>';
        

        $data_3 = '</tbody>
                </table>
            </div>
        </div>';

        $result = $data_2.$data_1.$data_3;

        echo $result;
    }
}
