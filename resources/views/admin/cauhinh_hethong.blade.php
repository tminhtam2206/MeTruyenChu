@extends('layouts.admin')
@section('title', 'Cấu Hình Hệ Thống')
@section('content')
<div class="page">
    <div class="page-inner">
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Bảng Điều Khiên
                        </a>
                    </li>
                </ol>
            </nav>

            <div class="d-md-flex align-items-md-start">
                <h1 class="page-title mr-sm-auto">CẤU HÌNH HỆ THỐNG</h1>
                <div class="btn-toolbar">
                    <button type="button" class="btn btn-light">
                        <i class="oi oi-data-transfer-download"></i>
                        <span class="ml-1">Xuất</span>
                    </button>
                    <button type="button" class="btn btn-light">
                        <i class="oi oi-data-transfer-upload"></i>
                        <span class="ml-1">Nhập</span>
                    </button>
                </div>
            </div>
        </header>
        <div class="page-section">
            <div class="card card-fluid">
                <div class="card-body">
                    <div class="list-group list-group-flush list-group-bordered">
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Bảo trì hệ thống</span>
                            <label class="switcher-control switcher-control-lg">
                                <input id="maintenance" type="checkbox" class="switcher-input" {{ $config->baotri == 'Y' ? 'checked' : '' }}>
                                <span class="switcher-indicator"></span>
                                <span class="switcher-label-on">BẬT</span>
                                <span class="switcher-label-off">TẮT</span>
                            </label>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Cho phép thành viên craw chương</span>
                            <label class="switcher-control switcher-control-lg">
                                <input id="craw" type="checkbox" class="switcher-input" {{ $config->craw == 'Y' ? 'checked' : '' }}>
                                <span class="switcher-indicator"></span>
                                <span class="switcher-label-on">BẬT</span>
                                <span class="switcher-label-off">TẮT</span>
                            </label>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Đăng Nhập Với Google</span>
                            <label class="switcher-control switcher-control-lg">
                                <input id="google-login" type="checkbox" class="switcher-input" {{ $config->google_login == 'Y' ? 'checked' : '' }}>
                                <span class="switcher-indicator"></span>
                                <span class="switcher-label-on">BẬT</span>
                                <span class="switcher-label-off">TẮT</span>
                            </label>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Đăng Nhập Với Facebook</span>
                            <label class="switcher-control switcher-control-lg">
                                <input id="facebook-login" type="checkbox" class="switcher-input" {{ $config->facebook_login == 'Y' ? 'checked' : '' }}>
                                <span class="switcher-indicator"></span>
                                <span class="switcher-label-on">BẬT</span>
                                <span class="switcher-label-off">TẮT</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    var _mytoken = '{{ csrf_token() }}';

    $('#maintenance').on('input', function() {
        $.ajax({
            url: "{{ route('admin.config_system.maintenance') }}",
            data: {
                _token: _mytoken
            },
            type: 'post',
            success: function() {
                var checked = $('#maintenance').is(":checked");
                if(checked == true){
                    toastr.success('BẬT bảo trì hệ thống!', '');
                }else{
                    toastr.success('TẮT bảo trì hệ thống!', '');
                }
            }
        });
    });

    $('#craw').on('input', function() {
        $.ajax({
            url: "{{ route('admin.config_system.craw') }}",
            data: {
                _token: _mytoken
            },
            type: 'post',
            success: function() {
                var checked = $('#craw').is(":checked");
                if(checked == true){
                    toastr.success('BẬT craw dữ liệu!', '');
                }else{
                    toastr.success('TẮT craw dữ liệu!', '');
                }
            }
        });
    });

    $('#google-login').on('input', function() {
        $.ajax({
            url: "{{ route('admin.config_system.google_login') }}",
            data: {
                _token: _mytoken
            },
            type: 'post',
            success: function() {
                var checked = $('#google-login').is(":checked");
                if(checked == true){
                    toastr.success('BẬT đăng nhập với google!', '');
                }else{
                    toastr.success('TẮT đăng nhập với google!', '');
                }
            }
        });
    });

    $('#facebook-login').on('input', function() {
        $.ajax({
            url: "{{ route('admin.config_system.facbook_login') }}",
            data: {
                _token: _mytoken
            },
            type: 'post',
            success: function() {
                var checked = $('#facebook-login').is(":checked");
                if(checked == true){
                    toastr.success('BẬT đăng nhập với facebook!', '');
                }else{
                    toastr.success('TẮT đăng nhập với facebook!', '');
                } 
            }
        });
    });
</script>
@endsection