@extends('layouts.admin')
@section('title', 'Hệ Thống EXP')
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
                <h1 class="page-title mr-sm-auto">HỆ THỐNG CẢNH GIỚI</h1>
                <div class="btn-toolbar">
                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#staticBackdrop">
                        <i class="fas fa-plus"></i>
                        <span class="ml-1">Thêm</span>
                    </button>
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
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                            <thead>
                                <tr>
                                    <th> CẢNH GIỚI</th>
                                    <th> KINH NGHIỆM</th>
                                    <th> THÀNH VIÊN</th>
                                    <th style="width:100px; min-width:100px;">CHỨC NĂNG</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($canh_gioi as $val)
                                <tr id="tr-{{ $val->id }}">
                                    <td>
                                        <span href="#" class="tile tile-img mr-1">
                                            <img class="img-fluid" src="{{ asset('public/images/level.png') }}" alt="">
                                        </span>
                                        <span href="#">{{ $val->name }}</span>
                                    </td>
                                    <td class="align-middle"><span style="color: red;">{{ number_format($val->point) }}</span> <span class="text-primary">exp</span></td>
                                    <td class="align-middle">{{ number_format($val->member) }}</td>
                                    <td class="align-middle text-right">
                                        <button class="btn btn-sm btn-icon btn-secondary mr-2" data-toggle="modal" data-target="#editCanhGioi" onclick="FillDataToForm('{{ $val->id }}', '{{ $val->name }}', '{{ $val->point }}')"><i class="fa fa-pencil-alt"></i><span class="sr-only">Edit</span></button>
                                        <button class="btn btn-sm btn-icon btn-secondary" onclick="Confirm_Delete('{{ $val->id }}', '{{ $val->name }}')"><i class="far fa-trash-alt"></i><span class="sr-only">Remove</span></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="post_canh_gioi" action="{{ route('admin.post_level') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">THÊM CẢNH GIỚI</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input id="name_canh_gioi" type="text" class="form-control" maxlength="{{ tbl_fields['canhgioi']['name'] }}" name="name" placeholder="Tên cảnh giới" required autofocus autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input id="point_canh_gioi" type="number" class="form-control" name="point" min="100" placeholder="Điểm kinh nghiệm" required autocomplete="off">
                        <small class="form-text text-muted">Nhấn phím [Enter] để lưu cảnh giới.</small>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editCanhGioi" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editCanhGioiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edit_post_canh_gioi" action="{{ route('admin.post_edit_level') }}" method="post">
                @csrf
                <input id="idCanhGioi" type="text" name="id" hidden>
                <div class="modal-header">
                    <h5 class="modal-title" id="editCanhGioiLabel">SỬA CẢNH GIỚI</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input id="edit_name_canh_gioi" type="text" class="form-control" maxlength="{{ tbl_fields['canhgioi']['name'] }}" name="name" placeholder="Tên cảnh giới" required autofocus autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input id="edit_point_canh_gioi" type="number" class="form-control" name="point" min="100" placeholder="Điểm kinh nghiệm" required autocomplete="off">
                        <small class="form-text text-muted">Nhấn phím [Enter] để lưu cảnh giới.</small>
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

    $('#point_canh_gioi').keyup(function(e) {
        if (e.keyCode == 13) {
            let name_canh_gioi = $('#name_canh_gioi').val();
            let point_canh_gioi = $('#point_canh_gioi').val();
            clear_validate();

            if (check_validate(name_canh_gioi, point_canh_gioi)) {
                $("#post_canh_gioi").submit();
            }
        }
    });

    $('#name_canh_gioi').keyup(function(e) {
        if (e.keyCode == 13) {
            let name_canh_gioi = $('#name_canh_gioi').val();
            let point_canh_gioi = $('#point_canh_gioi').val();
            clear_validate();

            if (check_validate(name_canh_gioi, point_canh_gioi)) {
                $("#post_canh_gioi").submit();
            }
        }
    });

    function clear_validate() {
        $('#name_canh_gioi').removeClass('is-invalid');
        $('#point_canh_gioi').removeClass('is-invalid');
    }

    function check_validate(name, point) {
        if (name.length <= 0) {
            $('#name_canh_gioi').addClass('is-invalid');
            return false;
        }
        if (point.length <= 0) {
            return false;
        }

        return true;
    }

    function FillDataToForm(id, name, point) {
        $('#idCanhGioi').val(id);
        $('#edit_name_canh_gioi').val(name);
        $('#edit_point_canh_gioi').val(point);
    }

    $('#edit_point_canh_gioi').keyup(function(e) {
        if (e.keyCode == 13) {
            let name_canh_gioi = $('#edit_name_canh_gioi').val();
            let point_canh_gioi = $('#edit_point_canh_gioi').val();
            clear_validate_edit();

            if (check_validate(name_canh_gioi, point_canh_gioi)) {
                $("#edit_post_canh_gioi").submit();
            }
        }
    });

    $('#edit_name_canh_gioi').keyup(function(e) {
        if (e.keyCode == 13) {
            let name_canh_gioi = $('#edit_name_canh_gioi').val();
            let point_canh_gioi = $('#edit_point_canh_gioi').val();
            clear_validate_edit();

            if (check_validate(name_canh_gioi, point_canh_gioi)) {
                $("#edit_post_canh_gioi").submit();
            }
        }
    });

    function clear_validate_edit() {
        $('#edit_name_canh_gioi').removeClass('is-invalid');
        $('#edit_point_canh_gioi').removeClass('is-invalid');
    }

    function Confirm_Delete(id, name) {
        $.confirm({
            title: '<i class="fas fa-rocket"></i> Thông Báo!',
            content: 'Bạn có muốn xóa cảnh giới <b>' + name + '</b> không?',
            type: 'purple',
            buttons: {
                deleteUser: {
                    text: 'Xóa',
                    btnClass: 'btn-red',
                    action: function() {
                        $.get("{{ route('admin.delete_level') }}", {
                            id: id
                        }, function(data) {
                            if (data == 'ok') {
                                $('#tr-' + id).remove();
                                toastr.success('Xóa cảnh giới ' + name + ' thành công!', '');
                            } else {
                                toastr.error('Xóa cảnh giới ' + name + ' thất bại!', '');
                            }
                        });
                    }
                },
                calcelAction: {
                    text: 'Đóng',
                    btnClass: 'btn-blue'
                }
            }
        });
    }
</script>
@endsection