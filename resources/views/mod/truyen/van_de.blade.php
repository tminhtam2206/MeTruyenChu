@extends('mod.truyen.index')
@section('title', 'Vấn Đề Phát Sinh')
@section('truyen_content')
<div class="page-inner pt-0">
    <div class="page-section">
        @if($truyen->lock == 'Y')
        <div class="alert alert-warning mt-3" role="alert">
            <i class="fas fa-exclamation-triangle"></i> Truyện <b>[{{ $truyen->name }}]</b> đã bị khóa, vui lòng liên hệ chấp sự!
        </div>
        @endif
        <div class="card card-fluid mt-3">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th width="20">#</th>
                            <th>THỰC HIỆN</th>
                            <th> VẤN ĐỀ</th>
                            <th> THỜI GIAN</th>
                            <th> HÀNH ĐỘNG</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vande as $val)
                        <tr id="problem-tr-{{ $val->id }}">
                            <td>{{ $loop->index+1 }}</td>
                            <td>
                                <a href="#" class="link-avatar">
                                    <img src="{{ getAvatar($val->User->avatar) }}" alt="{{ $val->User->display_name }}" width="40" height="40">
                                    {{ $val->User->display_name }}
                                </a>
                            </td>
                            <td> {{ $val->problem }}</td>
                            <td> {{ $val->created_at->diffForHumans() }}</td>
                            <td> <button class="btn btn-info" onclick="DaXem('{{ $val->id }}')"><i class="fas fa-check"></i> Đã sửa</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="my-pagination">
            {{ $vande->links() }}
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var my_token = '{{ csrf_token() }}';

    function DaXem(pro_id) {
        $.ajax({
            url: "{{ route('mod.truyen_da_dang.ajax_van_de') }}",
            data: {
                id: pro_id,
                _token: my_token
            },
            type: 'post',
            success: function() {
                $('#problem-tr-' + pro_id).remove();
            }
        });
    }
</script>
@endsection