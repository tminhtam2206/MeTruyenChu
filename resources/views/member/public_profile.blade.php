@extends('layouts.member')
@section('title', 'Hồ Sơ Cá Nhân | Tàng Kinh Các')
@section('content')
<div class="page">
    <header class="page-cover" style="background-image: url('{{ getAvatarCover(Auth::user()->avatar_cover) }}')">
        <div class="text-center">
            <a href="{{ route('admin.account') }}" class="user-avatar user-avatar-xl">
                <img class="userPicture" src="{{ getAvatar(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
            </a>
            <h2 class="h4 mt-2 mb-0">{{ Auth::user()->display_name }}</h2>
            <div class="my-1">
                <i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="far fa-star text-yellow"></i>
            </div>
            <p class="text-muted"><span>@</span>{{ Str::ucfirst(Auth::user()->role) }} ({{ Auth::user()->exp_level }} - {{ Auth::user()->exp }} Exp)</p>
            <p>{{ Auth::user()->status }}</p>
        </div>
        <div class="cover-controls cover-controls-bottom">
            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#followersModal">2,159 Người theo dõi</a>
            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#followingModal">136 Đang theo dõi</a>
        </div>
    </header>
    <div class="modal fade" id="followersModal" tabindex="-1" role="dialog" aria-labelledby="followersModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 id="followersModalLabel" class="modal-title"><i class="fas fa-users"></i> Người theo dõi</h6>
                </div>
                <div class="modal-body px-0">
                    <div class="list-group list-group-flush list-group-divider">
                        <div class="list-group-item">
                            <div class="list-group-item-figure">
                                <a href="#" class="user-avatar"><img src="assets/images/avatars/uifaces2.jpg" alt="Johnny Day"></a>
                            </div>
                            <div class="list-group-item-body">
                                <h4 class="list-group-item-title">
                                    <a href="#">Johnny Day</a>
                                </h4>
                                <p class="list-group-item-text">Computer Hardware Engineer</p>
                            </div>
                            <div class="list-group-item-figure">
                                <button type="button" class="btn btn-sm btn-primary">Follow</button>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="list-group-item-figure">
                                <a href="#" class="user-avatar"><img src="assets/images/avatars/uifaces9.jpg" alt="Jane Barnes"></a>
                            </div>
                            <div class="list-group-item-body">
                                <h4 class="list-group-item-title">
                                    <a href="#">Jane Barnes</a>
                                </h4>
                                <p class="list-group-item-text">Social Worker</p>
                            </div>
                            <div class="list-group-item-figure">
                                <button type="button" class="btn btn-sm btn-secondary">Following</button>
                            </div>
                        </div>
                    </div>
                    <div class="text-center p-3">
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                            <span class="sr-only">Đang tải...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="followingModal" tabindex="-1" role="dialog" aria-labelledby="followingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 id="followingModalLabel" class="modal-title"><i class="fas fa-users"></i> Đang theo dõi</h6>
                </div>
                <div class="modal-body px-0">
                    <div class="list-group list-group-flush list-group-divider">
                        <div class="list-group-item">
                            <div class="list-group-item-figure">
                                <a href="#" class="user-avatar"><img src="assets/images/avatars/uifaces2.jpg" alt="Johnny Day"></a>
                            </div>
                            <div class="list-group-item-body">
                                <h4 class="list-group-item-title">
                                    <a href="#">Johnny Day</a>
                                </h4>
                                <p class="list-group-item-text">Computer Hardware Engineer</p>
                            </div>
                            <div class="list-group-item-figure">
                                <button class="btn btn-sm btn-secondary">Following</button>
                            </div>
                        </div>
                    </div>
                    <div class="text-center p-3">
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                            <span class="sr-only">Đang tải...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <!-- <nav class="page-navs">
        <div class="nav-scroller">
            <div class="nav nav-center nav-tabs">
                <a class="nav-link {{ ActiveLink('dashboard/account', 'active') }}" href="{{ route('member.account') }}">Tổng Quan</a>
                <a class="nav-link" href="#">Hoạt Động</a>
                <a class="nav-link" href="#">Bình Luận</a>
                <a class="nav-link {{ ActiveLink2('account/setting', 'active') }}" href="{{ route('member.account.setting') }}">Thiết Lập</a>
            </div>
        </div>
    </nav> -->
    @yield('profile_content')
</div>
@endsection