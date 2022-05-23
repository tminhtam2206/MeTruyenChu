@extends('admin.account.index')
@section('profile_content')
<div class="page-inner">
    <div class="page-section">
        <div class="section-block">
            <span>{{ Auth::user()->exp_level }} ({{ Auth::user()->exp }}/{{ ReturnPointByEXP(Auth::user()->exp) }} Exp)</span>
            <div class="progress mb-3">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{ TinhPhamTramEXP(Auth::user()->exp) }}%"></div>
            </div>
            <div class="metric-row">
                <div class="col-12 col-sm-6 col-lg-2">
                    <div class="card-metric">
                        <div class="metric">
                            <h5 class="text-center">
                                <span class="user-avatar user-avatar-lg">
                                    <img src="{{ asset('public/images/trang-thai.webp') }}" alt="" class="img-circle elevation-2" width="50">
                                </span>
                            </h5>
                            <span class="description-text">Trạng Thái</span>
                            <h2 class="metric-label" style="color: red !important;">Đang Hoạt Động</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <div class="card-metric">
                        <div class="metric">
                            <h5 class="text-center">
                                <span class="user-avatar user-avatar-lg">
                                    <img src="{{ asset('public/images/level.png') }}" alt="" class="img-circle elevation-2" width="50">
                                </span>
                            </h5>
                            <span class="description-text">Truyện Đã Đăng</span>
                            <h2 class="metric-label" style="color: red !important;">{{ Auth::user()->truyen_da_dang }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <div class="card-metric">
                        <div class="metric">
                            <h5 class="text-center">
                                <span class="user-avatar user-avatar-lg">
                                    <img src="{{ asset('public/images/level.png') }}" alt="" class="img-circle elevation-2" width="50">
                                </span>
                            </h5>
                            <span class="description-text">Tủ Truyện</span>
                            <h2 class="metric-label" style="color: red !important;">{{ Auth::user()->tu_truyen }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <div class="card-metric">
                        <div class="metric">
                            <h5 class="text-center">
                                <span class="user-avatar user-avatar-lg">
                                    <img src="{{ asset('public/images/level.png') }}" alt="" class="img-circle elevation-2" width="50">
                                </span>
                            </h5>
                            <span class="description-text">Bình Luận</span>
                            <h2 class="metric-label" style="color: red !important;">{{ Auth::user()->binh_luan }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <div class="card-metric">
                        <div class="metric">
                            <h5 class="text-center">
                                <span class="user-avatar user-avatar-lg">
                                    <img src="{{ asset('public/images/linh-thach-2.png') }}" alt="" class="img-circle elevation-2" width="50">
                                </span>
                            </h5>
                            <span class="description-text">Linh Thạch</span>
                            <h2 class="metric-label" style="color: red !important;">{{ ConverNumber(Auth::user()->coin) }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <div class="card-metric">
                        <div class="metric">
                            <h5 class="text-center">
                                <span class="user-avatar user-avatar-lg">
                                    <img src="{{ asset('public/images/level.png') }}" alt="" class="img-circle elevation-2" width="50">
                                </span>
                            </h5>
                            <span class="description-text">Cảnh Giới</span>
                            <h2 class="metric-label" style="color: red !important;">{{ Auth::user()->exp_level }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="section-title mb-0">Hoạt Động Gần Đây</h1>
                <div class="dropdown">
                    <button class="btn btn-secondary">
                        <span>Trong Tháng</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="card card-fluid">
                    <div class="card-header border-0">
                        <div class="d-flex align-items-center">
                            <span class="mr-auto">Tủ Truyện</span>
                            <div class="card-header-control">
                                <small class="text-muted">5 Truyện trong tủ</small>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @foreach($tusach as $val)
                                <tr>
                                    <td class="align-middle text-truncate">
                                        <img src="{{ getStoryCover($val->cover) }}" width="40">
                                        <a href="{{ route('trangchu.truyen', ['name_slug'=>$val->name_slug]) }}" target="_blank">{{ $val->name }}</a>
                                    </td>
                                    <td class="align-middle">{{ $val->author }}</td>
                                    <td class="align-middle">{{ $val->num_chaps }} chương</td>
                                    <td class="align-middle">{{ $val->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('trangchu.tu_sach') }}" class="card-footer-item">Xem tất cả <i class="fa fa-fw fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card card-fluid">
                    <div class="card-header border-0">
                        <div class="d-flex align-items-center">
                            <span class="mr-auto">Truyện Đã Đăng</span>
                            <div class="card-header-control">
                                <small class="text-muted">5 Truyện vừa đăng</small>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @foreach($truyen_dadang as $val)
                                <tr>
                                    <td class="align-middle text-truncate">
                                        <img src="{{ getStoryCover($val->cover) }}" width="40">
                                        <a href="{{ route('trangchu.truyen', ['name_slug'=>$val->name_slug]) }}" target="_blank">{{ $val->name }}</a>
                                    </td>
                                    <td class="align-middle">{{ $val->author }}</td>
                                    <td class="align-middle">{{ $val->num_chaps }} chương</td>
                                    <td class="align-middle">{{ $val->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('member.dashboard.my_story') }}" class="card-footer-item">Xem tất cả <i class="fa fa-fw fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection