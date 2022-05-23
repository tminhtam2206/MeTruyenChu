@extends('mod.truyen.index')
@section('title', 'Thiết Lập')
@section('truyen_content')
<div class="page">
    <div class="page-inner">
        <div class="page-section">
            @if($truyen->lock == 'Y')
            <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i> Truyện <b>[{{ $truyen->name }}]</b> đã bị khóa, vui lòng liên hệ chấp sự!
            </div>
            @endif
            <form action="{{ route('mod.truyen_da_dang.post_thiet_lap') }}" method="post">
                @csrf
                <input type="text" name="id" value="{{ $truyen->id }}" hidden>
                <input type="text" name="name_slug" value="{{ $truyen->name_slug }}" hidden>
                <div class="card card-fluid">
                    <h6 class="card-header text-center"><i class="fas fa-tools"></i> THIẾT LẬP TRUYỆN</h6>
                    <div class="list-group list-group-flush">
                        <div class="list-group-header">Thiết Lập Cơ Bản</div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Công Bố Truyện</span>
                            <label class="switcher-control switcher-control-lg">
                                <input type="checkbox" class="switcher-input" name="public" @if($truyen->public == 'Y') checked @endif>
                                <span class="switcher-indicator"></span>
                                <span class="switcher-label-on">BẬT</span>
                                <span class="switcher-label-off">TẮT</span>
                            </label>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Khóa Bình Luận Của Web</span>
                            <label class="switcher-control switcher-control-lg">
                                <input type="checkbox" name="lock_comment" class="switcher-input" @if($truyen->lock_comment == 'Y') checked @endif>
                                <span class="switcher-indicator"></span>
                                <span class="switcher-label-on">BẬT</span>
                                <span class="switcher-label-off">TẮT</span>
                            </label>
                        </div>
                        <div class="list-group-header" style="border-top: 0px;">Thiết Lập Khác (Quản Trị Viên)</div>
                        <div class="list-group-item d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #ecedf1;">
                            <span>Khóa Truyện</span>
                            <label class="switcher-control switcher-control-lg">
                                <input type="checkbox" class="switcher-input" name="lock" @if($truyen->lock == 'Y') checked @endif @if(Auth::user()->role != 'admin') disabled @endif>
                                <span class="switcher-indicator"></span>
                                <span class="switcher-label-on">BẬT</span>
                                <span class="switcher-label-off">TẮT</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group text-center mt-3">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu Lại</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection