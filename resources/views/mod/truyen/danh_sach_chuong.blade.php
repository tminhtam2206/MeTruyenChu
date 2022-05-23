@extends('mod.truyen.index')
@section('title', 'Danh Sách Chương')
@section('truyen_content')
<div class="page-inner pt-0">
    <div class="page-section">
        @if($truyen->lock == 'N')
        <div class="section-block mt-0 pt-0">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="section-title mb-0">
                    <a href="{{ route('mod.truyen_da_dang.truyen_them_chuong', ['name_slug'=>$truyen->name_slug]) }}" class="btn btn-primary">
                        <i class="far fa-plus"></i> Thêm chương
                    </a>
                </h1>
                <div class="dropdown">
                    @if($truyen->num_chaps > 0)
                    <button onclick="danhSoChuong('{{ $truyen->id }}')" class="btn btn-primary">
                        <i class="fas fa-sort-numeric-down"></i>
                    </button>
                    <a href="{{ route('mod.refreshNumLetters', ['truyen_id'=>$truyen->id]) }}" class="btn btn-primary" onclick="return confirm('Bạn có muốn làm mới số chữ của truyện?')"><i class="fas fa-text-height"></i></a>
                    @endif
                    <button id="show_chapter" class="btn btn-primary"><i class="fas fa-list-ol"></i></button>
                    <button id="show_chapter_del" class="btn btn-primary"><i class="fas fa-trash-restore"></i></button>
                </div>
            </div>
        </div>
        @endif
        @if($truyen->lock == 'Y')
        <div class="alert alert-warning mt-3" role="alert">
            <i class="fas fa-exclamation-triangle"></i> Truyện <b>[{{ $truyen->name }}]</b> đã bị khóa, vui lòng liên hệ chấp sự!
        </div>
        @endif
        <!-- start loop -->
        <div id="chuong_show_Y">
            <!-- start loop -->
            <div class="card card-fluid mt-3">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="25">#</th>
                                <th> SỐ CHƯƠNG</th>
                                <th> TÊN CHƯƠNG</th>
                                <th> CÔNG KHAI</th>
                                <th> KHÓA CHƯƠNG</th>
                                <th> LƯỢT ĐỌC</th>
                                <th> SỐ CHỮ</th>
                                <th> THỜI GIAN</th>
                                <th class="text-right" width="125"> HÀNH ĐỘNG&nbsp;&nbsp;&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chuong as $val)
                            <tr id="chuong-{{ $val->id }}">
                                <td class="align-middle font-weight-bold" width="25">{{ $loop->index+1 }}</td>
                                <td class="align-middle">Chương {{ $val->numchap }}</td>
                                <td class="align-middle"><a href="{{ route('trangchu.chuong', ['truyen'=>$truyen->name_slug, 'chuong'=>$val->name_slug]) }}" target="_blank">{{ $val->name }}</a></td>
                                <td class="align-middle"><i class="fas fa-eye"></i> Có</td>
                                <td class="align-middle">
                                    @if($val->lock == 'Y')
                                    <span id="check-{{ $val->id }}" style="color: red;"><i id="icon-lock-{{ $val->id }}" class="fas fa-lock-alt"></i> Khóa</span>
                                    @else
                                    <span id="check-{{ $val->id }}"><i id="icon-lock-{{ $val->id }}" class="fas fa-unlock-alt"></i> Không</span>
                                    @endif
                                </td>
                                <td class="align-middle">{{ number_format($val->view) }}</td>
                                <td class="align-middle">{{ number_format($val->number_letters) }}</td>
                                <td class="align-middle">{{ $val->created_at->diffForHumans() }}</td>
                                <td class="align-middle text-right">
                                    <a href="{{ route('mod.truyen_da_dang.sua_chuong', ['name_slug'=>$val->name_slug]) }}" class="btn btn-sm btn-icon btn-secondary">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-icon btn-secondary" onclick="RequestLockChap('{{ $val->id }}', '{{ $val->name }}')">
                                        <i class="fas fa-lock-alt"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon btn-secondary" onclick="Confirm_Delete('{{ $val->id }}', '{{ $val->name }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- start loop -->
            <div class="my-pagination">
                {{ $chuong->links() }}
            </div>
        </div>

        <div id="chuong_show_N" style="display: none;">
            <!-- start loop -->
            <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i> Chương sẽ tự động xóa vĩnh viễn sau 30 ngày, kể từ ngày bỏ chương vào thùng rác.
            </div>
            <div class="card card-fluid mt-3">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="25">#</th>
                                <th> SỐ CHƯƠNG</th>
                                <th> TÊN CHƯƠNG</th>
                                <th> CÔNG KHAI</th>
                                <th> KHÓA CHƯƠNG</th>
                                <th> LƯỢT ĐỌC</th>
                                <th> THỜI GIAN</th>
                                <th class="text-right" width="125"> HÀNH ĐỘNG&nbsp;&nbsp;&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chuong_del as $val)
                            <tr id="chuong-del-{{ $val->id }}">
                                <td class="align-middle font-weight-bold" width="25">{{ $loop->index+1 }}</td>
                                <td class="align-middle"><a href="#">Chương {{ $val->numchap }}</a></td>
                                <td class="align-middle"><a href="#">{{ $val->name }}</a></td>
                                <td class="align-middle"><span style="color: red;"><i class="fas fa-eye-slash"></i> Không</span></td>
                                <td class="align-middle">
                                    @if($val->lock == 'Y')
                                    <span id="check-{{ $val->id }}" style="color: red;"><i id="icon-lock-{{ $val->id }}" class="fas fa-lock-alt"></i> Khóa</span>
                                    @else
                                    <span id="check-{{ $val->id }}"><i id="icon-lock-{{ $val->id }}" class="fas fa-unlock-alt"></i> Không</span>
                                    @endif
                                </td>
                                <td class="align-middle">{{ number_format($val->views) }}</td>
                                <td class="align-middle">{{ $val->created_at->diffForHumans() }}</td>
                                <td class="align-middle text-center">
                                    <button class="btn btn-sm btn-icon btn-secondary" onclick="Confirm_Restore('{{ $val->id }}', '{{ $val->name }}')">
                                        <i class="fas fa-trash-restore"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- start loop -->
        </div>
        <!-- end loop -->
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

    function Confirm_Delete(id, name) {
        $.confirm({
            title: '<i class="fas fa-rocket"></i> Thông Báo!',
            content: 'Bạn có muốn <b>xóa</b> chương [<b>' + name + '</b>] không?',
            type: 'purple',
            buttons: {
                deleteUser: {
                    text: 'Xóa',
                    btnClass: 'btn-red',
                    action: function() {
                        $.get("{{ route('mod.ajax_xoa_chuong') }}", {
                            id: id
                        }, function() {
                            $('#chuong-' + id).remove();
                            toastr.success('Xóa chương thành công!', '');
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

    function Confirm_Restore(id, name) {
        $.confirm({
            title: '<i class="fas fa-rocket"></i> Thông Báo!',
            content: 'Bạn có muốn khôi phục chương [<b>' + name + '</b>] không?',
            type: 'purple',
            buttons: {
                deleteUser: {
                    text: 'Khôi Phục',
                    btnClass: 'btn-red',
                    action: function() {
                        $.get("{{ route('mod.ajax_khoi_phuc_chuong') }}", {
                            id: id
                        }, function() {
                            $('#chuong-del-' + id).remove();
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

    function Confirm_DanhLaiSo() {
        $.confirm({
            title: '<i class="fas fa-rocket"></i> Thông Báo!',
            content: 'Bạn có muốn đánh lại số toàn bộ chương không?',
            type: 'purple',
            buttons: {
                deleteUser: {
                    text: 'Có',
                    btnClass: 'btn-red',
                    action: function() {
                        return true;
                    }
                },
                calcelAction: {
                    text: 'Đóng',
                    btnClass: 'btn-blue'
                }
            }
        });

        return false;
    }

    $('#show_chapter').click(function() {
        $('#chuong_show_N').css('display', 'none');
        $('#chuong_show_Y').css('display', 'block');
        toastr.success('Tải danh sách thành công!', '');
    });

    $('#show_chapter_del').click(function() {
        $('#chuong_show_Y').css('display', 'none');
        $('#chuong_show_N').css('display', 'block');
        toastr.success('Tải danh sách thành công!', '');
    });

    function danhSoChuong(id){
        $.confirm({
            title: '<i class="fas fa-rocket"></i> Thông Báo!',
            content: 'Bạn có muốn <b>đánh lại số chương</b> không?',
            type: 'purple',
            buttons: {
                deleteUser: {
                    text: '<i class="fas fa-sort-numeric-down"></i> Đánh lại',
                    btnClass: 'btn-red',
                    action: function() {
                        $.get("{{ route('mod.ajax_danh_lai_so_chuong') }}", {
                            truyen_id: id
                        }, function() {
                            toastr.success('Đánh lại số chương thành công!', '');
                            setInterval(function(){
                                location.reload();
                            }, 3000);
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

    function Confirm_Lock(id, name) {
        $.confirm({
            title: '<i class="fas fa-rocket"></i> Thông Báo!',
            content: 'Bạn có muốn <b>khóa</b> chương [<b>' + name + '</b>] không?',
            type: 'purple',
            buttons: {
                deleteUser: {
                    text: '<i class="fas fa-lock-alt"></i> Khóa',
                    btnClass: 'btn-red',
                    action: function() {
                        $.get("{{ route('mod.ajax_khoa_chuong') }}", {
                            id: id
                        }, function() {
                            $('#check-' + id).html('<i id="icon-lock-' + id + '" class="fas fa-lock-alt"></i> Khóa');
                            $('#check-' + id).css('color', 'red');
                            toastr.success('Khóa chương thành công!', '');
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

    function Confirm_UnLock(id, name) {
        $.confirm({
            title: '<i class="fas fa-rocket"></i> Thông Báo!',
            content: 'Bạn có muốn <b>mở</b> khóa chương [<b>' + name + '</b>] không?',
            type: 'purple',
            buttons: {
                deleteUser: {
                    text: '<i class="fas fa-unlock-alt"></i> Mở',
                    btnClass: 'btn-red',
                    action: function() {
                        $.get("{{ route('mod.ajax_mo_khoa_chuong') }}", {
                            id: id
                        }, function() {
                            $('#check-' + id).html('<i id="icon-unlock-' + id + '" class="fas fa-lock-alt"></i> Không');
                            $('#check-' + id).css('color', 'black');
                            toastr.success('Mở khóa chương thành công!', '');
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

    function RequestLockChap(id, name) {
        let name_class = $('#icon-lock-' + id).attr('class').trim();

        if (name_class == 'fas fa-unlock-alt') {
            Confirm_Lock(id, name);
        } else {
            Confirm_UnLock(id, name);
        }
    }
</script>
@endsection