@extends('layouts.forum')
@section('title', 'Đăng Bài')
@section('css')
<link rel="stylesheet" href="{{ asset('public/assets/vendor/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')
<div class="page-inner">
    <div class="container">
        <div class="page-section">
            <div class="section-block">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('forum.dangbai.post') }}" method="POST">
                            @csrf
                            <input type="text" value="{{ Auth::user()->id }}" name="user_id" hidden>
                            <div class="form-group">
                                <label for="title">Tiêu Đề Bài Đăng <abbr title="Tiêu đề không được phép bỏ trống">(*)</abbr></label>
                                <input type="text" class="form-control" maxlength="255" id="title" name="title" placeholder="VD: Làm Sao Đăng Bài Trên Diễn Đàn" autocomplete="off" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="tag">Thẻ tag <abbr title="Thẻ tag không được phép bỏ trống">(*)</abbr></label>
                                <input type="text" class="form-control" maxlength="255" id="tag" name="tag" placeholder="VD: Tiên Hiệp" autocomplete="off" autofocus required>
                            </div>
                            <div class="form-group">
                                <label>Nội dung bài đăng</label>
                                <div class="card card-fluid">
                                    <textarea id="mysummernote" name="content" data-toggle="summernote" data-placeholder="Nội dung bài đăng của bạn..." data-height="400" required></textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Đăng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('public/assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('public/assets/javascript/pages/summernote-demo.js') }}"></script>
<script>
    // $(document).ready(function() {
    //     $("#mysummernote").emojioneArea();
    // });
</script>
@endsection