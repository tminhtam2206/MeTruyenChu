@extends('layouts.mod')
@section('title', 'Bảng Điều Khiển')
@section('content')
<div class="page">
    <div class="page-inner">
        <header class="page-title-bar">
            <div class="d-flex flex-column flex-md-row">
                <p class="lead">
                    <span class="font-weight-bold">Chào, {{ Auth::user()->display_name }}.</span>
                    <span class="d-block text-muted">Đây là những gì đang diễn ra với bạn hôm nay.</span>
                </p>
                <div class="ml-auto">
                    <div class="dropdown">
                        <button class="btn btn-secondary">
                            <span>{{ date('d-m-Y') }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <div class="page-section">
            <div class="section-block">
                <div class="metric-row">
                    <div class="col-lg-9">
                        <div class="metric-row metric-flush">
                            <div class="col">
                                <a href="{{ route('mod.truyen_da_dang') }}" class="metric metric-bordered align-items-center">
                                    <h2 class="metric-label text-uppercase">Truyện Đã Đăng</h2>
                                    <p class="metric-value h3">
                                        <sub><i class="fas fa-layer-group"></i></sub>
                                        <span class="value">{{ Auth::user()->truyen_da_dang }}</span>
                                    </p>
                                </a>
                            </div>
                            <div class="col">
                                <a href="{{ route('mod.bookmarks') }}" class="metric metric-bordered align-items-center">
                                    <h2 class="metric-label text-uppercase">Tủ Truyện</h2>
                                    <p class="metric-value h3">
                                        <sub><i class="fas fa-bookmark"></i></sub>
                                        <span class="value">{{ Auth::user()->tu_truyen }}</span>
                                    </p>
                                </a>
                            </div>
                            <div class="col">
                                <span class="metric metric-bordered align-items-center">
                                    <h2 class="metric-label text-uppercase">Bình Luận</h2>
                                    <p class="metric-value h3">
                                        <sub><i class="fa fa-comments"></i></sub>
                                        <span class="value">{{ Auth::user()->binh_luan }}</span>
                                    </p>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <span href="" class="metric metric-bordered">
                            <div class="metric-badge">
                                <span class="badge badge-lg badge-success"><span class="oi oi-media-record pulse mr-1"></span> TRẠNG THÁI</span>
                            </div>
                            <p class="metric-value h3">
                                <sub><i class="oi oi-timer"></i></sub>
                                <span class="value"><small>Đang hoạt động</small></span>
                            </p>
                        </span>
                    </div>
                </div>
            </div>
            <!-- code o day -->
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header my-0 pb-0">
                            <h3 class="card-title">
                                <i class="fas fa-user-clock"></i> <span class="text-uppercase">Hoạt Động Gần Đây</span>
                                <small class="float-right"><a href="{{ route('member.account.diary') }}">Xem tất cả</a></small>
                            </h3>
                        </div>
                        <div class="card-body py-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-light" hidden>
                                        <tr>
                                            <th width="20">#</th>
                                            <th>THỰC HIỆN</th>
                                            <th> HÀNH ĐỘNG</th>
                                            <th> THỜI GIAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($record as $val)
                                        <tr>
                                            <td class="align-middle">{{ $loop->index+1 }}</td>
                                            <td class="align-middle">
                                                <a href="#" class="link-avatar">
                                                    <img src="{{ getAvatar($val->User->avatar) }}" alt="{{ $val->User->display_name }}" width="40" height="40">
                                                    {{ $val->User->display_name }}
                                                </a>
                                            </td>
                                            <td class="align-middle"> {{ $val->log }}</td>
                                            <td class="align-middle"> {{ $val->created_at->diffForHumans() }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card card-widget widget-user">
                        <div class="card-header frame-header-index" style="background: url({{ asset('public/images/tien-hiep-1.jpeg') }}) center center;"></div>
                        <div class="widget-user-image frame-atavar-index">
                            <img class="img-circle" src="{{ getAvatar(Auth::user()->avatar) }}" alt="User Avatar">
                        </div>
                        <div class="card-footer frame-footer-index" style="background-color: rgba(0,0,0,.03);">
                            <div class="row">
                                <div class="col-4 border-right">
                                    <div class="description-block text-center">
                                        <h5 class="description-header text-center">
                                            <img src="{{ asset('public/images/book.png') }}" class="img-circle elevation-2" width="50">
                                        </h5>
                                        <span class="description-text text-uppercase">Số Truyện</span><br>
                                        <span class="description-text text-uppercase">
                                            <b class="text-danger" style="font-size: 18px;">{{ Auth::user()->truyen_da_dang }}</b>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-4 border-right">
                                    <div class="description-block text-center">
                                        <h5 class="description-header"><img src="{{ asset('public/images/chuong.png') }}" class="img-circle elevation-2" width="50"></h5>
                                        <span class="description-text text-uppercase">Số Chương</span><br>
                                        <span class="description-text text-uppercase">N/A</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="description-block text-center">
                                        <h5 class="description-header"><img src="{{ asset('public/images/thanh-tich.png') }}" class="img-circle elevation-2" width="50"></h5>
                                        <span class="description-text text-uppercase">Thành Tích</span><br>
                                        <span class="description-text text-uppercase">N/A</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header my-0 pb-0">
                            <h3 class="card-title">
                                <i class="fas fa-hourglass-start"></i> <span class="text-uppercase">truyện mới cập nhật</span>
                                <small class="float-right"><a href="{{ route('mod.truyen_da_dang') }}">Xem tất cả</a></small>
                            </h3>
                        </div>
                        <div class="card-body py-3 px-1">
                            @foreach($truyen as $val)
                            <div class="container-frame-story">
                                <div class="float-left">
                                    <img src="{{ getStoryCover($val->cover) }}" style="width: 80px; height: 113px;">
                                </div>
                                <div class="float-left ml-3">
                                    <h5 class="mb-1 font-weight-bold">
                                        <a href="{{ route('mod.truyen_da_dang.chi_tiet', ['name_slug'=>$val->name_slug]) }}" style="color: #007bff;"><i class="fas fa-feather-alt"></i> {{ $val->name }}</a>
                                    </h5>
                                    <small style="font-size: 83%;"><i class="fas fa-user-edit"></i> {{ $val->author }} | <i class="fas fa-clock"></i> {{ $val->updated_at->diffForHumans() }}</small>
                                    <div class="frame-button-index mt-3">
                                        <a href="{{ route('mod.truyen_da_dang.them_chuong', ['name_slug'=>$val->name_slug]) }}" class="btn btn-cam mr-1"><i class="fas fa-plus"></i> Thêm Chương</a>
                                        <a href="{{ route('mod.truyen_da_dang.danh_sach_chuong', ['name_slug'=>$val->name_slug]) }}" class="btn btn-xanh mr-1"><i class="far fa-list"></i> Danh Sách Chương</a>
                                        <a href="{{ route('mod.dang_truyen.sua', ['name_slug'=>$val->name_slug]) }}" class="btn btn-xam"><i class="far fa-edit"></i> Sửa Truyện</a>
                                    </div>
                                </div>
                                <div class="cls"></div>
                            </div>
                            <div class="cls"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header my-0 pb-0">
                            <h3 class="card-title">
                                <i class="fas fa-bug"></i> <span class="text-uppercase">Truyện Phát Sinh Lỗi</span>
                                <small class="float-right">5 vấn đề</small>
                            </h3>
                        </div>
                        <div class="card-body py-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-light" hidden>
                                        <tr>
                                            <th width="20">#</th>
                                            <th>TÊN TRUYỆN</th>
                                            <th> VẤN ĐỀ</th>
                                            <th> THỜI GIAN</th>
                                            <th> FIX</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bug as $val)
                                        <tr>
                                            <td class="align-middle">{{ $loop->index+1 }}</td>
                                            <td class="align-middle">
                                                <a href="#">
                                                    {{ $val->Truyen->name }}
                                                </a>
                                            </td>
                                            <td class="align-middle"><textarea class="form-control" rows="1" readonly>{{ $val->problem }}</textarea></td>
                                            <td class="align-middle"> {{ $val->created_at->diffForHumans() }}</td>
                                            <td class="align-middle"> <button class="btn btn-sm btn-icon btn-secondary"><i class="fas fa-check"></i></button></td>
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
    </div>
</div>
@endsection