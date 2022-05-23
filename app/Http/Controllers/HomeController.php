<?php

namespace App\Http\Controllers;

use App\Models\TheLoaiTruyen;
use App\Models\TruyenBinhLuan;
use App\Models\TuSach;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class HomeController extends Controller{
    public function __construct(){
        ThongKeController::add();
    }

    public function DangNhap(){
        if(getIdUser() > 0){
            return redirect()->route('trangchu');
        }

        return view('login');
    }

    public function postDangNhap(Request $request){
        
    }

    public function DangKy(){
        if(getIdUser() > 0){
            return redirect()->route('trangchu');
        }
        
        return view('register');
    }
    
    public function TrangChu(){
        $truyenHot = TruyenController::getTruyenHot(6);
        $truyenUpdate = TruyenController::getTruyenMoiCapNhat(30);
        $truyenComplete = TruyenController::getTruyenHoanThanh(11);
        $tien_hiep = TruyenController::getTruyenTheoTheLoai('tien-hiep', 10);
        $huyen_huyen = TruyenController::getTruyenTheoTheLoai('huyen-huyen', 10);
        $do_thi = TruyenController::getTruyenTheoTheLoai('do-thi', 10);
        $ngon_tinh = TruyenController::getTruyenTheoTheLoai('ngon-tinh', 10);
        $slideHOT = TruyenController::getTruyenHot(3);

        return view('home.index', compact(
            'truyenHot',
            'truyenUpdate',
            'truyenComplete',
            'tien_hiep',
            'huyen_huyen',
            'do_thi',
            'ngon_tinh',
            'slideHOT'
        ));
    }

    public function getTheLoaiTruyen(){
        $theloai = TheLoaiTruyenController::showAll();
        return view('home.the_loai', compact('theloai'));
    }

    public function getTruyen_TheLoai($name_slug){
        $truyen = TruyenController::getTruyenTheoTheLoai($name_slug, 30);
        $name = TheLoaiTruyenController::getNameByNameSlug($name_slug);
        $page = 1;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $numOfPage = ceil((TruyenController::countGetTruyenTheoTheLoai($name_slug)/25));
        if($numOfPage == 0) $numOfPage = 1;

        return view('home.truyen_the_loai', compact(
            'truyen', 
            'name',
            'page',
            'numOfPage',
        ));
    }

    public function DanhSachTruyen(){
        $truyen = TruyenController::getDanhSachTruyen();
        $page = 1;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $numOfPage = ceil((TruyenController::count()/25));
        if($numOfPage == 0) $numOfPage = 1;

        return view('home.danh_sach_truyen', compact(
            'truyen',
            'page',
            'numOfPage',
        ));
    }

    public function Truyen($name_slug){
        $truyen = TruyenController::getDeltailTruyen(splitID($name_slug));
        if($truyen->delete == 'N'){
            $theloai = TruyenTheLoaiController::show($truyen->id);
            $chuongmoi = ChuongController::get5ChuongMoiNhat($truyen->id);
            $chuong = ChuongController::getChuong($truyen->id);
            $cungtacgia = TruyenController::getTruyenCungTacGia($truyen->id);
            $binhluan = TruyenBinhLuanController::show($truyen->id);
            $point_marks = TruyenDanhGiaController::getMarks($truyen->id);
            $danhgia = TruyenDanhGiaController::get($truyen->id);
            //TruyenThongKeController::addViews($truyen->id);
            $numOfPage = ceil(($truyen['num_chaps']/25));
            
            $page = 1;
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }
            
            return view('home.truyen', compact(
                'truyen', 
                'theloai', 
                'chuongmoi', 
                'chuong', 
                'cungtacgia',
                'binhluan',
                'point_marks',
                'danhgia',
                'numOfPage',
                'page'
            ));
        }
        else{
            return abort(404);
        }
    }

    public function Chuong($truyen, $chuong){
        $numchap = explode('-', $chuong)[1];
        $truyen = TruyenController::getDeltailTruyen(splitID($truyen));
        
        if($truyen->delete == 'N'){
            $chuong = ChuongController::getDetailChapByNumChap($truyen['id'], $numchap);
            TruyenController::updateViews($truyen['id']);
            ChuongController::updateViews($chuong['id']);
            $binhluan = TruyenBinhLuanController::show($truyen['id']);
            TruyenThongKeController::addViews($truyen['id']);
            TangEXP(getIdUser(), 1);
            $thanhvien = ThanhVienController::checkThanhVien($truyen->id);
            //set cookie in 1 month
            setcookie('read-'.$truyen->id, 'chuong-'.$numchap, time() + 2592000, "/");

            $read_story = false;

            if($chuong->user_id == getIdUser() || $thanhvien == true){
                $read_story = true;
            }
            else{
                if(getCoin() > 0){
                    UserController::minusCoin();
                    $read_story = true;
                }
            }

            return view('home.chuong', compact(
                'truyen',
                'chuong',
                'binhluan',
                'thanhvien',
                'read_story'
            ));
        }
        else{
            abort(404);
        }
    }

    public function getTruyenHoanThanh_All(){
        $truyen = TruyenController::getTruyenHoanThanh(30);
        $page = 1;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $numOfPage = ceil((TruyenController::countTruyenHoanThanh()/25));
        if($numOfPage == 0) $numOfPage = 1;

        return view('home.truyen_complete', compact(
            'truyen',
            'page',
            'numOfPage',
        ));
    }

    public function getTruyenMoiCapNhat(){
        $truyen = TruyenController::getTruyenMoiCapNhat(30);
        $page = 1;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $numOfPage = ceil((TruyenController::count()/25));
        if($numOfPage == 0) $numOfPage = 1;

        return view('home.truyen_moi_cap_nhat', compact(
            'truyen',
            'page',
            'numOfPage',
        ));
    }

    public function getSearch(Request $request){
        $truyen = TruyenController::getTimTruyen($request->key);
        return view('home.tim_kiem', compact('truyen'));
    }

    public function getTruyen_LoaiTruyen($name){
        $truyen = TruyenController::getTruyenTheoLoaiTruyen($name, 30);
        $page = 1;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $numOfPage = ceil((TruyenController::countgetTruyenTheoLoaiTruyen($name)/25));
        if($numOfPage == 0) $numOfPage = 1;

        return view('home.loai_truyen', compact(
            'truyen', 
            'name',
            'page',
            'numOfPage',
        ));
    }

    public function getTruyenCungTacGia($name){
        $truyen = TruyenController::getTruyen_TacGia($name, 30);
        $page = 1;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $numOfPage = ceil((TruyenController::CountGetTruyen_TacGia($name)/25));
        if($numOfPage == 0) $numOfPage = 1;

        return view('home.tac_gia', compact(
            'truyen', 
            'name',
            'page',
            'numOfPage',
        ));
    }

    public function getTruyenHOT(){
        $truyen = TruyenController::getTruyenHot(30);
        $page = 1;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $numOfPage = ceil((TruyenController::count()/25));
        if($numOfPage == 0) $numOfPage = 1;

        return view('home.truyen_hot', compact(
            'truyen', 
            'page',
            'numOfPage',
        ));
    }

    public function postBinhLuanTruyen(Request $request){
        TruyenBinhLuanController::add($request);
        UserController::updateNumComment();
        TangEXP(getIdUser(), 2);
        UserRecordController::add('Bình luận truyện ['.TruyenController::getNameByID($request->truyen_id).']');

        return '<li class="media mb-2">
            <img src="'.getAvatar(Auth::user()->avatar).'" width="75" class="mr-3 rounded-circle" alt="'.Auth::user()->display_name.'">
            <div class="media-body">
                <h5 class="mt-0 mb-1">'.Auth::user()->display_name.'
                    <div class="float-right badge badge-success" style="font-weight: 400; font-size: 16px; border-radius: 12px;">
                        '.Auth::user()->exp_level.'
                    </div>
                </h5>
                <small class="text-muted">
                    <i class="far fa-clock"></i> 1 giây trước |
                    <i class="fas fa-glasses"></i> Chương '.$request->chap.'
                </small>
                <p>'.$request->content.'</p>
            </div>
        </li>';
    }

    public function ajaxTruyenProblem(Request $request){
        TruyenVanDeController::add($request);
        TangEXP(getIdUser(), 3);
        UserRecordController::add('Báo lỗi truyện ['.TruyenController::getNameByID($request->truyen_id).']');
    }

    public function ajaxTruyenDeCu(Request $request){
        TruyenController::updateDeCu($request);
        TruyenThongKeController::addVote($request->truyen_id);
        TangEXP(getIdUser(), 5);
        UserRecordController::add('Đề cử truyện ['.TruyenController::getNameByID($request->truyen_id).']');
    }

    public function ajaxThemVaoTuSach(Request $request){
        TuSachController::add($request);
        UserRecordController::add('Thêm truyện ['.TruyenController::getNameByID($request->truyen_id).'] vào tủ sách');
    }

    public function ajaxXoaKhoiTuSach(Request $request){
        $sach = TuSachController::delete($request);
        UserRecordController::add('Xóa truyện ['.TruyenController::getNameByID($request->truyen_id).'] khỏi tủ sách');
        return $sach;
    }

    public function getTruyenTuSach(){
        $truyen = TruyenController::getTruyenTuSach(25);
        $totalTruyen = TruyenController::countGetTruyenTuSach();
        $page = 1;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $numOfPage = ceil(($totalTruyen/25));
        if($numOfPage == 0) $numOfPage = 1;

        return view('home.tu_sach', compact(
            'truyen',
            'page',
            'numOfPage',
            'totalTruyen'
        ));
    }
    
    public function postDanhGiaTruyen(Request $request){
        TruyenDanhGiaController::add($request);
        return redirect()->route('trangchu.truyen', ['name_slug' => TruyenController::getNameSlug($request->truyen_id)]);
    }

    public function ajaxLikeChuong(Request $request){
        ChuongController::updateLike($request->id);
    }

    public function getHuongDan(){
        $huongdan = ThietLapWebController::getHuongDan();
        return view('home.huongdan', compact('huongdan'));
    }

    public function getDieuKhoan(){
        $dieukhoan = ThietLapWebController::getDieuKhoan();
        return view('home.dieukhoan', compact('dieukhoan'));
    }

    public function getChinhSach(){
        $chinhsach = ThietLapWebController::getChinhSach();
        return view('home.chinhsach', compact('chinhsach'));
    }

    //Liên hệ
    public function getLienHe(){
        return view('home.lienhe');
    }

    public function postLienHe(Request $request){
        LienHeController::add($request);
        Toastr::success('Để lại thông tin liên hệ thành công!');
        return redirect()->route('trangchu');
    }

    public function getPhanHoi(){
        return view('home.phanhoi');
    }

    public function postPhanHoi(Request $request){
        PhanHoiController::add($request);
        Toastr::success('Phản hồi thành công!');
        return redirect()->route('trangchu');
    }

    //Gen source
    public function genChap($id){
        GenSourceController::genChap($id);
    }

    public function getQuenMatKhau(){
        return view('forget_password');
    }

    public function postQuenMatKhau(Request $request){
        $user = UserController::KhoiPhucMatKhau($request);
        if(!$user){
            Toastr::error('Tên đăng nhập hoặc địa chỉ email không đúng!');
            return redirect()->route('trangchu.quenmatkhau');
        }else{
            return redirect()->route('trangchu.dang_nhap')->with('success','Khôi phục mật khẩu thành công!<br/>Mật khẩu mới của bạn là <b>'.$user.'</b>');
        }
    }

    public function getInfoMember(Request $request){
        
    }
}
