@extends('admin.account.profile_setting')
@section('content_setting_profile')
<div class="card card-fluid">
    <h6 class="card-header">Thông Báo</h6>
    <div class="list-group list-group-flush">
        <form action="#" method="post" onsubmit="return false">
            <div class="list-group-item d-flex justify-content-between align-items-center">
                Người khác được theo dõi bạn
                <label class="switcher-control switcher-control-success">
                    <input type="checkbox" name="notif01" class="switcher-input" checked>
                    <span class="switcher-indicator"></span>
                </label>
            </div>
            <div class="list-group-item d-flex justify-content-between align-items-center">
                Người khác có thể tag đến bạn
                <label class="switcher-control switcher-control-success">
                    <input type="checkbox" name="notif02" class="switcher-input">
                    <span class="switcher-indicator"></span>
                </label>
            </div>
            <div class="list-group-item d-flex justify-content-between align-items-center">
                Người khác có thể gửi tin nhắn cho bạn
                <label class="switcher-control switcher-control-success">
                    <input type="checkbox" name="notif03" class="switcher-input">
                    <span class="switcher-indicator"></span>
                </label>
            </div>
            <div class="list-group-header text-uppercase" style="border-top: none;">thông báo truyện</div>
            <div class="list-group-item d-flex justify-content-between align-items-center">
                Gửi thông báo khi có truyện mới
                <label class="switcher-control switcher-control-success">
                    <input type="checkbox" name="notif08" class="switcher-input">
                    <span class="switcher-indicator"></span>
                </label>
            </div>
            <div class="list-group-item d-flex justify-content-between align-items-center">
                Gửi thông báo khi truyện cập nhật chương
                <label class="switcher-control switcher-control-success">
                    <input type="checkbox" name="notif09" class="switcher-input">
                    <span class="switcher-indicator"></span>
                </label>
            </div>
            <div class="list-group-header text-uppercase" style="border-top: none;">Tin tức & Xu hướng</div>
            <div class="list-group-item d-flex justify-content-between align-items-center">
                Các thành viên hàng đầu tuần này
                <label class="switcher-control switcher-control-success">
                    <input type="checkbox" name="notif11" class="switcher-input" checked>
                    <span class="switcher-indicator"></span>
                </label>
            </div>
            <div class="list-group-item d-flex justify-content-between align-items-center" style="border-top: none;">
                Đội hàng đầu tuần này
                <label class="switcher-control switcher-control-success">
                    <input type="checkbox" name="notif12" class="switcher-input" checked>
                    <span class="switcher-indicator"></span>
                </label>
            </div>
            <div class="form-actions mb-2 mr-3">
                <button type="submit" class="btn btn-primary ml-auto" disabled>Lưu thiết lập</button>
            </div>
        </form>
    </div>
</div>
@endsection