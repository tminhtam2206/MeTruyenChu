@extends('member.account.profile_setting')
@section('content_setting_profile')
<div class="card card-fluid">
    <h6 class="card-header" style="text-transform: uppercase;">Chi Tiết Tài Khoản</h6>
    <div class="card-body">
        <form method="post" action="{{ route('member.account.upload_detail') }}">
            @csrf
            <div class="form-group">
                <label>Tên hiển thị</label>
                <input type="text" class="form-control" value="{{ Auth::user()->display_name }}" disabled>
            </div>
            <div class="form-group">
                <label for="name">Tên đăng nhập</label>
                <input id="name" type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" maxlength="{{ tbl_fields['user']['name'] }}" required>
            </div>
            <div class="form-group">
                <label for="email_address">Địa chỉ email</label>
                <input id="email_address" type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" maxlength="{{ tbl_fields['user']['email'] }}" required>
            </div>
            <div class="form-group">
                <label for="new_pass">Mật khẩu mới</label>
                <input id="new_pass" type="password" name="new_password" class="form-control" placeholder="Nhập mật khẩu mới" maxlength="{{ tbl_fields['user']['password'] }}">
            </div>
            <hr>
            <div class="form-actions">
                <input type="password" name="confirm_pass" class="form-control mr-3" placeholder="Xác nhận mật khẩu" maxlength="{{ tbl_fields['user']['password'] }}" required>
                <button type="submit" class="btn btn-primary text-nowrap ml-auto">Cập nhật tài khoản</button>
            </div>
        </form>
    </div>
</div>
@endsection