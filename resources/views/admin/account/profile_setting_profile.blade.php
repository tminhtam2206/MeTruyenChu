@extends('admin.account.profile_setting')
@section('content_setting_profile')
<div class="card card-fluid">
    <h6 class="card-header">Hồ Sơ Công Khai</h6>
    <div class="card-body">
        <div class="media mb-3">
            <div class="user-avatar user-avatar-xl fileinput-button">
                <div class="fileinput-button-label">Đổi avatar</div>
                <img class="userPicture" src="{{ getAvatar(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                <input id="fileupload-avatar" type="file" name="avatar" accept=".png, .jpg, .jpeg">>
            </div>
            <div class="media-body pl-3">
                <h3 class="card-title">Ảnh đại diện</h3>
                <h6 class="card-subtitle text-muted">Nhấn vào ảnh đại diện hiện tịa để thay đổi (mỗi ngày được đổi 2 lần).</h6>
                <p class="card-text">
                    <small>JPG, JPEG hoặc PNG, &lt; 2 MB.</small>
                </p>
                <div id="progress-avatar" class="progress progress-xs fade">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <form method="post" action="{{ route('admin.account.upload_profile') }}">
            @csrf
            <input type="text" name="oldName" value="{{ Auth::user()->display_name }}" hidden>
            <div class="form-row">
                <label for="input01" class="col-md-3">Ảnh bìa</label>
                <div class="col-md-9 mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="Avatar_Cover" name="Avatar_Cover" accept=".png, .jpg, .jpeg"><label class="custom-file-label" for="Avatar_Cover">Chọn ảnh bìa</label>
                    </div><small class="text-muted">Tải lên ảnh bìa mới, JPG 1200x300, vui lòng nhấn F5 hoặc load lại trang.</small>
                </div>
            </div>
            <div class="form-row">
                <label for="input02" class="col-md-3">Tên hiển thị</label>
                <div class="col-md-9 mb-3">
                    <input type="text" class="form-control" value="{{ Auth::user()->display_name }}" name="display_name" maxlength="{{ tbl_fields['user']['display_name'] }}" autocomplete="off" placeholder="Tên hiển thị của bạn là?" required>
                </div>
            </div>
            <div class="form-row">
                <label for="input03" class="col-md-3">Trạng Thái</label>
                <div class="col-md-9 mb-3">
                    <textarea class="form-control" name="status" maxlength="{{ tbl_fields['user']['status'] }}" placeholder="Bạn đang nghĩ gì?">{{ Auth::user()->status }}</textarea>
                    <small class="text-muted">Trạng thái chỉ được tối đa 300 ký tự.</small>
                </div>
            </div>
            <hr>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary ml-auto">Cập nhật hồ sơ</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
    $('#fileupload-avatar').ijaboCropTool({
        preview: '.userPicture',
        setRatio: 1,
        allowedExtensions: ['jpg', 'jpeg','png'],
        buttonsText:['Cắt và Lưu','Thoát'],
        processUrl: '{{ route("user.cropAvatar") }}',
        withCSRF: ['_token', '{{ csrf_token() }}'],
        onSuccess:function(message, element, status){
            Alert(message);
        }
    });

    $('#Avatar_Cover').ijaboCropTool({
        preview: '.Avatar_Cover_Load',
        setRatio: 5,
        allowedExtensions: ['jpg', 'jpeg','png'],
        buttonsText:['Cắt và Lưu','Thoát'],
        processUrl: '{{ route("user.cropAvatar.cover") }}',
        withCSRF: ['_token', '{{ csrf_token() }}'],
        onSuccess:function(message, element, status){
            Alert(message);
        },
        onError:function(message, element, status){
            alert(message);
        }
    });
</script>
@endsection