@extends('layouts.admin')
@section('title', 'Thể Loại Truyện')
@section('content')
<div class="page">
    <div class="page-inner">
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Bảng Điều Khiển</a>
                    </li>
                </ol>
            </nav>
            <div class="d-md-flex align-items-md-start">
                <h1 class="page-title mr-sm-auto">THỂ LOẠI TRUYỆN</h1>
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
                    <table id="dataTable" class="table">
                        <thead>
                            <tr>
                                <th width="15">#</th>
                                <th> TÊN THỂ LOẠI</th>
                                <th> TÊN KHÔNG DẤU</th>
                                <th style="width:100px; min-width:100px;">CHỨC NĂNG</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($theloai_truyen as $val)
                            <tr id="tr-{{ $val->id }}">
                                <td class="align-middle font-weight-bold"><span href="#">{{ $loop->index+1 }}</span></td>
                                <td class="align-middle">
                                    <span class="tile tile-img mr-1">
                                        <img class="img-fluid" src="{{ asset('public/images/the-loai.png') }}">
                                    </span>
                                    {{ $val->name }}
                                </td>
                                <td class="align-middle">{{ $val->name_slug }}</td>
                                <td class="align-middle text-right">
                                    <button class="btn btn-sm btn-icon btn-secondary mr-2" data-toggle="modal" data-target="#editTheLoai" onclick="FillDataToForm('{{ $val->id }}', '{{ $val->name }}')">
                                        <i class="fa fa-pencil-alt"></i>
                                        <span class="sr-only">Edit</span>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-secondary" onclick="Confirm_Delete('{{ $val->id }}', '{{ $val->name }}')">
                                        <i class="far fa-trash-alt"></i>
                                        <span class="sr-only">Remove</span>
                                    </button>
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

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="post_the_loai" action="{{ route('admin.type_story.add') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">THÊM THỂ LOẠI</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input id="name_the_loai" type="text" class="form-control" maxlength="{{ tbl_fields['theloaitruyen']['name'] }}" name="name" placeholder="Tên thể loại" required autofocus autocomplete="off">
                        <small class="form-text text-muted">Nhấn phím [Enter] để lưu thể loại.</small>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editTheLoai" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editTheLoaiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edit_post_TheLoai" action="{{ route('admin.type_story.edit') }}" method="post">
                @csrf
                <input id="idTheLoai" type="text" name="id" hidden>
                <input id="oldName" type="text" name="oldName" hidden>
                <div class="modal-header">
                    <h5 class="modal-title" id="editTheLoaiLabel">SỦA THỂ LOẠI</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input id="edit_the_loai" type="text" class="form-control" maxlength="{{ tbl_fields['theloaitruyen']['name'] }}" name="name" placeholder="Tên thể loại" required autofocus autocomplete="off">
                        <small class="form-text text-muted">Nhấn phím [Enter] để lưu thể loại.</small>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    function FillDataToForm(id, name) {
        $('#idTheLoai').val(id);
        $('#edit_the_loai').val(name);
        $('#oldName').val(name);
    }

    $('#edit_the_loai').keyup(function(e) {
        if (e.keyCode == 13) {
            $("#edit_post_TheLoai").submit();
        }
    });

    function Confirm_Delete(id, name) {
        $.confirm({
            title: '<i class="fas fa-rocket"></i> Thông Báo!',
            content: 'Bạn có muốn xóa thể loại <b>' + name + '</b> không?',
            type: 'purple',
            buttons: {
                deleteUser: {
                    text: 'Xóa',
                    btnClass: 'btn-red',
                    action: function() {
                        $.get("{{ route('admin.type_story.delete') }}", {
                            id: id
                        }, function() {
                            $('#tr-' + id).remove();
                            toastr.success('Xóa thể loại ' + name + ' thành công!', '');
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