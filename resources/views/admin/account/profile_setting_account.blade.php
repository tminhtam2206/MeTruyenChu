@extends('admin.account.profile_setting')
@section('content_setting_profile')
<div class="card card-fluid">
    <h6 class="card-header">Chi Tiết Tài Khoản</h6>
    <div class="card-body">
        <form method="post" action="{{ route('admin.account.setting.detail.update') }}">
            @csrf
            <div class="form-group">
                <label for="input03">Tên hiển thị</label>
                <input type="email" class="form-control" value="{{ Auth::user()->display_name }}" disabled>
            </div>
            <div class="form-group">
                <label for="input03">Tên đăng nhập</label>
                <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="name" maxlength="42" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="input03">Địa chỉ email</label>
                <input type="email" class="form-control" value="{{ Auth::user()->email }}" name="email" maxlength="50" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="input04">Mật khẩu mới</label>
                <input type="password" class="form-control" name="new_password" placeholder="Nhập mật khẩu mới" maxlength="255">
            </div>
            <hr>
            <div class="form-actions">
                <input type="password" class="form-control mr-3" name="confirm_pass" placeholder="Xác nhận mật khẩu" maxlength="255" required>
                <button type="submit" class="btn btn-primary text-nowrap ml-auto">Cập nhật tài khoản</button>
            </div>
        </form>
    </div>
</div>
@endsection