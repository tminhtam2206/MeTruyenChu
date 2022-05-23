@extends('member.account.index')
@section('title', 'Bình Luận Gần Đây')
@section('profile_content')
<div class="page-inner pt-0">
    <div class="page-section">
        <div class="card card-fluid mt-3">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th width="20">#</th>
                            <th>THỰC HIỆN</th>
                            <th> NỘI DUNG</th>
                            <th> THỜI GIAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comment as $val)
                        <tr>
                            <td class="align-middle">{{ $loop->index+1 }}</td>
                            <td class="align-middle">
                                <a href="#" class="link-avatar"> 
                                    <img src="{{ getAvatar($val->User->avatar) }}" alt="{{ $val->User->display_name }}" width="40" height="40">
                                    {{ $val->User->display_name }}
                                </a>
                            </td>
                            <td class="align-middle"> {{ $val->content }}</td>
                            <td class="align-middle"> {{ $val->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection