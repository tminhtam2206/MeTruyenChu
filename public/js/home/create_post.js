$(document).ready(function(){
	var ext_anh_truyen = "";
	var ext_bia_truyen = "";

	$('#my-btn-chon-anh-truyen').click(function(){
		document.getElementById('anh-truyen').click();
	});

	$('#anh-truyen').change(function(){
		var fullPath = document.getElementById('anh-truyen').value;

		if (fullPath) {
		    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
		    var filename = fullPath.substring(startIndex);

		    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
		        filename = filename.substring(1);
		    }

		    var re = /(?:\.([^.]+))?$/;
		    var ext = re.exec(filename+"")[1];
		    ext_anh_truyen = ext;

		    $('#AnhTruyen').val(filename);
		}
	});

	$('#my-btn-chon-bia-truyen').click(function(){
		document.getElementById('bia-truyen').click();
	});

	$('#bia-truyen').change(function(){
		var fullPath = document.getElementById('bia-truyen').value;

		if (fullPath) {
		    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
		    var filename = fullPath.substring(startIndex);

		    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
		        filename = filename.substring(1);
		    }

		    var re = /(?:\.([^.]+))?$/;
		    var ext = re.exec(filename+"")[1];
		    ext_bia_truyen = ext;

		    $('#BiaTruyen').val(filename);
		}
	});

	$('#KiemTraTaoTruyen').submit(function(){
		var loai_truyen = $('#loai-truyen').val();
		var trang_thai_truyen = $('#TrangThaiTruyen').val();

        if(loai_truyen == 'no_select'){
            Alert('Bạn chưa chọn [<b>LOẠI TRUYỆN</b>]!');
            event.preventDefault();
        }
        else if(trang_thai_truyen == 'no_select'){
        	Alert('Bạn chưa chọn [<b>TRẠNG THÁI</b>]!');
            event.preventDefault();
        }
        else if((ext_anh_truyen != "jpg" && ext_anh_truyen != "jpeg" && ext_anh_truyen != "png" && ext_anh_truyen != "webp") && ext_anh_truyen == "."){
        	Alert('Ảnh truyện không hỗ trợ định dạng <b>[.' + ext_anh_truyen + "]</b>");
        	event.preventDefault();
        }
        else if((ext_bia_truyen != "jpg" && ext_bia_truyen != "jpeg" && ext_bia_truyen != "png" && ext_bia_truyen != "webp") && ext_bia_truyen == "."){
        	Alert('Bìa truyện không hỗ trợ định dạng <b>[.' + ext_bia_truyen + "]</b>");
        	event.preventDefault();
        }    
        else{
        	return true;
        }
    });
});