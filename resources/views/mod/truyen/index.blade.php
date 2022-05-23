@extends('layouts.mod')
@section('title', 'Chi Tiết Truyện')
@section('content')
<div class="page">
    <div class="frame-chua" style="background-image: url('{{ getStoryThumb($truyen->thumb) }}'); background-size: cover;">
        <header class="page-cover" style="background-color: rgba(0,0,0,0.5) !important;">
            <div class="text-center">
                <span>
                    <img class="image" src="{{ getStoryCover($truyen->cover) }}" alt="{{ $truyen->name }}" width="100">
                </span>
                <h2 class="h4 mt-2 mb-0 text-light">{{ $truyen->name }}</h2>
                <div class="my-1">
                    @for($i = 1; $i <= 5; $i++)
                    @if($i <= $danhgia['marks'])
                    <i class="fa fa-star text-yellow"></i>
                    @else
                    <i class="far fa-star text-yellow"></i>
                    @endif
                    @endfor
                    
                </div>
                <p style="color: #bdbfc9 !important;">
                    <i class="fas fa-user-edit"></i>
                    {{ $truyen->author }} <span>@</span>{{ $truyen->User->display_name }}
                </p>
                <p> {{ $truyen->notify }}</p>
            </div>
            <div class="cover-controls cover-controls-bottom">
                <a href="#" class="btn btn-light" style="color: #bdbfc9;"><i class="fas fa-bookmark"></i> {{ number_format($truyen->bookmarks) }} Cất giữ</a>
                <a href="#" class="btn btn-light" style="color: #bdbfc9;"><i class="fas fa-heart-rate"></i> {{ number_format($truyen->views) }} lượt đọc</a>
            </div>
        </header>
    </div>
    <nav class="page-navs">
        <div class="nav-scroller">
            <div class="nav nav-center nav-tabs">
                <a class="nav-link {{ ActiveLink3('chi-tiet', 'active') }}" href="{{ route('mod.truyen_da_dang.chi_tiet', ['name_slug'=>$truyen->name_slug]) }}"><i class="fab fa-accusoft"></i> Tổng Quan</a>
                <a class="nav-link {{ ActiveLink2('danh-sach-chuong', 'active') }}" href="{{ route('mod.truyen_da_dang.danh_sach_chuong', ['name_slug'=>$truyen->name_slug]) }}"><i class="fas fa-list-ol"></i> Danh Sách Chương <span class="badge badge-primary">{{ $truyen->num_chaps }}</span></a>
                <a class="nav-link {{ ActiveLink2('van-de', 'active') }}" href="{{ route('mod.truyen_da_dang.van_de', ['name_slug'=>$truyen->name_slug]) }}"><i class="fas fa-bug"></i> Vấn Đề <span class="badge badge-danger">{{ $truyen->problem }}</span></a>
                <a class="nav-link {{ ActiveLink2('nhat-ky', 'active') }}" href="{{ route('mod.truyen_da_dang.nhat_ky', ['name_slug'=>$truyen->name_slug]) }}"><i class="fas fa-history"></i> Nhật Ký</a>
                @if(getCraw() == 'Y')
                <a class="nav-link {{ ActiveLink2('craw-chuong', 'active') }}" href="{{ route('mod.truyen_da_dang.craw_chuong', ['name_slug'=>$truyen->name_slug]) }}"><i class="fas fa-hat-wizard"></i> Craw Chương</a>
                @endif
                <a class="nav-link {{ ActiveLink2('thiet-lap', 'active') }}" href="{{ route('mod.truyen_da_dang.thiet_lap', ['name_slug'=>$truyen->name_slug]) }}"><i class="fas fa-sliders-v-square"></i> Thiết Lập</a>
            </div>
        </div>
    </nav>
    @yield('truyen_content')
</div>
@endsection