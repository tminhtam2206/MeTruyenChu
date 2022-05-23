@extends('member.truyen.index')
@section('title', 'Craw Chương')
@section('mycss')
<link rel="stylesheet" href="{{ asset('public/assets/vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/assets/vendor/tributejs/tribute.css') }}">
<link rel="stylesheet" href="{{ asset('public/assets/vendor/at.js/css/jquery.atwho.min.css') }}">
@endsection
@section('truyen_content')
<div class="page-inner pt-0">
    <div class="page-section">
        @if($truyen->lock == 'Y')
        <div class="alert alert-warning mt-3" role="alert">
            <i class="fas fa-exclamation-triangle"></i> Truyện <b>[{{ $truyen->name }}]</b> đã bị khóa, vui lòng liên hệ chấp sự!
        </div>
        @endif
        @if(strlen(trim($truyen['link_craw'])) > 0)
        <div class="alert alert-warning mt-3" role="alert">
            <i class="fas fa-exclamation-triangle"></i> Chức năng <b>craw</b> chương <b>không hoạt động</b> với một số trang web, cẩn thận khi sử dụng chức năng này! <br>
            Hiện tại chỉ hoạt động với trang <b>truyenfull.vn</b> <b>wattpad.vn</b> và <b>sstruyen.com</b>!
        </div>
        @else
        <div class="alert alert-warning mt-3" role="alert">
            <i class="fas fa-exclamation-triangle"></i> Link craw chương <b>bị rỗng!</b> Vui lòng quay lại <b>trang sửa truyện</b> để thêm link, hoặc <b><a href="{{ route('member.dashboard.my_story.edit', ['name_slug'=>$truyen->name_slug]) }}">nhấn vào đây</a></b>.
        </div>
        @endif

        @if($truyen->lock == 'N')
        @if(strlen(trim($truyen['link_craw'])) > 0)
        <div class="card mt-3">
            <div class="card-body">
                <form id="form_submit" action="{{ route('member.story.craw_save') }}" method="POST">
                    @csrf
                    <input type="text" name="truyen_id" value="{{ $truyen->id }}" hidden>
                    <input type="text" name="truyen_name_slug" value="{{ $truyen->name_slug }}" hidden>
                    <div id="link-getdata" class="form-group">
                        <label for="ten_chuong">Địa chỉ trang web muốn lấy chương <abbr title="Required">*</abbr></label>
                        <input type="text" class="form-control" id="source" value="{{ $truyen->link_craw }}chuong-{{ ($truyen->num_chaps + 1) }}" placeholder="VD: https://truyenfull.vn/thien-dao-phi-tien/chuong-1/" autocomplete="off" autofocus required>
                    </div>
                    <div id="frame-content-raw" style="display: none;">
                        <div class="form-group">
                            <label for="numchap">Số Chương <abbr title="Required">*</abbr></label>
                            <div class="custom-number">
                                <input type="number" class="form-control" id="numchap" name="numchap" min="1" step="1" placeholder="Số chương..." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ten_chuong">Tên Chương</label>
                            <input type="text" class="form-control" maxlength="{{ tbl_fields['chuong']['name'] }}" id="ten_chuong" name="name" placeholder="VD: Ta Cười Người Nhìn Không Thấu" autocomplete="off" autofocus>
                            <small class="form-text text-muted">Tên chương không nên quá dài, tối đa {{ tbl_fields['chuong']['name'] }} ký tự.</small>
                        </div>
                        <div class="form-group">
                            <label for="tf6">Nội Dung</label>
                            <textarea class="form-control ckeditor" id="content" name="content"></textarea>
                        </div>
                    </div>
                    <div class="text-center">
                        <button id="getData" class="btn btn-primary">Lấy Chương</button>
                        <button id="newGetData" class="btn btn-primary" style="display: none;">Lấy Lại</button>
                        <button id="my-summit" type="submit" class="btn btn-primary" style="display: none;">Lưu Chương</button>
                    </div>
                </form>
            </div>
        </div>            
        @endif
        @endif
    </div>
</div>
@endsection
@section('script')
<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    var token = '{{ csrf_token() }}';

    $(document).ready(function() {
        @if($truyen['auto_craw'] == 'YES')
        setTimeout(function(){
            var source = $('#source').val();

            if (source.trim().length == 0) {
                toastr.error('Vui lòng nhập địa chỉ', '');
            } else {
                if(characterCheck(source) >= 4){
                    $('#form_submit').submit(function(even) {
                        event.preventDefault();
                    });
                    $('#getData').html('Lấy Chương <i class="fas fa-sync-alt fa-spin"></i>');

                    $.ajax({
                        url: "{{ route('member.story.craw_ajax') }}",
                        dataType: 'json',
                        data: {
                            source: source
                        },
                        type: 'get',
                        success: function(data_return) {
                            if (data_return.length == 0) {

                            } else {
                                $('#getData').html('Lấy Chương');
                                $('#getData').css('display', 'none');
                                $.each(data_return, function(key, value) {
                                    if (key == 'num') {
                                        $('#numchap').val(value);
                                    } else if (key == 'title') {
                                        $('#ten_chuong').val(value);
                                    } else {
                                        CKEDITOR.instances['content'].setData(value);
                                    }
                                });

                                $('#link-getdata').css('display', 'none');
                                $('#my-summit').css('display', '');
                                $('#newGetData').css('display', '');
                                $('#frame-content-raw').css('display', '');
                                $('#my-summit').click();
                            }
                        }
                    });
                }else{
                    toastr.error('Địa chỉ không hợp lệ, vui lòng xem lại VD', '');
                }
            }
        }, 1000);

        setInterval(function(){
            var source = $('#source').val();

            if (source.trim().length == 0) {
                toastr.error('Vui lòng nhập địa chỉ', '');
            } else {
                if(characterCheck(source) >= 4){
                    $('#form_submit').submit(function(even) {
                        event.preventDefault();
                    });
                    $('#getData').html('Lấy Chương <i class="fas fa-sync-alt fa-spin"></i>');

                    $.ajax({
                        url: "{{ route('member.story.craw_ajax') }}",
                        dataType: 'json',
                        data: {
                            source: source
                        },
                        type: 'get',
                        success: function(data_return) {
                            if (data_return.length == 0) {

                            } else {
                                $('#getData').html('Lấy Chương');
                                $('#getData').css('display', 'none');
                                $.each(data_return, function(key, value) {
                                    if (key == 'num') {
                                        $('#numchap').val(value);
                                    } else if (key == 'title') {
                                        $('#ten_chuong').val(value);
                                    } else {
                                        CKEDITOR.instances['content'].setData(value);
                                    }
                                });

                                $('#link-getdata').css('display', 'none');
                                $('#my-summit').css('display', '');
                                $('#newGetData').css('display', '');
                                $('#frame-content-raw').css('display', '');
                                $('#my-summit').click();
                            }
                        }
                    });
                }else{
                    toastr.error('Địa chỉ không hợp lệ, vui lòng xem lại VD', '');
                }
            }
        }, 5000);
        @endif

        $('#getData').click(function() {
            var source = $('#source').val();

            if (source.trim().length == 0) {
                toastr.error('Vui lòng nhập địa chỉ', '');
            } else {
                if(characterCheck(source) >= 4){
                    $('#form_submit').submit(function(even) {
                        event.preventDefault();
                    });
                    $('#getData').html('Lấy Chương <i class="fas fa-sync-alt fa-spin"></i>');

                    $.ajax({
                        url: "{{ route('member.story.craw_ajax') }}",
                        dataType: 'json',
                        data: {
                            source: source
                        },
                        type: 'get',
                        success: function(data_return) {
                            if (data_return.length == 0) {

                            } else {
                                $('#getData').html('Lấy Chương');
                                $('#getData').css('display', 'none');
                                $.each(data_return, function(key, value) {
                                    if (key == 'num') {
                                        $('#numchap').val(value);
                                    } else if (key == 'title') {
                                        $('#ten_chuong').val(value);
                                    } else {
                                        CKEDITOR.instances['content'].setData(value);
                                    }
                                });

                                $('#link-getdata').css('display', 'none');
                                $('#my-summit').css('display', '');
                                $('#newGetData').css('display', '');
                                $('#frame-content-raw').css('display', '');
                            }
                        }
                    });
                }else{
                    toastr.error('Địa chỉ không hợp lệ, vui lòng xem lại VD', '');
                }

                
            }
        });

        $('#newGetData').click(function() {
            $('#form_submit').submit(function(even) {
                event.preventDefault();
            });

            $('#frame-content-raw').css('display', 'none');
            $('#link-getdata').css('display', '');
            $('#my-summit').css('display', 'none');
            $('#newGetData').css('display', 'none');
            $('#getData').css('display', '');
        });

        $('#my-summit').click(function(){
            $('#form_submit').submit();
        });
    });

    function characterCheck(_link){
        return _link.split('/').length - 1;
    }
</script>
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