@extends('layouts.mod')
@section('title', 'Thông Báo')
@section('content')
<div class="page">
    <div class="page-inner">
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href="{{ route('mod.dashboard') }}">
                            <i class="breadcrumb-icon fa fa-angle-left mr-2"></i>BẢNG ĐIỀU KHIỂN
                        </a>
                    </li>
                </ol>
            </nav>

            <div class="d-md-flex align-items-md-start">
                <h1 class="page-title mr-sm-auto">THÔNG BÁO</h1>
            </div>
        </header>
        <div class="page-section">
            <div class="card">
                <div class="list-group list-group-messages list-group-flush list-group-bordered">
                    <!-- loop -->
                    @foreach($thongbao as $val)
                    <div class="list-group-item read">
                        <div class="list-group-item-figure float-left">
                            <div class="avatar">
                                <a href="{{ $val->content }}" class="user-avatar">
                                    <i class="fas fa-bell"></i>
                                </a>
                            </div>
                        </div>
                        <div class="list-group-item-body pl-md-2">
                            <div class="row">
                                <div class="col-12 col-lg-9">
                                    <h4 class="list-group-item-title text-truncate">
                                        <a href="{{ $val->content }}">{{ $val->title }}</a>
                                    </h4>
                                    <p class="list-group-item-text text-truncate">{{ $val->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- end loop -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection