@extends('layouts.forum')
@section('title', 'Diễn Đàn')
@section('content')
<div class="page-inner">
    <div class="container">
        <div class="page-section">
            <div class="section-block">
                <div class="card card-fluid mt-3">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead id="thead-index" class="thead-light">
                                <tr>
                                    <th width="40"> HÌNH</th>
                                    <th> TIÊU ĐỀ</th>
                                    <th width="120"> &ensp;</th>
                                    <th width="220"> THÀNH VIÊN</th>
                                    <th width="90"> TRẢ LỜI</th>
                                    <th width="90"> LƯỢT XEM</th>
                                    <th width="90"> THỜI GIAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- loop -->
                                @foreach($baidang as $val)
                                <tr>
                                    <td class="align-middle">
                                        <a href="#" class="link-avatar">
                                            <img src="{{ getAvatar($val->User->avatar) }}" width="40">
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('forum.baidang', ['title'=>$val->title_u]) }}" class="title">{{ $val->title }}</a><br>
                                        <a href="#" class="user">{{ $val->User->name }} . {{ $val->created_at->diffForHumans() }}</a>
                                    </td>
                                    <td class="align-middle" style="color: #919191; font-weight: 700; font-size: 10px;"> {{ $val->tag }} <span style="background-color: #25a279; width: 10px; height: 10px; display: inline-block;"></span></td>
                                    <td class="align-middle"> 1</td>
                                    <td class="align-middle"> {{ number_format($val->comments) }}</td>
                                    <td class="align-middle"> {{ number_format($val->views) }}</td>
                                    <td class="align-middle"> {{ $val->updated_at->diffForHumans() }}</td>
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
@endsection