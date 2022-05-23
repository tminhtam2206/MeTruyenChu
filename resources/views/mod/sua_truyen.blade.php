@extends('layouts.mod')
@section('title', 'Sửa Truyện')
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
                        <a href="{{ route('member.dashboard.my_story') }}">
                            <i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Truyện Đã Đăng
                        </a>
                    </li>
                </ol>
            </nav>
            <h1 class="page-title">SỬA TRUYỆN</h1>
        </header>
        <div class="page-section">
            <div class="d-xl-none">
                <button class="btn btn-danger btn-floated" type="button" data-toggle="sidebar"><i class="fa fa-th-list"></i></button>
            </div>
            <div class="card">
                <div class="card-body">
                    <form id="uploadForm" method="post" action="{{ route('mod.dang_truyen.post_chinh_sua') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" value="{{ $truyen->id }}" hidden>
                        <input type="text" name="name_slug" value="{{ $truyen->name_slug }}" hidden>
                        <fieldset>
                            <div id="privew-thumb" class="form-group py-2" style="background-image: url({{ getStoryThumb($truyen->thumb) }}); background-size: cover;">
                                <div class="frame-chua" style="width: 175px; margin: auto; position: relative;">
                                    <img id="preview-cover-story" class="rounded" src="{{ getStoryCover($truyen->cover) }}" alt="{{ $truyen->name }}">
                                    <span id="camera-icon" class="btn btn-light"><i class="fas fa-camera fa-lg"></i></span>
                                    <input type="file" name="cover" id="file_cover" accept=".jpg, .png, .jpeg" hidden>
                                </div>
                                <input type="file" name="thumb" id="file_thumb" accept=".jpg, .png, .jpeg" hidden>
                                <span id="change-thumb-icon" class="btn float-right"><i class="fas fa-camera fa-lg"></i></span>
                                <div class="cls"></div>
                            </div>
                            <div class="form-group">
                                <label for="ten_truyen">Tên Truyện <abbr title="Required">*</abbr></label>
                                <input type="text" class="form-control" maxlength="{{ tbl_fields['truyen']['name'] }}" id="ten_truyen" name="name" placeholder="VD: Thiên Đạo Phi Thiên" value="{{ $truyen->name }}" autocomplete="off" autofocus required>
                                <small class="form-text text-muted">Tên truyện không được phép trùng, bạn hãy search tên truyện trước khi đăng.</small>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="trang_thai">Trạng Thái <abbr title="Required">*</abbr></label>
                                <select id="trang_thai" class="form-control" data-toggle="select2" name="status" data-maximum-selection-length="4" required>
                                    <option value="Đang cập nhật" @if($truyen->status == 'Đang cập nhật') selected @endif>Đang cập nhật</option>
                                    <option value="Hoàn thành" @if($truyen->status == 'Hoàn thành') selected @endif>Hoàn thành</option>
                                    <option value="Ngừng" @if($truyen->status == 'Ngừng') selected @endif>Ngừng</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="loai_truyen">Loại Truyện <abbr title="Required">*</abbr></label>
                                <select id="loai_truyen" class="form-control" data-toggle="select2" name="type_story" data-maximum-selection-length="4" required>
                                    <option value="">--Chọn 1 loại trong đây--</option>
                                    <option value="Truyện Dịch" @if($truyen->type_story == 'Truyện Dịch') selected @endif>Truyện Dịch</option>
                                    <option value="Truyện Convert" @if($truyen->type_story == 'Truyện Convert') selected @endif>Truyện Convert</option>
                                    <option value="Sáng Tác" @if($truyen->type_story == 'Sáng Tác') selected @endif>Sáng Tác</option>
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
                                    <input type="text" class="form-control" id="author" name="author" maxlength="{{ tbl_fields['truyen']['author'] }}" placeholder="Nhập tên tác giả" value="{{ $truyen->author }}" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="the_loai_truyen">Thể Loại Truyện <abbr title="Required">*</abbr></label>
                                <select id="the_loai_truyen" class="form-control" data-toggle="select2" name="the_loai_truyen[]" data-placeholder="Chọn 1 hoặc nhiều thể loại trong đây" data-maximum-selection-length="4" multiple="true" required>
                                    @foreach($theloai_truyen as $val)
                                    @if(count($truyen_theloai) > 0)
                                    @foreach($truyen_theloai as $theloai)
                                    <option value="{{ $val->name }}" @if($val->name == $theloai->name) selected @endif>{{ $val->name }}</option>
                                    @endforeach
                                    @else
                                    <option value="{{ $val->name }}">{{ $val->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tf6">Giới Thiệu</label>
                                <textarea class="form-control ckeditor" id="description" name="description">{{ $truyen->description }}</textarea>
                                <small class="form-text text-muted">Tối đa 4000 ký tự. Tóm tắt cho truyện không nên quá dài mà nên ngắn gọn, tập trung, thú vị. Phần này rất quan trọng vì nó quyết định độc giả có đọc hay không.</small>
                            </div>
                            <div class="form-group">
                                <label for="tf6">Nguồn</label>
                                <fieldset>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="nguon" name="source" maxlength="{{ tbl_fields['truyen']['source'] }}" value="{{ $truyen->source }}" placeholder="http://tangkinhcac.atwebpages.com" autocomplete="off">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Cập Nhật Truyện</button>
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
    $(document).ready(function() {
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
<script>
    function previewFile(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $("#preview-cover-story").attr("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewFileThumb(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $("#privew-thumb").css("background-size", "cover");
                $("#privew-thumb").css("background", "url("+e.target.result+")");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#camera-icon').click(function(){
        $('#file_cover').click();
    });

    $('#file_cover').change(function(){
        previewFile(this);
    });

    $('#change-thumb-icon').click(function(){
        $('#file_thumb').click();
    });

    $('#file_thumb').change(function(){
        previewFileThumb(this);
    });
</script>
@endsection