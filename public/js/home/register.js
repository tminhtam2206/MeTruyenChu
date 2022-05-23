var check = false;

function check_form(){
	var Phone = $('#Phone').val();
	var pass = $('#pass').val();
	var re_pass = $('#re_pass').val();
	var user_name = $('#check_user').val();
	
	if(!$.isNumeric(Phone)){
		Alert('Số điện thoại không được chứa [<b>chữ cái</b>] bên trong!');
		return false;
	}
	else{
		if(Phone.length < 10){
			Alert('Số điện thoại không được dưới [<b>10 ký tự</b>]!');
			return false;
		}
	}

	if (check_spaces(pass)) {
		Alert('Mật khẩu không được có [<b>khoảng trắng</b>]!');
	    return false;
	}
	else{
		if(pass.length < 6){
			Alert('Mật khẩu phải có ít nhất [<b>6 ký tự</b>]!');
			return false;
		}
		else if(pass != re_pass){
			Alert('Xác nhận mật khẩu không đúng!');
			return false;
		}
	}

	if(!check){
		Alert('Tên đăng nhập [<b>'+$('#check_user').val()+'</b>] đã được sử dụng!');
		return false;
	}

	return true;
}

function check_spaces(str){
	for (var i = 0; i < str.length; i++) {
		if(str[i] == ' ')
			return true;
	}

	return false;
}

$(document).ready(function(){
	$('#check_user').keyup(function(){
		if($(this).val() == ''){
			$('#check_user').removeClass('is-valid');
			$('#check_user').addClass('is-invalid');
			$('#check_user').css("color","red");
			check = false;
		}
		else{
			$.post("index.php?url=ajax-kiem-tra-tai-khoan", {TenDangNhap: $(this).val()}, function(data){
				if(data == "1"){
					$('#check_user').removeClass('is-valid');
					$('#check_user').addClass('is-invalid');
					$('#check_user').css("color","red");
					check = false;
				}
				else{
					$('#check_user').removeClass('is-invalid');
					$('#check_user').addClass('is-valid');
					$('#check_user').css("color","#495057");
					check = true;
				}
			});
		}
	});
});

function check_KyTuLa(){
	var us = $('#check_user').val();
	var temp = '';

	for (var i = 0; i < us.length; i++) {
		if(us[i] != '-' && us[i] != ' ' && us[i] != '/' && us[i] != '+' && us[i] != '=' && us[i] != '#' && us[i] != '@' && us[i] != '!' && us[i] != '&' && us[i] != '$'
			&& us[i] != '%' && us[i] != '^' && us[i] != '(' && us[i] != ')' && us[i] != '*'){
			temp += us[i];
		}
	}
	$('#check_user').val(temp);
}