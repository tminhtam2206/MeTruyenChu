@extends('layouts.admin')
@section('title', 'Phản Hồi')
@section('content')
<div class="page">
    <div class="page-inner">
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Bảng Điều Khiên
                        </a>
                    </li>
                </ol>
            </nav>

            <div class="d-md-flex align-items-md-start">
                <h1 class="page-title mr-sm-auto">PHẢN HỒI</h1>
                <div class="btn-toolbar">
                    <button type="button" class="btn btn-light">
                        <i class="oi oi-data-transfer-download"></i>
                        <span class="ml-1">Xuất</span>
                    </button>
                    <button type="button" class="btn btn-light">
                        <i class="oi oi-data-transfer-upload"></i>
                        <span class="ml-1">Nhập</span>
                    </button>
                </div>
            </div>
        </header>
        <div class="page-section">
            <div class="card card-fluid">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> HỌ TÊN</th>
                                    <th> THÔNG BÁO</th>
                                    <th> THỜI GIAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($phanhoi as $val)
                                <tr>
                                    <td class="align-middle">{{ $loop->index+1 }}</td>
                                    <td class="align-middle">
                                        <span href="#" class="tile tile-img mr-1">
                                            <img class="img-fluid" src="{{ asset('public/images/level.png') }}">
                                        </span>
                                        <span href="#">{{ $val->name }}</span>
                                    </td>
                                    <td class="align-middle"><textarea class="form-control" rows="1" readonly>{{ $val->message }}</textarea></td>
                                    <td class="align-middle">{{ $val->created_at }}</td>
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
@endsection