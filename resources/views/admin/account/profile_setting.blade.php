@extends('admin.account.index')
@section('profile_content')
<div class="page">
    <div class="page-inner">
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href="{{ route('admin.account') }}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Tổng Quan</a>
                    </li>
                </ol>
            </nav>
        </header>
        <div class="page-section">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-fluid">
                        <h6 class="card-header">Chi Tiết Tài Khoản</h6>
                        <nav class="nav nav-tabs flex-column border-0">
                            <a href="{{ route('admin.account.setting') }}" class="nav-link {{ ActiveLink('admin/account/setting', 'active') }}">Hồ Sơ</a>
                            <a href="{{ route('admin.account.setting.detail') }}" class="nav-link {{ ActiveLink('admin/account/setting/detail', 'active') }}">Tài Khoản</a>
                            <a href="{{ route('admin.account.setting.billing') }}" class="nav-link {{ ActiveLink('admin/account/setting/billing', 'active') }}">Thanh Toán</a>
                            <a href="{{ route('admin.account.setting.notify') }}" class="nav-link {{ ActiveLink('admin/account/setting/notify', 'active') }}">Thông Báo</a>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-8">
                    @yield('content_setting_profile')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection