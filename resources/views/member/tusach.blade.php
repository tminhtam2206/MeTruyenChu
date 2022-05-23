@extends('layouts.member')
@section('title', 'Tủ Truyện')
@section('content')
<div class="page">
    <div class="page-inner">
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href="{{ route('member.dashboard') }}">
                            <i class="breadcrumb-icon fa fa-angle-left mr-2"></i>BẢNG ĐIỀU KHIỂN
                        </a>
                    </li>
                </ol>
            </nav>

            <div class="d-md-flex align-items-md-start">
                <h1 class="page-title mr-sm-auto">TỦ TRUYỆN CỦA TÔI</h1>
            </div>
        </header>
        <div class="page-section">
            <div class="card card-fluid mt-3">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="25">#</th>
                                <th> TÊN TRUYỆN</th>
                                <th> TÁC GIẢ</th>
                                <th> TRẠNG THÁI</th>
                                <th> SỐ CHƯƠNG</th>
                                <th> KHÓA TRUYỆN</th>
                                <th> THỜI GIAN</th>
                                <th class="text-right" width="125"> HÀNH ĐỘNG&nbsp;&nbsp;&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tusach as $val)
                            <tr id="tr-{{ $val->id }}">
                                <td class="align-middle font-weight-bold" width="15">{{ $loop->index+1 }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('trangchu.truyen', ['name_slug'=>$val->name_slug]) }}" target="_blank">
                                        <img src="{{ getStoryCover($val->cover) }}" alt="{{ $val->name }}" width="40">
                                        {{ $val->name }}
                                    </a>
                                </td>
                                <td class="align-middle"> {{ $val->author }}</td>
                                <td class="align-middle"> {{ $val->status }}</td>
                                <td class="align-middle"> {{ number_format($val->num_chaps) }}</td>
                                <td class="align-middle">
                                    @if($val->lock == 'N')
                                    <i class="fad fa-shield-check"></i> Không
                                    @else
                                    <i class="fas fa-lock-alt"></i> Khóa
                                    @endif
                                </td>
                                <td class="align-middle"> {{ $val->created_at->diffForHumans() }}</td>
                                <td class="align-middle text-center">
                                    <button class="btn btn-sm btn-icon btn-secondary" onclick="deleteTuSach('{{ $val->id }}')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="my-pagination">
                {{ $tusach->links() }}
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
    var myToken = '{{ csrf_token() }}';

    function deleteTuSach(id) {
        $.ajax({
            url: "{{ route('trangchu.truyen_xoa_tu_sach') }}",
            data: {
                truyen_id: id,
                _token: myToken
            },
            type: 'post',
            success: function() {
                $('#tr-' + id).remove();
                toastr.success('Xóa khỏi tủ sách thành công!', '');
            }
        });
    }
</script>
@endsection