<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CanhGioiController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ModController;
use App\Http\Controllers\ThanhVienController;
Auth::routes();

Route::get('/', [HomeController::class, 'TrangChu'])->name('trangchu');
//Đăng nhập | đăng ký
Route::get('/dang-nhap', [HomeController::class, 'DangNhap'])->name('trangchu.dang_nhap');
Route::get('/dang-ky', [HomeController::class, 'DangKy'])->name('trangchu.dang_ky');

Route::get('/truyen', [HomeController::class, 'DanhSachTruyen'])->name('trangchu.danh_sach_truyen');
Route::get('/truyen-hoan-thanh', [HomeController::class, 'getTruyenHoanThanh_All'])->name('trangchu.truyen_hoan_thanh');
Route::get('/truyen-moi-cap-nhat', [HomeController::class, 'getTruyenMoiCapNhat'])->name('trangchu.truyen_moi_cap_nhat');
Route::get('/truyen-hot', [HomeController::class, 'getTruyenHOT'])->name('trangchu.truyen_hot');
Route::get('/the-loai', [HomeController::class, 'getTheLoaiTruyen'])->name('trangchu.the_loai');
Route::get('/the-loai/{name_slug}', [HomeController::class, 'getTruyen_TheLoai'])->name('trangchu.truyen_the_loai');
Route::get('/tim-kiem', [HomeController::class, 'getSearch'])->name('trangchu.tim_kiem');
Route::get('/loai-truyen/{name}', [HomeController::class, 'getTruyen_LoaiTruyen'])->name('trangchu.loai_truyen');
Route::get('/tac-gia/{name}', [HomeController::class, 'getTruyenCungTacGia'])->name('trangchu.tac_gia');
Route::get('/truyen/{name_slug}', [HomeController::class, 'Truyen'])->name('trangchu.truyen');
Route::get('/truyen/{truyen}/{chuong}', [HomeController::class, 'Chuong'])->name('trangchu.chuong');
Route::post('/truyen/binh-luan', [HomeController::class, 'postBinhLuanTruyen'])->name('trangchu.truyen_binh_luan');
Route::post('/truyen/van-de', [HomeController::class, 'ajaxTruyenProblem'])->name('trangchu.truyen_van_de');
Route::post('/truyen/de-cu', [HomeController::class, 'ajaxTruyenDeCu'])->name('trangchu.truyen_de_cu');
//Tủ sách
Route::post('/truyen/them-vao-tu-sach', [HomeController::class, 'ajaxThemVaoTuSach'])->name('trangchu.truyen_them_tu_sach');
Route::post('/truyen/xoa-khoi-tu-sach', [HomeController::class, 'ajaxXoaKhoiTuSach'])->name('trangchu.truyen_xoa_tu_sach');
//Hướng dẫn | điều khoản | chính sách
Route::get('/huong-dan-website', [HomeController::class, 'getHuongDan'])->name('trangchu.huongdan');
Route::get('/dieu-khoan-dich-vu', [HomeController::class, 'getDieuKhoan'])->name('trangchu.dieukhoan');
Route::get('/chinh-sach-bao-mat', [HomeController::class, 'getChinhSach'])->name('trangchu.chinhsach');

//Liên hệ
Route::get('/lien-he', [HomeController::class, 'getLienHe'])->name('trangchu.lienhe');
Route::post('/lien-he/post', [HomeController::class, 'postLienHe'])->name('trangchu.lienhe.post');
//Phản hồi
Route::get('/phan-hoi', [HomeController::class, 'getPhanHoi'])->name('trangchu.phanhoi');
Route::post('/phan-hoi/post', [HomeController::class, 'postPhanHoi'])->name('trangchu.phanhoi.post');

//Gen source
//Route::get('/tao-chuong/{id}', [HomeController::class, 'genChap']);

Route::get('/quen-mat-khau', [HomeController::class, 'getQuenMatKhau'])->name('trangchu.quenmatkhau');
Route::post('/quen-mat-khau/post', [HomeController::class, 'postQuenMatKhau'])->name('trangchu.quenmatkhau.post');


Route::prefix('dien-dan')->group(function(){
    Route::get('/', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/dang-bai', [ForumController::class, 'getDangBai'])->name('forum.dangbai');
    Route::post('/dang-bai/post', [ForumController::class, 'postDangBai'])->name('forum.dangbai.post');
    Route::get('/dien-dan/{title}', [ForumController::class, 'getBaiDang'])->name('forum.baidang');
});

//Member authentication
Route::middleware('auth')->group(function(){
    //Bảng điều khiển
    Route::get('/bang-dieu-khien', [MemberController::class, 'dashboard'])->name('member.dashboard');

    //Tủ sách
    Route::get('/tu-sach', [HomeController::class, 'getTruyenTuSach'])->name('trangchu.tu_sach');

    //Đánh giá | like chương
    Route::post('/post-danh-gia-truyen', [HomeController::class, 'postDanhGiaTruyen'])->name('trangchu.post.danhgia');
    Route::post('/post-like-chuong', [HomeController::class, 'ajaxLikeChuong'])->name('trangchu.post.like_chuong');

    //Đăng truyện
    Route::get('/dang-truyen', [MemberController::class, 'DangTruyen'])->name('member.dashboard.post');
    Route::post('/dang-truyen/add', [MemberController::class, 'postDangTruyen'])->name('member.dashboard.post_add');

    //Truyện đã đăng
    Route::get('/truyen-da-dang', [MemberController::class, 'TruyenDaDang'])->name('member.dashboard.my_story');

    //Sửa truyện
    Route::get('/truyen-da-dang/{name_slug}/chinh-sua', [MemberController::class, 'SuaTruyen'])->name('member.dashboard.my_story.edit');
    Route::post('/dashboard/my-story/edit/post', [MemberController::class, 'postSuaTruyen'])->name('member.dashboard.my_story.edit_post');

    //Chi tiết truyện
    Route::get('/truyen-da-dang/{name_slug}/chi-tiet', [MemberController::class, 'ChiTietTruyen'])->name('member.dashboard.my_story.detail');

    //Thêm chương -> ngoài
    Route::get('/truyen-da-dang/{name_slug}/them-chuong', [MemberController::class, 'getThemChuong'])->name('member.dashboard.my_story.add_chapter');
    Route::post('/dashboard/my-story/add-chapter', [MemberController::class, 'postThemChuong'])->name('member.dashboard.my_story.add_chapter_post');

    //Danh sách chương
    Route::get('/truyen-da-dang/{name_slug}/danh-sach-chuong', [MemberController::class, 'getDanhSachChuong'])->name('member.dashboard.my_story.list_chapter');

    //Thêm chương -> trong
    Route::get('/truyen-da-dang/{name_slug}/danh-sach-chuong/them-chuong', [MemberController::class, 'getTruyen_ThemChuong'])->name('member.dashboard.my_story.list_chapter.add_chap');
    Route::post('/dashboard/my-story/list-chapter/add-chapter', [MemberController::class, 'postTruyen_ThemChuong'])->name('member.dashboard.my_story.list_chapter.post_add_chap');

    //Sửa chương
    Route::get('/truyen-da-dang/{name_slug}/sua-chuong/{chuong_id}', [MemberController::class, 'getTruyen_SuaChuong'])->name('member.my_story.list_chapter.get_edit');
    Route::post('/dashboard/my-story/post-edit-chapter', [MemberController::class, 'postTruyen_SuaChuong'])->name('member.post_edit_chapter');
    
    //Xóa chương
    Route::get('/delete-hide-chapter', [MemberController::class, 'getTruyen_DeleteChuong_Hide'])->name('member.delete_hide_chapter');

    //Khôi phục chương
    Route::get('/delete-show-chapter', [MemberController::class, 'getTruyen_DeleteChuong_Show'])->name('member.delete_show_chapter');

    //Đánh lại số chương
    Route::get('/retype-num-chapter', [MemberController::class, 'DanhLaiSoChuong'])->name('member.retype_num_chapter');

    //Khóa chương
    Route::get('/lock-chapter', [MemberController::class, 'KhoaChuong'])->name('member.lock_chapter');

    //Mở khóa chương
    Route::get('/un-lock-chapter', [MemberController::class, 'MoKhoaChuong'])->name('member.un_lock_chapter');

    //Làm mới số chữ trong chương | truyện
    Route::get('/lam-moi-so-chu/{truyen_id}', [MemberController::class, 'getLamMoiSoChu_Truyen'])->name('member.refreshNumLetters');

    //Xóa chương vĩnh viễn - xóa cứng
    Route::get('/xoa-chuong/{truyen_id}', [MemberController::class, 'deleteChuong_UserClick'])->name('member.delete__userclick');

    //Ajax lấy chương hiển thị
    Route::get('/xem-chuong-hien-thi', [MemberController::class, 'ajaxGetChuong_HienThi'])->name('member.view_chapter_show');

    //Ajax add thành viên truyện
    Route::get('/ajax-add-members-story', [ThanhVienController::class, 'ajaxThemThanhVien'])->name('member.add_members_story');

    //Ajax get thành viên truyện -> images
    Route::get('/ajax-get-images-members-story', [ThanhVienController::class, 'getThanhVien_Truyen'])->name('member.get_members_story');

    //Ajax xoa thành viên truyện
    Route::get('/ajax-delete-images-members-story', [ThanhVienController::class, 'ajaxXoaThanhVien'])->name('member.delete_members_story');










    //Ajax lấy chương bị xóa (ẩn đi thôi chứ không xóa thiệt)
    Route::get('/xem-chuong-bi-xoa', [MemberController::class, 'ajaxGetChuong_BiAn'])->name('member.view_chapter_delete');

    //Truyện -> nhật ký
    Route::get('/truyen-da-dang/{name_slug}/nhat-ky', [MemberController::class, 'NhatKyTruyen'])->name('member.story.diary');

    //Truyện -> thiết lập
    Route::get('/truyen-da-dang/{name_slug}/thiet-lap', [MemberController::class, 'TruyenThietLap'])->name('member.story.setting');
    Route::post('save-setting', [MemberController::class, 'postTruyenThietLap'])->name('member.save.setting');

    //Truyện -> vấn đề
    Route::get('/truyen-da-dang/{name_slug}/van-de', [MemberController::class, 'getVanDePhatSinh'])->name('member.story.problem');
    Route::post('/update-check-problem', [MemberController::class, 'ajaxUpdateCheckProblem'])->name('member.story.update_check_problem');

    //Truyện -> thành viên
    //Route::get('/dashboard/my-story/{name_slug}/member', [MemberController::class, 'getThanhVien_Truyen'])->name('member.story.member');

    //Craw chương
    Route::get('/truyen-da-dang/{name_slug}/craw-chuong', [MemberController::class, 'getCrawChuong'])->name('member.story.craw');
    Route::get('/dashboard/my-story/craw-ajax', [MemberController::class, 'ajax_CrawChuong'])->name('member.story.craw_ajax');
    Route::post('/dashboard/my-story/post-craw-save', [MemberController::class, 'postCrawChuong'])->name('member.story.craw_save');

    //Tài khoản
    Route::get('/tai-khoan', [MemberController::class, 'Account_Profile'])->name('member.account');
    
    //Tài khoản -> hoạt động
    Route::get('/tai-khoan/hoat-dong', [MemberController::class, 'getHoatDong_Account'])->name('member.account.diary');
    
    //Tài khoản -> bình luận
    Route::get('/tai-khoan/binh-luan', [MemberController::class, 'getBinhLuan_Account'])->name('member.account.comment');

    //Tài khoản -> thiết lạp
    Route::get('/tai-khoan/thiet-lap', [MemberController::class, 'Account_Setting'])->name('member.account.setting');
    Route::post('/upload-profile-member', [MemberController::class, 'ChangeDisplayNameAndStatus'])->name('member.account.upload_profile');

    //Tài khoản -> thiết lạp -> chi tiết
    Route::get('/tai-khoan/thiet-lap/chi-tiet', [MemberController::class, 'Account_Setting_Detail'])->name('member.account.setting.detail');
    Route::post('/update-profile-detail', [UserController::class, 'updateDetailAccount'])->name('member.account.upload_detail');

    //Tài khoản -> thiết lạp -> thông báo
    Route::get('/tai-khoan/thiet-lap/thong-bao', [MemberController::class, 'Account_Setting_Notify'])->name('member.account.setting.notify');

    //Tài khoản -> thiết lạp -> thanh toán
    Route::get('/tai-khoan/thiet-lap/thanh-toan', [MemberController::class, 'Account_Setting_Billing'])->name('member.account.setting.billing');
    
    //Thông báo
    Route::get('/thong-bao', [MemberController::class, 'getThongBao'])->name('member.notify');
    Route::get('/update-thong-bao', [MemberController::class, 'ajaxUpdateStatusThongBao'])->name('member.update.notify');
    Route::get('/delete-notification', [MemberController::class, 'ajaxDeleteNotification'])->name('member.delete.notify');

    //Thay đổi ảnh đại diện và ảnh bìa
    Route::post('/crop-avatar', [UserController::class, 'CropAvatar'])->name('user.cropAvatar');
    Route::post('/crop-avatar-cover', [UserController::class, 'CropAvatar_Cover'])->name('user.cropAvatar.cover');
    //Tủ sách của tôi
    Route::get('/tu-truyen-cua-toi', [MemberController::class, 'getTuSachCuaToi'])->name('member.bookmarks');

});

//Mod authentication
Route::prefix('chap-su')->middleware('mod')->group(function(){
    Route::get('/bang-dieu-khien', [ModController::class, 'dashboard'])->name('mod.dashboard');

    //Đăng truyện
    Route::get('/dang-truyen', [ModController::class, 'DangTruyen'])->name('mod.dang_truyen');
    Route::post('/dang-truyen/post', [ModController::class, 'postDangTruyen'])->name('mod.dang_truyen.them');

    //Truyện đã đăng
    Route::get('/truyen-da-dang', [ModController::class, 'TruyenDaDang'])->name('mod.truyen_da_dang');

    //Sửa truyện
    Route::get('/truyen-da-dang/{name_slug}/chinh-sua', [ModController::class, 'SuaTruyen'])->name('mod.dang_truyen.sua');
    Route::post('/truyen-da-dang/chinh-sua/post', [ModController::class, 'postSuaTruyen'])->name('mod.dang_truyen.post_chinh_sua');

    //Chi tiết truyện
    Route::get('/truyen-da-dang/{name_slug}/chi-tiet', [ModController::class, 'ChiTietTruyen'])->name('mod.truyen_da_dang.chi_tiet');

    //Thêm chương -> ngoài
    Route::get('/truyen-da-dang/{name_slug}/them-chuong', [ModController::class, 'getThemChuong'])->name('mod.truyen_da_dang.them_chuong');
    Route::post('/truyen-da-dang/post-them-chuong', [ModController::class, 'postThemChuong'])->name('mod.truyen_da_dang.post_them_chuong');

    //Danh sách chương
    Route::get('/truyen-da-dang/{name_slug}/danh-sach-chuong', [ModController::class, 'getDanhSachChuong'])->name('mod.truyen_da_dang.danh_sach_chuong');

    //Thêm chương -> trong
    Route::get('/truyen-da-dang/{name_slug}/danh-sach-chuong/them-chuong', [ModController::class, 'getTruyen_ThemChuong'])->name('mod.truyen_da_dang.truyen_them_chuong');
    Route::post('/truyen-da-dang/truyen-post-them-chuong', [ModController::class, 'postTruyen_ThemChuong'])->name('mod.truyen_da_dang.truyen_post_them_chuong');

    //Sửa chương
    Route::get('/truyen-da-dang/{name_slug}/danh-sach-chuong/chinh-sua', [ModController::class, 'getTruyen_SuaChuong'])->name('mod.truyen_da_dang.sua_chuong');
    Route::post('/truyen-da-dang/post-sua-chuong', [ModController::class, 'postTruyen_SuaChuong'])->name('mod.truyen_da_dang.post_sua_chuong');
    
    //Xóa chương
    Route::get('/ajax-xoa-chuong', [ModController::class, 'getTruyen_DeleteChuong_Hide'])->name('mod.ajax_xoa_chuong');
    
    //Khôi phục chương
    Route::get('/ajax-khoi-phuc-chuong', [ModController::class, 'getTruyen_DeleteChuong_Show'])->name('mod.ajax_khoi_phuc_chuong');
    
    //Đánh lại số chương
    Route::get('/ajax-danh-lai-so-chuong', [ModController::class, 'DanhLaiSoChuong'])->name('mod.ajax_danh_lai_so_chuong');
    
    //Khóa chương
    Route::get('/ajax-khoa-chuong', [ModController::class, 'KhoaChuong'])->name('mod.ajax_khoa_chuong');
    
    //Mở khóa chương
    Route::get('/ajax-mo-khoa-chuong', [ModController::class, 'MoKhoaChuong'])->name('mod.ajax_mo_khoa_chuong');

    //Làm mới số chữ trong chương | truyện
    Route::get('/lam-moi-so-chu/{truyen_id}', [ModController::class, 'getLamMoiSoChu_Truyen'])->name('mod.refreshNumLetters');

    //Vấn đề truyện
    Route::get('/truyen-da-dang/{name_slug}/van-de', [ModController::class, 'getVanDePhatSinh'])->name('mod.truyen_da_dang.van_de');
    Route::post('/truyen-da-dang/ajax-da-fix-van-de', [ModController::class, 'ajaxUpdateCheckProblem'])->name('mod.truyen_da_dang.ajax_van_de');

    //Nhật ký truyện
    Route::get('/truyen-da-dang/{name_slug}/nhat-ky', [ModController::class, 'NhatKyTruyen'])->name('mod.truyen_da_dang.nhat_ky');

    //Cấu hình truyện
    Route::get('/truyen-da-dang/{name_slug}/thiet-lap', [ModController::class, 'TruyenThietLap'])->name('mod.truyen_da_dang.thiet_lap');
    Route::post('/truyen-da-dang/post-thiet-lap', [ModController::class, 'postTruyenThietLap'])->name('mod.truyen_da_dang.post_thiet_lap');

    //Thành viên của truyện
    // Route::get('/dashboard/my-story/{name_slug}/member', [ModController::class, 'getThanhVien_Truyen'])->name('member.story.member');

    //Craw chương
    Route::get('/truyen-da-dang/{name_slug}/craw-chuong', [ModController::class, 'getCrawChuong'])->name('mod.truyen_da_dang.craw_chuong');
    Route::post('/dashboard/my-story/craw-ajax', [ModController::class, 'ajax_CrawChuong'])->name('mod.truyen_da_dang.craw_ajax');

    //Tài khoản -> tổng quan
    Route::get('/tai-khoan', [ModController::class, 'Account_Profile'])->name('mod.tai_khoan');

    //Tài khoản -> hoạt động
    Route::get('/tai-khoan/hoat-dong', [ModController::class, 'getHoatDong_Account'])->name('mod.tai_khoan.hoat_dong');

    //Tài khoản -> bình luận
    Route::get('/tai-khoan/binh-luan', [ModController::class, 'getBinhLuan_Account'])->name('mod.tai_khoan.binh_luan');

    //Tài khoản -> thiết lập [đổi ảnh đại diện, tên hiển thị, trạng thái]
    Route::get('/tai-khoan/thiet-lap', [ModController::class, 'Account_Setting'])->name('mod.tai_khoan.thiet_lap');
    Route::post('/tai-khoan/thiet-lap/cap-nhat-thong-tin', [ModController::class, 'ChangeDisplayNameAndStatus'])->name('mod.tai_khoan.cap_nhat_thong_tin');

    //Tài khoản -> thiết lập -> chi tiết
    Route::get('/tai-khoan/thiet-lap/tai-khoan', [ModController::class, 'Account_Setting_Detail'])->name('mod.tai_khoan.thiet_lap.chi_tiet');
    Route::post('/tai-khoan/thiet-lap/cap-nhat-tai-khoan', [UserController::class, 'updateDetailAccount_Mod'])->name('mod.tai_khoan.thiet_lap.cap_nhat_chi_tiet');

    //Tài khoản -> thiết lập -> thông báo
    Route::get('/tai-khoan/thiet-lap/thong-bao', [ModController::class, 'Account_Setting_Notify'])->name('mod.tai_khoan.thiet_lap.thong_bao');

    //Tài khoản -> thiết lập -> thanh toán
    Route::get('/tai-khoan/thiet-lap/thanh-toan', [ModController::class, 'Account_Setting_Billing'])->name('mod.tai_khoan.thiet_lap.thanh_toan');
    
    //Thông báo
    Route::get('/thong-bao', [ModController::class, 'getThongBao'])->name('mod.thong_bao');
    Route::get('/update-thong-bao', [ModController::class, 'ajaxUpdateStatusThongBao'])->name('mod.update.notify');

    //Tủ sách của tôi
    Route::get('/tu-truyen-cua-toi', [ModController::class, 'getTuSachCuaToi'])->name('mod.bookmarks');

    //Danh sách truyện
    Route::get('/danh-sach-truyen', [ModController::class, 'getDanhSachTruyen'])->name('mod.danh_sach_truyen');

    //Khóa truyện
    Route::post('/danh-sach-truyen/khoa-truyen', [ModController::class, 'postUpdateLockTruyen'])->name('mod.danh_sach_truyen.khoa_truyen');

    //Xóa truyện
    Route::post('/danh-sach-truyen/xoa-truyen', [ModController::class, 'ajaxDeleteTruyen'])->name('mod.danh_sach_truyen.xoa_truyen');

});

//Admin authentication
Route::prefix('admin')->middleware('admin')->group(function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    //Canh Gioi
    Route::get('/level', [CanhGioiController::class, 'index'])->name('admin.level');
    Route::post('/level/postCanhGioi', [CanhGioiController::class, 'postAdd'])->name('admin.post_level');
    Route::post('/level/postEditCanhGioi', [CanhGioiController::class, 'postEdit'])->name('admin.post_edit_level');
    Route::get('/level/DeleteCanhGioi', [CanhGioiController::class, 'Delete'])->name('admin.delete_level');

    //My Account
    Route::get('/account', [AdminController::class, 'Account_Profile'])->name('admin.account');
    Route::get('/account/setting', [AdminController::class, 'Account_Setting'])->name('admin.account.setting');

    Route::get('/account/setting/detail', [AdminController::class, 'Account_Setting_Detail'])->name('admin.account.setting.detail');
    Route::post('/account/setting/detail/update', [AdminController::class, 'UpdateDetailAccount'])->name('admin.account.setting.detail.update');

    Route::get('/account/diary', [AdminController::class, 'getHoatDong_Account'])->name('admin.account.diary');
    Route::get('/account/comment', [AdminController::class, 'getBinhLuan_Account'])->name('admin.account.comment');

    Route::get('/account/setting/notify', [AdminController::class, 'Account_Setting_Notify'])->name('admin.account.setting.notify');
    Route::get('/account/setting/billing', [AdminController::class, 'Account_Setting_Billing'])->name('admin.account.setting.billing');
    Route::post('/account/upload-profile-admin', [AdminController::class, 'ChangeDisplayNameAndStatus'])->name('admin.account.upload_profile');

    //The loai truyen
    Route::get('/type-story', [AdminController::class, 'TheLoaiTruyen'])->name('admin.type_story');
    Route::get('/type-story/delete', [AdminController::class, 'ajaxXoaTheLoaiTruyen'])->name('admin.type_story.delete');
    Route::post('/type-story/add', [AdminController::class, 'TheLoaiTruyen_Add'])->name('admin.type_story.add');
    Route::post('/type-story/edit', [AdminController::class, 'TheLoaiTruyen_Edit'])->name('admin.type_story.edit');

    //Chinh sach
    Route::get('/policy', [AdminController::class, 'getChinhSach'])->name('admin.policy');
    Route::post('/policy/post-policy', [AdminController::class, 'postChinhSach'])->name('admin.post_policy');
    //Dieu khoan
    Route::get('/rules', [AdminController::class, 'getDieuKhoan'])->name('admin.rules');
    Route::post('/rules/post-rules', [AdminController::class, 'postDieuKhoan'])->name('admin.post_rules');
    //Huong dan
    Route::get('/instruct', [AdminController::class, 'getHuongDan'])->name('admin.instruct');
    Route::post('/instruct/post-instruct', [AdminController::class, 'postHuongDan'])->name('admin.post_instruct');

    //Thanh vien
    Route::get('/users', [AdminController::class, 'getThanhVien'])->name('admin.users');
    Route::post('/users/lock', [AdminController::class, 'postKhoaTaiKhoan'])->name('admin.users.lock');
    Route::post('/users/update-role', [AdminController::class, 'postUpdateRole'])->name('admin.users.update_role');
    Route::post('/users/update-lock', [AdminController::class, 'postUpdateLockTruyen'])->name('admin.users.update_lock');

    //Danh sach truyen
    Route::get('/stories', [AdminController::class, 'getDanhSachTruyen'])->name('admin.stories');
    Route::post('/stories/delete', [AdminController::class, 'ajaxDeleteTruyen'])->name('admin.stories.delete');

    //Phản hồi & Liên hệ
    Route::get('/feedbacks', [AdminController::class, 'getPhanHoi'])->name('admin.feedbacks');
    Route::get('/contacts', [AdminController::class, 'getLienHe'])->name('admin.contacts');
    //Cấu hình hệ thống
    Route::get('/config-system', [AdminController::class, 'getCauHinhHeThong'])->name('admin.config_system');
    Route::post('/config-system/maintenance', [AdminController::class, 'ajaxBaoTri'])->name('admin.config_system.maintenance');
    Route::post('/config-system/craw', [AdminController::class, 'ajaxCrawData'])->name('admin.config_system.craw');
    Route::post('/config-system/google-login', [AdminController::class, 'ajaxGoogleLogin'])->name('admin.config_system.google_login');
    Route::post('/config-system/facebook-login', [AdminController::class, 'ajaxFacebookLogin'])->name('admin.config_system.facbook_login');
    
});