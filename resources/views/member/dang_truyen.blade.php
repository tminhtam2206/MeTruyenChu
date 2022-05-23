@extends('layouts.member')
@section('title', 'Đăng Truyện')
@section('mycss')
<link rel="stylesheet" href="{{ asset('public/assets/vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/assets/vendor/tributejs/tribute.css') }}">
<link rel="stylesheet" href="{{ asset('public/assets/vendor/at.js/css/jquery.atwho.min.css') }}">
@endsection
@section('content')
<div class="page">
    <div class="page-inner">
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href="{{ route('member.dashboard') }}">
                            <i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Bảng Điều Khiển
                        </a>
                    </li>
                </ol>
            </nav>
            <h1 class="page-title">ĐĂNG TRUYỆN</h1>
        </header>
        <div class="page-section">
            <div class="d-xl-none">
                <button class="btn btn-danger btn-floated" type="button" data-toggle="sidebar"><i class="fa fa-th-list"></i></button>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('member.dashboard.post_add') }}">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <label for="ten_truyen">Tên Truyện <abbr title="Tên truyện không được phép trùng">*</abbr></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" maxlength="{{ tbl_fields['truyen']['name'] }}" id="ten_truyen" name="name" value="{{ old('name') }}" placeholder="VD: Thiên Đạo Phi Thiên" value="{{ old('name') }}" autocomplete="off" autofocus required>
                                <small class="form-text text-muted">Tên truyện không được phép trùng, bạn hãy search tên truyện trước khi đăng.</small>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="loai_truyen">Loại Truyện <abbr title="Required">*</abbr></label>
                                <select id="loai_truyen" class="form-control" data-toggle="select2" name="type_story" data-maximum-selection-length="4" required>
                                    <option value="">--Chọn 1 loại trong đây--</option>
                                    <option value="Truyện Dịch">Truyện Dịch</option>
                                    <option value="Truyện Convert">Truyện Convert</option>
                                    <option value="Sáng Tác">Sáng Tác</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="author">Tác Giả <abbr title="Required">*</abbr></label>
                                <div class="has-clearable">
                                    <button type="button" class="close" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="fa fa-times-circle"></i>
                                        </span>
                                    </button>
                                    <input type="text" class="form-control" id="author" name="author" maxlength="{{ tbl_fields['truyen']['author'] }}" value="{{ old('author') }}" placeholder="Nhập tên tác giả" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="the_loai_truyen">Thể Loại Truyện <abbr title="Required">*</abbr></label>
                                <select id="the_loai_truyen" class="form-control" data-toggle="select2" name="the_loai_truyen[]" data-placeholder="Chọn 1 hoặc nhiều thể loại trong đây" data-maximum-selection-length="10" multiple="true" required>
                                    @foreach($theloai_truyen as $val)
                                    <option value="{{ $val->name }}">{{ $val->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tf6">Giới Thiệu</label>
                                <textarea class="form-control ckeditor" id="description" name="description">{{ old('description') }}</textarea>
                                <small class="form-text text-muted">Tối đa 4000 ký tự. Tóm tắt cho truyện không nên quá dài mà nên ngắn gọn, tập trung, thú vị. Phần này rất quan trọng vì nó quyết định độc giả có đọc hay không.</small>
                            </div>
                            <div class="form-group" hidden>
                                <label for="tf6">Nguồn</label>
                                <fieldset>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label class="input-group-prepend" for="nguon">
                                                <span class="input-group-text">http://</span>
                                            </label>
                                            <input type="text" class="form-control pl-0" id="nguon" name="source" maxlength="{{ tbl_fields['truyen']['source'] }}" placeholder="tangkinhcac.atwebpages.com" value="{{ old('source') }}" autocomplete="off">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu Truyện</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@if(Session::has('message'))
<script>
    $(document).ready(function(){
        Alert("{{ Session::get('message') }}");
    });
</script>
@endif
<script src="{{ asset('public/assets/vendor/handlebars/handlebars.min.js') }}"></script>
<script src="{{ asset('public/assets/vendor/typeahead.js/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('public/assets/vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('public/assets/vendor/tributejs/tribute.min.js') }}"></script>
<script src="{{ asset('public/assets/vendor/jquery.caret/jquery.caret.min.js') }}"></script>
<script src="{{ asset('public/assets/vendor/at.js/js/jquery.atwho.min.js') }}"></script>
<script src="{{ asset('public/assets/vendor/zxcvbn/zxcvbn.js') }}"></script>
<script src="{{ asset('public/assets/vendor/vanilla-text-mask/vanillaTextMask.js') }}"></script>
<script src="{{ asset('public/assets/vendor/text-mask-addons/textMaskAddons.js') }}"></script>
<script src="{{ asset('public/assets/javascript/theme.min.js') }}"></script>
<script src="{{ asset('public/assets/javascript/pages/select2-demo.js') }}"></script>
<script src="{{ asset('public/assets/javascript/pages/typeahead-demo.js') }}"></script>
<script src="{{ asset('public/assets/javascript/pages/atwho-demo.js') }}"></script>
<script src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
@endsection