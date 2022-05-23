@extends('member.truyen.index')
@section('title', 'Nhật Ký Truyện')
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
                            <th> HÀNH ĐỘNG</th>
                            <th> CHƯƠNG</th>
                            <th> THỜI GIAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($record as $val)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>
                                <a href="#" class="link-avatar">
                                    <img src="{{ getAvatar($val->User->avatar) }}" alt="{{ $val->User->display_name }}" width="40" height="40">
                                    {{ $val->User->display_name }}
                                </a>
                            </td>
                            <td> {{ $val->log }}</td>
                            <td> {{ $val->numchap }}</td>
                            <td> {{ $val->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection