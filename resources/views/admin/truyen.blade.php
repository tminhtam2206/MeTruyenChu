@extends('layouts.admin')
@section('title', 'Danh Sách Truyện')
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
                <h1 class="page-title mr-sm-auto">DANH SÁCH TRUYỆN</h1>
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
                                    <th> TÊN TRUYỆN</th>
                                    <th> NGƯỜI ĐĂNG</th>
                                    <th> TÁC GIẢ</th>
                                    <th> SỐ CHƯƠNG</th>
                                    <th> KHÓA</th>
                                    <th> XÓA</th>
                                    <th class="text-right"> CHỨC NĂNG</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- loop -->
                                @foreach($truyen as $val)
                                <tr>
                                    <td class="text-center font-weight-bold align-middle" width="15">{{ $loop->index+1 }}</td>
                                    <td>
                                        <a href="{{ route('trangchu.truyen', ['name_slug'=>$val->name_slug]) }}" target="blank">
                                            <span href="#" class="tile tile-img mr-1">
                                                <img class="img-fluid" src="{{ getStoryCover($val->cover) }}">
                                            </span>
                                            <span href="#" style="color: red;">{{ $val->name }}</span>
                                        </a>
                                    </td>
                                    <td class="align-middle">{{ $val->User->display_name }}</td>
                                    <td class="align-middle">{{ $val->author }}</td>
                                    <td class="align-middle">{{ number_format($val->num_chaps) }}</td>
                                    <td class="align-middle"><span class="badge badge-warning">{{ $val->lock == 'N' ? 'Không' : 'Đã Khóa' }}</span></td>
                                    <td class="align-middle"><span class="badge badge-info">{{ $val->delete == 'Y' ? 'Đã Xóa' : 'Không' }}</span></td>
                                    <td class="align-middle text-right">
                                        <button class="btn btn-sm btn-icon btn-secondary mr-2" onclick="fillForm('{{ $val->id }}', '{{ $val->lock }}')"><i class="fa fa-pencil-alt"></i><span class="sr-only">Edit</span></button>
                                        <button class="btn btn-sm btn-icon btn-secondary" onclick="Confirm_Delete('{{ $val->id }}', '{{ $val->name }}', '{{ $val->delete }}')"><i class="far fa-trash-alt"></i><span class="sr-only">Remove</span></button>
                                    </td>
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
            <form id="form_edit_account" action="{{ route('admin.users.update_lock') }}" method="post">
                @csrf
                <input id="user-id" type="text" value="" name="id" hidden>
                <div class="modal-header">
                    <h5 class="modal-title" id="formEditLabel">CHỈNH SỬA TRUYỆN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select id="role-user" class="form-control" name="lock" required>
                            <option value="N">Bình Thường</option>
                            <option value="Y">Khóa Truyện</option>
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

    var _token = '{{ csrf_token() }}';

    function fillForm(id, lock) {
        $('#user-id').val(id);
        $("#role-user option[value='" + lock + "']").attr("selected", "selected");
        $('#formEdit').modal('show');
    }

    function Confirm_Delete(id, name, _delete) {
        if (_delete == 'N') {
            $.confirm({
                title: '<i class="fas fa-rocket"></i> Thông Báo!',
                content: 'Bạn có muốn <b>xóa</b> truyện <b>' + name + '</b> không?',
                type: 'purple',
                buttons: {
                    deleteUser: {
                        text: 'Xóa',
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: "{{ route('admin.stories.delete') }}",
                                data: {
                                    id: id,
                                    _token: _token
                                },
                                type: 'post',
                                success: function() {
                                    toastr.success('Xóa truyện thành công!', '');
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
        } else {
            $.confirm({
                title: '<i class="fas fa-rocket"></i> Thông Báo!',
                content: 'Bạn có muốn <b>khôi phục</b> truyện <b>' + name + '</b> không?',
                type: 'purple',
                buttons: {
                    deleteUser: {
                        text: 'Khôi phục',
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: "{{ route('admin.stories.delete') }}",
                                data: {
                                    id: id,
                                    _token: _token
                                },
                                type: 'post',
                                success: function() {
                                    toastr.success('Khôi phục truyện thành công!', '');
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
    }
</script>
@endsection