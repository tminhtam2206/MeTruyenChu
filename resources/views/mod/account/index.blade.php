@extends('layouts.mod')
@section('title', 'Hồ Sơ Cá Nhân')
@section('content')
<div class="page">
    <div class="frame-chua" style="background-image: url('{{ getAvatarCover(Auth::user()->avatar_cover) }}'); background-size: cover;">
        <header class="page-cover" style="background-color: rgba(0,0,0,0.5) !important;">
            <div class="text-center">
                <a href="{{ route('mod.tai_khoan') }}" class="user-avatar user-avatar-xl">
                    <img class="userPicture" src="{{ getAvatar(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                </a>
                <h2 class="h4 mt-2 mb-0 text-light">{{ Auth::user()->display_name }}</h2>
                <div class="my-1">
                    <i class="far fa-star text-yellow"></i>
                    <i class="far fa-star text-yellow"></i>
                    <i class="far fa-star text-yellow"></i>
                    <i class="far fa-star text-yellow"></i>
                    <i class="far fa-star text-yellow"></i>
                </div>
                <p class="text-muted"><span>@</span>@if(Auth::user()->role == 'admin') Thánh Chủ @else Chấp Sự @endif - ({{ Auth::user()->exp_level }} - {{ Auth::user()->exp }} Exp)</p>
                <p style="color: #bdbfc9;">{{ Auth::user()->status }}</p>
            </div>
            <div class="cover-controls cover-controls-bottom">
                <a href="#" class="btn btn-light" style="color: #bdbfc9;">0 Người theo dõi</a>
                <a href="#" class="btn btn-light" style="color: #bdbfc9;">0 Đang theo dõi</a>
            </div>
        </header>
    </div>
    <nav class="page-navs">
        <div class="nav-scroller">
            <div class="nav nav-center nav-tabs">
                <a class="nav-link {{ ActiveLink('chap-su/tai-khoan', 'active') }}" href="{{ route('mod.tai_khoan') }}"><i class="fas fa-id-badge"></i> Tổng Quan</a>
                <a class="nav-link {{ ActiveLink('chap-su/tai-khoan/hoat-dong', 'active') }}" href="{{ route('mod.tai_khoan.hoat_dong') }}"><i class="fas fa-user-clock"></i> Hoạt Động</a>
                <a class="nav-link {{ ActiveLink('chap-su/tai-khoan/binh-luan', 'active') }}" href="{{ route('mod.tai_khoan.binh_luan') }}"><i class="fas fa-comment-dots"></i> Bình Luận</a>
                <a class="nav-link {{ ActiveLink2('chap-su/tai-khoan/thiet-lap', 'active') }}" href="{{ route('mod.tai_khoan.thiet_lap') }}"><i class="fas fa-user-cog"></i> Thiết Lập</a>
            </div>
        </div>
    </nav>
    @yield('profile_content')
</div>
@endsection