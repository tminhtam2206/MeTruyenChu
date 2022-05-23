@extends('mod.truyen.index')
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
        <div class="alert alert-warning mt-3" role="alert">
            <i class="fas fa-exclamation-triangle"></i> Chức năng <b>craw</b> chương <b>không hoạt động</b> với một số trang web, cẩn thận khi sử dụng chức năng này! Hiện tại chỉ hoạt động với trang <b>TruyenFull.vn</b>!
        </div>
        @if($truyen->lock == 'N')
        <div class="card mt-3">
            <div class="card-body">
                <form id="form_submit" action="{{ route('mod.truyen_da_dang.truyen_post_them_chuong') }}" method="POST">
                    @csrf
                    <input type="text" name="truyen_id" value="{{ $truyen->id }}" hidden>
                    <input type="text" name="truyen_name_slug" value="{{ $truyen->name_slug }}" hidden>
                    <div id="link-getdata" class="form-group">
                        <label for="ten_chuong">Địa chỉ trang web muốn lấy chương <abbr title="Required">*</abbr></label>
                        <input type="text" class="form-control" id="source" placeholder="VD: https://truyentr.info/truyen/than-dao-dan-ton/chuong-1/" autocomplete="off" autofocus required>
                    </div>
                    <div id="frame-content-raw" style="display: none;">
                        <div class="form-group">
                            <label for="numchap">Số Chương <abbr title="Required">*</abbr></label>
                            <div class="custom-number">
                                <input type="number" class="form-control" id="numchap" name="numchap" min="1" step="1" placeholder="Số chương..." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ten_chuong">Tên Chương <abbr title="Required">*</abbr></label>
                            <input type="text" class="form-control" maxlength="{{ tbl_fields['chuong']['name'] }}" id="ten_chuong" name="name" placeholder="VD: Ta Cười Người Nhìn Không Thấu" autocomplete="off" autofocus required>
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
        $('#getData').click(function() {
            var source = $('#source').val();

            if (source.trim().length == 0) {
                toastr.error('Vui lòng nhập địa chỉ', '');
            } else {
                $('#form_submit').submit(function(even) {
                    event.preventDefault();
                });
                $('#getData').html('Lấy Chương <i class="fas fa-sync-alt fa-spin"></i>');

                $.ajax({
                    url: "{{ route('mod.truyen_da_dang.craw_ajax') }}",
                    dataType: 'json',
                    data: {
                        _token: token,
                        source: source
                    },
                    type: 'post',
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