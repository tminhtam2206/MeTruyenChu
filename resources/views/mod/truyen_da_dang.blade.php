@extends('layouts.mod')
@section('title', 'Truyện Đã Đăng')
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
                <h1 class="page-title mr-sm-auto">TRUYỆN ĐÃ ĐĂNG</h1>
                <div class="btn-toolbar">
                    <a href="{{ route('mod.dang_truyen') }}" class="btn btn-warning">
                        <i class="fas fa-plus"></i>
                        <span class="ml-1">Thêm Truyện</span>
                    </a>
                </div>
            </div>
        </header>
        <div class="page-section">
            <!-- start loop -->
            <div class="card card-fluid mt-3">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="25">#</th>
                                <th> TÊN TRUYỆN</th>
                                <th> TÁC GIẢ</th>
                                <th> TRẠNG THÁI</th>
                                <th> SỐ CHƯƠNG</th>
                                <th> LƯỢT ĐỌC</th>
                                <th> KHÓA TRUYỆN</th>
                                <th> THỜI GIAN</th>
                                <th class="text-right" width="125"> HÀNH ĐỘNG&nbsp;&nbsp;&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($truyen as $val)
                            @if($val->lock == 'N')
                            <tr>
                                <td class="align-middle font-weight-bold" width="15">{{ $loop->index+1 }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('mod.truyen_da_dang.chi_tiet', ['name_slug'=>$val->name_slug]) }}" class="link-avatar">
                                        <img src="{{ getStoryCover($val->cover) }}" alt="{{ $val->name }}" width="40">
                                        {{ $val->name }}
                                    </a>
                                </td>
                                <td class="align-middle"> {{ $val->author }}</td>
                                <td class="align-middle"> {{ $val->status }}</td>
                                <td class="align-middle"> {{ number_format($val->num_chaps) }}</td>
                                <td class="align-middle"> {{ number_format($val->views) }}</td>
                                <td class="align-middle">
                                    @if($val->lock == 'N')
                                    <i class="fad fa-shield-check"></i> Không
                                    @else
                                    <i class="fas fa-lock-alt"></i> Khóa
                                    @endif
                                </td>
                                <td class="align-middle"> {{ $val->created_at->diffForHumans() }}</td>
                                <td class="align-middle text-right">
                                    <a href="{{ route('mod.truyen_da_dang.them_chuong', ['name_slug'=>$val->name_slug]) }}" class="btn btn-sm btn-icon btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Thêm chương"><i class="fas fa-plus"></i></a>
                                    <a href="{{ route('mod.truyen_da_dang.danh_sach_chuong', ['name_slug'=>$val->name_slug]) }}" class="btn btn-sm btn-icon btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Danh sách chương"><i class="far fa-list"></i></a>
                                    <a href="{{ route('mod.dang_truyen.sua', ['name_slug'=>$val->name_slug]) }}" class="btn btn-sm btn-icon btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Sửa truyện"><i class="far fa-edit"></i></a>
                                </td>
                            </tr>
                            @else
                            <tr class="lock-stories">
                                <td class="align-middle font-weight-bold" width="15">{{ $loop->index+1 }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('mod.truyen_da_dang.chi_tiet', ['name_slug'=>$val->name_slug]) }}" class="link-avatar">
                                        <img src="{{ getStoryCover($val->cover) }}" alt="{{ $val->name }}" width="40">
                                        {{ $val->name }}
                                    </a>
                                </td>
                                <td class="align-middle"> {{ $val->author }}</td>
                                <td class="align-middle"> {{ $val->status }}</td>
                                <td class="align-middle"> {{ number_format($val->num_chaps) }}</td>
                                <td class="align-middle"> {{ number_format($val->views) }}</td>
                                <td class="align-middle">
                                    @if($val->lock == 'N')
                                    <i class="fad fa-shield-check"></i> Không
                                    @else
                                    <i class="fas fa-lock-alt"></i> Khóa
                                    @endif
                                </td>
                                <td class="align-middle"> {{ $val->created_at->diffForHumans() }}</td>
                                <td class="align-middle text-center">
                                    <button class="btn btn-sm btn-icon btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Vui lòng liên hệ chấp sự"><i class="fas fa-question-circle"></i></button>
                                    <a href="{{ route('mod.truyen_da_dang.danh_sach_chuong', ['name_slug'=>$val->name_slug]) }}" class="btn btn-sm btn-icon btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Danh sách chương"><i class="far fa-list"></i></a>
                                    <a href="{{ route('mod.dang_truyen.sua', ['name_slug'=>$val->name_slug]) }}" class="btn btn-sm btn-icon btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Sửa truyện"><i class="far fa-edit"></i></a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- start loop -->
        </div>
    </div>
</div>
@endsection