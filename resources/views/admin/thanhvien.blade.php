@extends('layouts.admin')
@section('title', 'Thành Viên')
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
                <h1 class="page-title mr-sm-auto">THÀNH VIÊN</h1>
                <div class="btn-toolbar">
                    <!-- <button type="button" class="btn btn-light" data-toggle="modal" data-target="#staticBackdrop">
                        <i class="fas fa-plus"></i>
                        <span class="ml-1">Thêm</span>
                    </button> -->
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
            <div class="d-xl-none">
                <button class="btn btn-danger btn-floated" type="button" data-toggle="sidebar"><i class="fa fa-th-list"></i></button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th> TÊN ĐĂNG NHẬP</th>
                                    <th> TÊN HIỂN THỊ</th>
                                    <th> ĐỊA CHỈ EMAIL</th>
                                    <th> CẢNH GIỚI</th>
                                    <th> CẤP QUYỀN</th>
                                    <th> KHÓA</th>
                                    <th class="text-center"> LINH THẠCH</th>
                                    <th class="text-center"> ĐỊA CHỈ IP</th>
                                    <th class="text-right">NGÀY TẠO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- loop -->
                                @foreach($thanhvien as $val)
                                <tr>
                                    <td class="font-weight-bold align-middle" width="15">{{ $loop->index+1 }}</td>
                                    <td>
                                        <span href="#" class="tile tile-img mr-1">
                                            <img class="img-fluid" src="{{ getAvatar($val->avatar) }}" alt="">
                                        </span>
                                        <span href="#" style="color: red;">{{ $val->name }}</span>
                                    </td>
                                    <td class="align-middle">{{ $val->display_name }}</td>
                                    <td class="align-middle">{{ $val->email }}</td>
                                    <td class="align-middle"><span class="badge badge-warning">{{ $val->exp_level }}</span></td>
                                    <td class="align-middle">
                                        <span class="badge badge-primary" style="cursor: pointer;" onclick="fillForm('{{ $val->id }}', '{{ $val->role }}')">@if($val->role == 'admin') Thánh Chủ @elseif($val->role == 'member') Thành Viên @else Chấp Sự @endif <i class="fas fa-user-edit"></i></span>
                                    </td>
                                    <td class="align-middle"><span class="badge badge-primary" style="cursor: pointer;" onclick="fillForm_Lock('{{ $val->id }}', '{{ $val->lock }}')"><i class="fas fa-user-edit"></i> {{ $val->lock == 'N' ? 'Không' : 'Bị Khóa' }}</span></td>
                                    <td class="text-center align-middle"><span class="badge badge-danger">{{ number_format($val->coin) }}</span></td>
                                    <td class="align-middle">{{ getIPForUser($val->id) }}</td>
                                    <td class="text-right align-middle">{{ date('d-m-Y', strtotime($val->created_at)) }}</td>
                                </tr>
                                @endforeach
                                <!-- end loop -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="formEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_edit_account" action="{{ route('admin.users.update_role') }}" method="post">
                @csrf
                <input id="user-id" type="text" value="" name="id" hidden>
                <div class="modal-header">
                    <h5 class="modal-title" id="formEditLabel">CHỈNH SỬA TÀI KHOẢN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select id="role-user" class="form-control" name="role" required>
                            <option value="member">Thành Viên</option>
                            <option value="mod">Chấp Sự</option>
                            <option value="admin">Thánh Chủ</option>
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary">Cập Nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="formEditLock" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formEditLockLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_edit_account" action="{{ route('admin.users.lock') }}" method="post">
                @csrf
                <input id="user-id-2" type="text" value="" name="id" hidden>
                <div class="modal-header">
                    <h5 class="modal-title" id="formEditLockLabel">KHÓA TÀI KHOẢN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select id="lock-user" class="form-control" name="lock" required>
                            <option value="N">Không</option>
                            <option value="Y">Khóa</option>
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary">Cập Nhật</button>
                    </div>
                </div>
            </form>
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
    var current_userId = '{{ Auth::user()->id }}';

    function fillForm(id, role) {
        if (id != current_userId) {
            $('#user-id').val(id);
            $("#role-user option[value='" + role + "']").attr("selected", "selected");
            $('#formEdit').modal('show');
        } else {
            toastr.error('Không thể chỉnh sửa tài khoản hiện hành!', '');
        }
    }

    function fillForm_Lock(id, lock) {
        if (id != current_userId) {
            $('#user-id-2').val(id);
            $("#lock-user option[value='" + lock + "']").attr("selected", "selected");
            $('#formEditLock').modal('show');
        } else {
            toastr.error('Không thể chỉnh sửa tài khoản hiện hành!', '');
        }
    }
</script>
@endsection