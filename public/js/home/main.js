var id_xoa = 0;

function Alert(messsage){
	$.confirm({
	    title: '<i class="fas fa-rocket"></i> Thông Báo!',
	    content: messsage,
	    type: 'purple',
	    autoClose: 'cancelAction|5000',
	    buttons: {
	        cancelAction:{
	        	text:'Đóng',
	        	btnClass: 'btn-blue'
	        }
	    }
	});
}

function LayLaiMatKhau(messsage){
	$.alert({
	    title: '<i class="fas fa-rocket"></i> Bạn Chính Là Chủ Tài Khoản!',
	    type: 'purple',
	    content: 'Mật khẩu mới của bạn là: [<b class="text-danger">'+messsage+'</b>] <br>Hãy <b>giữ kỹ</b> mật khẩu trên, sau đó <b>đăng nhập vào</b> rồi <b>đổi mật khẩu lại</b>!',
	});
}

function Error(messsage){
	$.confirm({
	    title: '<i class="fas fa-exclamation-triangle" style="color:gold;"></i> Lỗi!',
	    content: messsage,
	    type: 'red',
	    autoClose: 'cancelAction|15000',
	    buttons: {
	        cancelAction:{
	        	text:'Đóng',
	        	btnClass: 'btn-blue'
	        }
	    }
	});
}

function Confirm_Delete(user){
	var t = $('.x-'+user).css("color");

	if(t == "rgb(255, 0, 0)"){
		$.confirm({
		    title: '<i class="fas fa-rocket"></i> Thông Báo!',
		    content: 'Bạn có muốn <b>xóa</b> tài khoản [<b>'+user+'</b>] không?',
		    autoClose: 'cancelAction|10000',
		    type: 'purple',
		    buttons: {
		        deleteUser: {
		            text: '<i class="fas fa-trash"></i> Xóa',
		            btnClass: 'btn-red',
		            action: function () {
		            	$.post("./index.php?url=ajax-xoa-tai-khoan", {TenDangNhap: user}, function(data){
							if(data == 1){
								$('.tr-'+user).remove();
							}
						}); 
		            }
		        },
		        cancelAction:{
		        	text:'Đóng',
		        	btnClass: 'btn-blue'
		        }
		    }
		});
	}
	else{
		$.confirm({
		    title: '<i class="fas fa-rocket"></i> Thông Báo!',
		    content: 'Bạn có muốn <b>khôi phục</b> tài khoản [<b>'+user+'</b>] không?',
		    autoClose: 'cancelAction|10000',
		    type: 'purple',
		    buttons: {
		        deleteUser: {
		            text: '<i class="fas fa-trash-restore"></i> Khôi Phục',
		            btnClass: 'btn-red',
		            action: function () {
		            	$.post("./index.php?url=ajax-xoa-tai-khoan", {TenDangNhap: user}, function(data){
							if(data == 1){
								$('.tr-'+user).remove();
							}
						}); 
		            }
		        },
		        cancelAction:{
		        	text:'Đóng',
		        	btnClass: 'btn-blue'
		        }
		    }
		});
	}
}

function Confirm_Lock(user){
	var t = $('.t-'+user).css("color");
	if(t == "rgb(255, 0, 0)"){
		$.confirm({
		    title: '<i class="fas fa-rocket"></i> Thông Báo!',
		    content: 'Bạn có muốn <b>khóa</b> tài khoản [<b>'+user+'</b>] không?',
		    autoClose: 'cancelAction|10000',
		    type: 'purple',
		    buttons: {
		        deleteUser: {
		            text: '<i class="fas fa-lock-alt"></i> Khóa',
		            btnClass: 'btn-red',
		            action: function () {
		            	$.post("./index.php?url=ajax-khoa-tai-khoan", {TenDangNhap: user}, function(data){
							if(data == 1){
								$('.tr-'+user).remove();
							}
						}); 
		            }
		        },
		        cancelAction:{
		        	text:'Đóng',
		        	btnClass: 'btn-blue'
		        }
		    }
		});
	}
	else{
		$.confirm({
		    title: '<i class="fas fa-rocket"></i> Thông Báo!',
		    content: 'Bạn có muốn <b>mở khóa</b> tài khoản [<b>'+user+'</b>] không?',
		    autoClose: 'cancelAction|10000',
		    type: 'purple',
		    buttons: {
		        deleteUser: {
		            text: '<i class="fas fa-unlock-alt"></i> Mở',
		            btnClass: 'btn-red',
		            action: function () {
			    		$.post("./index.php?url=ajax-khoa-tai-khoan", {TenDangNhap: user}, function(data){
							if(data == 1){
								$('.tr-'+user).remove();
							}
						}); 
		            }
		        },
		        cancelAction:{
		        	text:'Đóng',
		        	btnClass: 'btn-blue'
		        }
		    }
		});
	}
}

function Confirm_Delete_TheLoai(tenTheLoai, idTheLoai){
	$.confirm({
	    title: '<i class="fas fa-rocket"></i> Thông Báo!',
	    content: 'Bạn có muốn <b>xóa</b> thể loại [<b>'+tenTheLoai+'</b>] không?',
	    autoClose: 'cancelAction|10000',
	    type: 'purple',
	    buttons: {
	        deleteUser: {
	            text: '<i class="fas fa-trash"></i> Xóa',
	            btnClass: 'btn-red',
	            action: function () {
	            	$.post("./index.php?url=ajax-xoa-the-loai", {id: idTheLoai}, function(data){
						if(data == 1){
							$('.theLoai-'+idTheLoai).remove();
						}
						else{
							Alert(data);
						}
					}); 
	            }
	        },
	        cancelAction:{
	        	text:'Đóng',
	        	btnClass: 'btn-blue'
	        }
	    }
	});
}

function Confirm_XoaChuong(tenChuong, idChuong, idTruyen){
	$.confirm({
	    title: '<i class="fas fa-rocket"></i> Thông Báo!',
	    content: 'Bạn có muốn <b>xóa</b> [<b>'+tenChuong+'</b>] không?',
	    autoClose: 'cancelAction|10000',
	    type: 'purple',
	    buttons: {
	        deleteUser: {
	            text: '<i class="fas fa-trash"></i> Xóa',
	            btnClass: 'btn-red',
	            action: function () {
	            	$.post("./index.php?url=ajax-xoa-chuong", {id: idChuong, id_truyen: idTruyen}, function(data){
						if(data == 1){
							$('#chuong-'+idChuong).remove();
						}
						else{
							Alert(data);
						}
					}); 
	            }
	        },
	        cancelAction:{
	        	text:'Đóng',
	        	btnClass: 'btn-blue'
	        }
	    }
	});
}

function Confirm_XoaTruyen(tenTruyen, idTruyen){
	$.confirm({
	    title: '<i class="fas fa-rocket"></i> Thông Báo!',
	    content: 'Bạn có muốn <b>xóa</b> truyện [<b>'+tenTruyen+'</b>] không?',
	    autoClose: 'cancelAction|10000',
	    type: 'purple',
	    buttons: {
	        deleteUser: {
	            text: '<i class="fas fa-trash"></i> Xóa',
	            btnClass: 'btn-red',
	            action: function () {
	            	$.post("./index.php?url=ajax-xoa-truyen", {id: idTruyen}, function(data){
						if(data == 'Delete Success'){
							$('.tr-'+idTruyen).remove();
						}
						else{
							Alert(data);
						}
					}); 
	            }
	        },
	        cancelAction:{
	        	text:'Đóng',
	        	btnClass: 'btn-blue'
	        }
	    }
	});
}



function Confirm(messsage){
	$.confirm({
	    title: '<i class="fas fa-rocket"></i> Thông Báo!',
	    content: messsage,
	    autoClose: 'cancelAction|10000',
	    buttons: {
	        deleteUser: {
	            text: '<i class="fas fa-trash"></i> Xóa',
	            btnClass: 'btn-red',
	            action: function () {
	            	$.post("./Ajax/delete_type", {id: id_xoa}, function(data){
						if(data == "true"){
							$('#del-'+id_xoa).remove();
						}
					}); 
	            }
	        },
	        cancelAction:{
	        	text:'Đóng',
	        	btnClass: 'btn-blue'
	        }
	    }
	});
}

$(document).ready(function(){
	$('.btn-xoa').click(function(){
	    id_xoa = $(this).attr('id');
	});
});

var check_change_pass = false;
var mk_ngan = false;
var xn_mk = false;

$(document).ready(function(){
	var moi = '';

	$('#MatKhauMoi').keyup(function(){
		var MatKhauMoi = $('#MatKhauMoi').val();
		moi = MatKhauMoi;

		if(MatKhauMoi == '' || MatKhauMoi.length < 6){
			$('#MatKhauMoi').removeClass('is-valid');
			$('#MatKhauMoi').addClass('is-invalid');
			check_change_pass = false;
			mk_ngan = false;
		}
		else{
			$('#MatKhauMoi').removeClass('is-invalid');
			$('#MatKhauMoi').addClass('is-valid');
			check_change_pass = true;
			mk_ngan = true;
		}
	});

	$('#XacNhanMatKhau').keyup(function(){
		var XacNhan = $('#XacNhanMatKhau').val();

		if(moi != XacNhan){
			$('#XacNhanMatKhau').removeClass('is-valid');
			$('#XacNhanMatKhau').addClass('is-invalid');
			check_change_pass = false;
			xn_mk = false;
		}
		else{
			$('#XacNhanMatKhau').removeClass('is-invalid');
			$('#XacNhanMatKhau').addClass('is-valid');
			check_change_pass = true;
			xn_mk = true;
		}
	});

	$('#MatKhauCu').keyup(function(){
		var MKCu = $('#MatKhauCu').val();

		if(MKCu.length < 6){
			$('#MatKhauCu').removeClass('is-valid');
			$('#MatKhauCu').addClass('is-invalid');
			check_change_pass = false;
		}
		else{
			$('#MatKhauCu').removeClass('is-invalid');
			$('#MatKhauCu').addClass('is-valid');
			check_change_pass = true;
		}
	});

});

function checkFormChangePass(){
	if(mk_ngan == false){
		Alert('Mật khẩu quá ngắn!');
		return false;
	}
	else if(xn_mk == false){
		Alert('Xác nhận mật khẩu mới không khớp!');
		return false;
	}
	else if(check_change_pass == false){
		Alert('Độ dài mật khẩu cũ quá ngắn!');
		return false;
	}

	return true;
}

$(document).ready(function(){
	$('#TimTaiKhoanDangMo').keyup(function(){
		if($(this).val() == ''){
			$.post("index.php?url=ajax-tim-tai-khoan-dang-mo", {key: $(this).val()}, function(data){
				$('#GetData').html(data);
			});
		}
		else{
			$.post("index.php?url=ajax-tim-tai-khoan-dang-mo", {key: $(this).val()}, function(data){
				$('#GetData').html(data);
			});
		}
	});
});

$(document).ready(function(){
	$('#TimTaiKhoanBiKhoa').keyup(function(){
		if($(this).val() == ''){
			$.post("index.php?url=ajax-tim-tai-khoan-bi-khoa", {key: $(this).val()}, function(data){
				$('#GetData').html(data);
			});
		}
		else{
			$.post("index.php?url=ajax-tim-tai-khoan-bi-khoa", {key: $(this).val()}, function(data){
				$('#GetData').html(data);
			});
		}
	});
});

$(document).ready(function(){
	$('#TimTaiKhoanBiXoa').keyup(function(){
		if($(this).val() == ''){
			$.post("index.php?url=ajax-tim-tai-khoan-bi-xoa", {key: $(this).val()}, function(data){
				$('#GetData').html(data);
			});
		}
		else{
			$.post("index.php?url=ajax-tim-tai-khoan-bi-xoa", {key: $(this).val()}, function(data){
				$('#GetData').html(data);
			});
		}
	});
});


$(document).ready(function(){
	$('#TimChuongCuaTruyen').keyup(function(){
		var title_uu = $('#title_u').text();
		var id_tr = $('#id_truyen').text();

		if($(this).val() == ''){
			$.post("index.php?url=ajax-tim-chuong-quan-tri", {key: $(this).val(), id_truyen: id_tr, title_u:title_uu}, function(data){
				$('#GetData').html(data);
			});
		}
		else{
			$.post("index.php?url=ajax-tim-chuong-quan-tri", {key: $(this).val(), id_truyen: id_tr, title_u:title_uu}, function(data){
				$('#GetData').html(data);
			});
		}
	});
});

$(document).ready(function(){
	$('#TimTruyenCuaToi').keyup(function(){
		if($(this).val() == ''){
			$.post("index.php?url=ajax-tim-truyen-cua-toi", {key: $(this).val()}, function(data){
				$('#GetData').html(data);
			});
		}
		else{
			$.post("index.php?url=ajax-tim-truyen-cua-toi", {key: $(this).val()}, function(data){
				$('#GetData').html(data);
			});
		}
	});
});

$(document).ready(function(){
	$('#TimTatCaTruyen').keyup(function(){
		if($(this).val() == ''){
			$.post("index.php?url=ajax-tim-truyen-admin", {key: $(this).val()}, function(data){
				$('#GetData').html(data);
			});
		}
		else{
			$.post("index.php?url=ajax-tim-truyen-admin", {key: $(this).val()}, function(data){
				$('#GetData').html(data);
			});
		}
	});
});

function ThongTin(){
	$.confirm({
	    title: '<i class="fas fa-rocket"></i> Thông Tin',
	    content: 'Đây là màu chỉ thị những thứ thông tin!',
	    type: 'purple',
	    autoClose: 'cancelAction|5000',
	    buttons: {
	        cancelAction:{
	        	text:'Đóng',
	        	btnClass: 'btn-blue'
	        }
	    }
	});
}

function CanhBao(){
	$.confirm({
	    title: '<i class="fas fa-rocket"></i> Cảnh Báo',
	    content: 'Đây là màu chỉ thị những thứ cần chú ý tới!',
	    type: 'purple',
	    autoClose: 'cancelAction|5000',
	    buttons: {
	        cancelAction:{
	        	text:'Đóng',
	        	btnClass: 'btn-blue'
	        }
	    }
	});
}

function QuanTrong(){
	$.confirm({
	    title: '<i class="fas fa-rocket"></i> Quan Trọng',
	    content: 'Đây là màu chỉ thị những thứ khá quan trọng!',
	    type: 'purple',
	    autoClose: 'cancelAction|5000',
	    buttons: {
	        cancelAction:{
	        	text:'Đóng',
	        	btnClass: 'btn-blue'
	        }
	    }
	});
}

$(document).ready(function(){
	$('#mark-book').click(function(){
		var icon_book = $('#icon-bookmark').attr('class');
		var idTr = $('.idtruyen').text();

		if(icon_book.indexOf("fal") >= 0){
			$.post("index.php?url=ajax-them-bookmark", {id: idTr}, function(data){
				if(data == 1){
					$('#icon-bookmark').removeClass('fal');
					$('#icon-bookmark').addClass('fas');
					Alert("Đã <b>lưu</b> truyện vào tủ sách!");
				}
				else{
					Alert('Bạn phải <b>ĐĂNG NHẬP</b> trước!');
				}
			});
		}
		else{
			$.post("index.php?url=ajax-xoa-bookmark", {id: idTr}, function(data){
				if(data == 1){
					$('#icon-bookmark').removeClass('fas');
					$('#icon-bookmark').addClass('fal');
					Alert("Đã <b>xóa</b> truyện khỏi tủ sách!");
				}
				else{
					Alert(data);
				}
			});
		}
	});
});



$(document).ready(function(){
    $('#BaoTri').click(function() {
	    $.post("index.php?url=ajax-update-bao-tri", function(data){
			if(data == 1){
				Alert('Đã lưu cài đặt!');
			}
			else{
				Alert(data);
			}
		});
    });

    $('#CayView').click(function() {
	    $.post("index.php?url=ajax-update-cay-views", function(data){
			if(data == 1){
				Alert('Đã lưu cài đặt!');
			}
			else{
				Alert(data);
			}
		});
    });
});

function DeFixTruyenLoi(idFeedback){
	$.post("./index.php?url=ajax-da-fix-loi", {id: idFeedback}, function(data){
		if(data == 1){
			$('.tr-truyen-loi-'+idFeedback).remove();
		}
		else{
			Alert(data);
		}
	}); 
}

$(function() {
	$('[data-toggle="tooltip"]').tooltip()
});

$('#frame-danhgia').hide();

$('#btn-comment-tab').click(function(){
	$('#btn-danhgia-tab').removeClass('active');
	$('#btn-comment-tab').addClass('active');

	$('#btn-danhgia-tab').removeClass('my-active');
	$('#btn-comment-tab').addClass('my-active');

	$('#frame-comment').show();
	$('#frame-danhgia').hide();
});

$('#btn-danhgia-tab').click(function(){
	$('#btn-danhgia-tab').addClass('active');
	$('#btn-comment-tab').removeClass('active');

	$('#btn-danhgia-tab').addClass('my-active');
	$('#btn-comment-tab').removeClass('my-active');

	$('#frame-comment').hide();
	$('#frame-danhgia').show();
});