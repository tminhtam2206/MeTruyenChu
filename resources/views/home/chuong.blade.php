@extends('layouts.home')
@section('title', 'Truyện '.$truyen->name.' - Chương '.$chuong->numchap)
@section('content')
<ol class="breadcrumb shadow-sm an-chu">
    <li class="breadcrumb-item">
        <a class="text-muted" href="{{ env('APP_URL') }}"><i class="fas fa-home"></i> Home</a>
    </li>
    <li class="breadcrumb-item">
        <a class="text-muted" href="{{ route('trangchu.truyen', ['name_slug'=>$truyen->name_slug]) }}">{{ $truyen->name }}</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Chương {{ $chuong->numchap }}</li>
</ol>
<div class="container-fluid px-0 mb-3">
    <div id="body-truyen" class="container-fluid myboder-2 shadow-sm" {{ returnCookiePage() }}>
        <div class="setting-page mt-0">
            <span class="btn" style="margin-top: 4px;" data-toggle="tooltip" data-placement="bottom" title="Số chữ"><i class="fas fa-text"></i> {{ $chuong->number_letters }} chữ</span>
            <span id="setting" class="btn btn-setting float-right" data-toggle="tooltip" data-placement="bottom" title="Thiết lập"><i class="fad fa-cog"></i></span>
            <span id="btn-like" class="btn btn-setting float-right" data-toggle="tooltip" data-placement="bottom" title="Yêu thích"><i class="fad fa-heart"></i></span>
            <div class="cls"></div>
        </div>
        <div class="title-read-truyen mb-5">
            <h4 class="text-center font-roman font-weight-bolder">Chương {{ $chuong->numchap }}<br>{{ $chuong->name }}</h4>
        </div>
        <div class="content-truyen">
            <div class="phan-trang mb-3">
                <a class="btn my-btn-luot btn-trai btn-outline-secondary @if($chuong->numchap <= 1) disabled @endif" href="{{ route('trangchu.chuong', ['truyen'=>$truyen->name_slug, 'chuong'=>'chuong-'.($chuong->numchap-1)]) }}">← Trước</a>
                <a class="btn my-btn-luot btn-phai float-right btn-outline-secondary @if($chuong->numchap >= $truyen->num_chaps) disabled @endif" href="{{ route('trangchu.chuong', ['truyen'=>$truyen->name_slug, 'chuong'=>'chuong-'.($chuong->numchap+1)]) }}">Tiếp →</a>
            </div>
            <div id="content-noi-dung" class="px-3">
                @if($chuong->lock != 'Y')
                {!! $chuong->content !!}
                @else
                    @if($chuong->user_id == getIdUser() || $thanhvien == true)
                        {!! $chuong->content !!}
                    @else
                        @if(getIdUser() > 0)
                            @if($read_story == true)
                            {!! $chuong->content !!}
                            @else
                                <div class="khoa-chuong text-center">
                                    <i class="fas fa-lock-alt fa-4x text-danger"></i>
                                    <p class="mt-2">Bạn đã hết linh thạch.<br/>Đăng truyện để có thêm linh thạch.</p>
                                </div>
                            @endif
                        @else
                        <div class="khoa-chuong text-center">
                            <i class="fas fa-lock-alt fa-4x text-danger"></i>
                            <p class="mt-2">Đăng nhập để sử dụng linh thạch mua chương.</p>
                        </div>
                        @endif
                    @endif
                @endif
            </div>
            <div class="phan-trang mb-3 mt-1">
                <a class="btn my-btn-luot btn-trai btn-outline-secondary @if($chuong->numchap <= 1) disabled @endif" href="{{ route('trangchu.chuong', ['truyen'=>$truyen->name_slug, 'chuong'=>'chuong-'.($chuong->numchap-1)]) }}">← Trước</a>
                <a class="btn my-btn-luot btn-phai float-right btn-outline-secondary @if($chuong->numchap >= $truyen->num_chaps) disabled @endif" href="{{ route('trangchu.chuong', ['truyen'=>$truyen->name_slug, 'chuong'=>'chuong-'.($chuong->numchap+1)]) }}">Tiếp →</a>
            </div>
            <div class="info-chap pb-2">
                <div class="mt-3"></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <p>
                                <div class="col-6">
                                    <p class="py-0 px-0" data-toggle="tooltip" data-placement="bottom" title="Lượt đọc"><b><i class="fas fa-analytics"></i> </b> {{ number_format($chuong->view) }}</p>
                                </div>
                                <div class="col-6">
                                    <p class="py-0 px-0" data-toggle="tooltip" data-placement="bottom" title="Lượt thích"><b><i class="fas fa-heart"></i> </b> {{ number_format($chuong->like) }}</p>
                                </div>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <p>
                                <div class="col-6">
                                    <p class="py-0 px-0" data-toggle="tooltip" data-placement="bottom" title="Ngày tạo"><b><i class="fas fa-calendar-alt"></i> </b> {{ $chuong->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="col-6">
                                    <p class="py-0 px-0" data-toggle="tooltip" data-placement="bottom" title="Cập nhật"><b><i class="fas fa-calendar-edit"></i> </b> {{ $chuong->updated_at->diffForHumans() }}</p>
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="popu-father" class="container-fluid">
            <div id="span-close-nha"><span class="btn border-light rounded-circle float-right btn-closeee text-center mr-3 mt-2"><i class="far fa-times"></i></span>
                <div class="cls"></div>
            </div>
            <div id="popu" class="container">
                <form name="f_Font">
                    <label class="font-weight-bolder text-light mt-2">Font Chữ</label>
                    <select class="chonFont form-control">
                        <option value="Helvetica" <?php if (isset($_COOKIE['tangkinhcac_fontFam']) && $_COOKIE['tangkinhcac_fontFam'] == "Helvetica") {
                                                        echo 'selected';
                                                    } ?>>Helvetica</option>
                        <option value="Times New Roman" <?php if (isset($_COOKIE['tangkinhcac_fontFam']) && $_COOKIE['tangkinhcac_fontFam'] == "Times New Roman") {
                                                            echo 'selected';
                                                        } ?>>Times New Roman</option>
                        <option value="Lora" <?php if (isset($_COOKIE['tangkinhcac_fontFam']) && $_COOKIE['tangkinhcac_fontFam'] == "Lora") {
                                                    echo 'selected';
                                                } ?>>Lora</option>
                        <option value="Playfair Display" <?php if (isset($_COOKIE['tangkinhcac_fontFam']) && $_COOKIE['tangkinhcac_fontFam'] == "Playfair Display") {
                                                                echo 'selected';
                                                            } ?>>Playfair Display</option>
                        <option value="Open Sans Condensed" <?php if (isset($_COOKIE['tangkinhcac_fontFam']) && $_COOKIE['tangkinhcac_fontFam'] == "Open Sans Condensed") {
                                                                echo 'selected';
                                                            } ?>>Open Sans Condensed</option>
                        <option value="Raleway" <?php if (isset($_COOKIE['tangkinhcac_fontFam']) && $_COOKIE['tangkinhcac_fontFam'] == "Raleway") {
                                                    echo 'selected';
                                                } ?>>Raleway</option>
                        <option value="David Libre" <?php if (isset($_COOKIE['tangkinhcac_fontFam']) && $_COOKIE['tangkinhcac_fontFam'] == "David Libre") {
                                                        echo 'selected';
                                                    } ?>>David Libre</option>
                    </select>
                </form>
                <form name="f_Size">
                    <label class="font-weight-bolder text-light mt-2">Size Chữ</label>
                    <select class="form-control chonSize">
                        <option value="20px" <?php if (isset($_COOKIE['tangkinhcac_sizeFon']) && $_COOKIE['tangkinhcac_sizeFon'] == "20px") {
                                                    echo 'selected';
                                                } ?>>20px</option>
                        <option value="21px" <?php if (isset($_COOKIE['tangkinhcac_sizeFon']) && $_COOKIE['tangkinhcac_sizeFon'] == "21px") {
                                                    echo 'selected';
                                                } ?>>21px</option>
                        <option value="22px" <?php if (isset($_COOKIE['tangkinhcac_sizeFon']) && $_COOKIE['tangkinhcac_sizeFon'] == "22px") {
                                                    echo 'selected';
                                                } ?>>22px</option>
                        <option value="23px" <?php if (isset($_COOKIE['tangkinhcac_sizeFon']) && $_COOKIE['tangkinhcac_sizeFon'] == "23px") {
                                                    echo 'selected';
                                                } ?>>23px</option>
                        <option value="24px" <?php if (isset($_COOKIE['tangkinhcac_sizeFon']) && $_COOKIE['tangkinhcac_sizeFon'] == "24px") {
                                                    echo 'selected';
                                                } ?>>24px</option>
                        <option value="25px" <?php if (isset($_COOKIE['tangkinhcac_sizeFon']) && $_COOKIE['tangkinhcac_sizeFon'] == "25px") {
                                                    echo 'selected';
                                                } ?>>25px</option>
                        <option value="26px" <?php if (isset($_COOKIE['tangkinhcac_sizeFon']) && $_COOKIE['tangkinhcac_sizeFon'] == "26px") {
                                                    echo 'selected';
                                                } ?>>26px</option>
                        <option value="27px" <?php if (isset($_COOKIE['tangkinhcac_sizeFon']) && $_COOKIE['tangkinhcac_sizeFon'] == "27px") {
                                                    echo 'selected';
                                                } ?>>27px</option>
                        <option value="28px" <?php if (isset($_COOKIE['tangkinhcac_sizeFon']) && $_COOKIE['tangkinhcac_sizeFon'] == "28px") {
                                                    echo 'selected';
                                                } ?>>28px</option>
                        <option value="29px" <?php if (isset($_COOKIE['tangkinhcac_sizeFon']) && $_COOKIE['tangkinhcac_sizeFon'] == "29px") {
                                                    echo 'selected';
                                                } ?>>29px</option>
                        <option value="30px" <?php if (isset($_COOKIE['tangkinhcac_sizeFon']) && $_COOKIE['tangkinhcac_sizeFon'] == "30px") {
                                                    echo 'selected';
                                                } ?>>30px</option>
                    </select>
                </form>
                <form name="f_Them">
                    <label class="font-weight-bolder text-light mt-2">Giao Diện</label>
                    <select class="form-control chonBackGround">
                        <option value="url({{ asset('public/images/skin-default.jpg') }})  0% 0% / cover no-repeat fixed" <?php if (isset($_COOKIE['tangkinhcac_fontFam']) && $_COOKIE['tangkinhcac_fontFam'] == "url(public/images/skin-default.jpg)") {
                                                                                                echo 'selected';
                                                                                            } ?>>Cổ Trang</option>
                        <option value="#FFFFFF" <?php if (isset($_COOKIE['tangkinhcac_bgColor']) && $_COOKIE['tangkinhcac_bgColor'] == "#FFFFFF") {
                                                    echo 'selected';
                                                } ?>>Trắng</option>
                        <option value="#e4e2e2" <?php if (isset($_COOKIE['tangkinhcac_bgColor']) && $_COOKIE['tangkinhcac_bgColor'] == "#e4e2e2") {
                                                    echo 'selected';
                                                } ?>>Xám</option>
                        <option value="#EEEEEE" <?php if (isset($_COOKIE['tangkinhcac_bgColor']) && $_COOKIE['tangkinhcac_bgColor'] == "#EEEEEE") {
                                                    echo 'selected';
                                                } ?>>Mạc Định</option>
                    </select>
                </form>
            </div>
        </div>
    </div>

</div>
@if($truyen->lock_comment == 'N')
<!-- binh lua truyen -->
<div class="card mt-2 px-2 py-2 mb-3">
    <div class="review-truyen mt-3">
        <div class="pb-2">
            <h3 class="title-review"><i class="fas fa-comments"></i> BÌNH LUẬN TRUYỆN 
                <span class="float-right mr-2">(<span id="number_comment">{{ count($binhluan) }}</span>)</span>
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="khung-binh-luan-truyen">
                <div style="position: relative;">
                    <input id="truyen_id" type="text" value="{{ $truyen->id }}" hidden>
                    <input id="user_id" type="text" value="{{ getIdUser() }}" hidden>
                    <input id="truyen_chap" type="text" value="{{ $chuong->numchap }}" hidden>
                    <div class="fream-img" style="width: 75px; float: left; margin-right: 5px;"><img src="{{ checkAvatar() }}" width="65" class="mr-3"></div>
                    <textarea id="truyen_comment_246" class="form-control" rows="2" style="float: left; width: calc(100% - 80px);" placeholder="Bình luận của bạn..." maxlength="{{ tbl_fields['truyen_binhluan']['content'] }}"></textarea>
                    <button id="btn-binh-luan-truyen" class="btn" type="submit" style="position: absolute; right: 5px; top: 5px;"><i class="fas fa-paper-plane" style="font-size: 24px;"></i></button>
                </div>
            </div>
            <div class="cls-comment" style="clear: both;"></div>

            <div class="frame-chua-binh-luan mt-3 overflow-auto" style="max-height: 500px;">
                <ul class="list-unstyled">
                    <!-- start loop -->
                    <div id="append-comment"></div>
                    @foreach($binhluan as $val)
                    <li class="media mb-2 pt-3" style="border-top: 1px solid rgba(0,0,0,.1);">
                        <div class="frame-image-thum position-relative">
                            <img src="{{ getAvatar($val->User->avatar) }}" width="65" class="mr-3 rounded-circle" alt="{{ $val->User->display_name }}">
                            <small class="position-absolute title-level badge badge-success">{{ $val->User->exp_level }}</small>
                        </div>
                        <div class="media-body">
                            <div class="title-name">{{ $val->User->display_name }}
                                <div class="float-right badge badge-success hide-mobile" style="border-radius: 12px;">
                                    <small>{{ $val->User->exp_level }}</small>
                                </div>
                            </div>
                            <small class="text-muted">
                                <i class="far fa-clock"></i> {{ $val->created_at->diffForHumans() }} |
                                <i class="fas fa-glasses"></i> Chương {{ $val->chap }}
                            </small>
                            <p>{{ $val->content }}</p>
                        </div>
                    </li>
                    @endforeach
                    <hr>
                    <!-- end loop -->
                </ul>
            </div>
        </div>
        <div class="col-md-4 hide-mobile">
            <div class="card card-body">
                <h5>NỘI QUI BÌNH LUẬN</h5>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-warning">1</span>
                    Không được chèn link trang khác vào.
                </div>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-success">2</span>
                    Không văng tục trong bình luận.
                </div>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-info">3</span>
                    Nội dung bình luận tối đa 255 ký tự.
                </div>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-secondary">4</span>
                    Không chèn hình vào trong bình luận.
                </div>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-secondary">5</span>
                    Sai qui định quá 5 lần sẽ bị khóa acc.
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end binh luan truyen -->
@endif
<script>
    $(document).ready(function() {
        $("#setting").click(function() {
            $("#popu-father").show();
        });

        $("#span-close-nha").click(function() {
            $("#popu-father").hide();
        });

        $("select.chonFont").change(function() {
            var selectedCountry = $(this).children("option:selected").val();
            $('#content-noi-dung').css("font-family", selectedCountry);
            setCookie("tangkinhcac_fontFam", SetValueCookie(selectedCountry), 365);
        });

        $("select.chonBackGround").change(function() {
            var selectedCountry = $(this).children("option:selected").val();
            $('#body-truyen').css("background", selectedCountry);
            if(selectedCountry.indexOf('skin-default.jpg') != -1){
                $('#body-truyen').css("background-size", "cover");
                $('#body-truyen').css("background-repeat", "no-repeat");
                $('#body-truyen').css("background-attachment", "fixed");
            }
            setCookie("tangkinhcac_bgColor", SetValueCookie(selectedCountry), 365);
        });

        $("select.chonSize").change(function() {
            var selectedCountry = $(this).children("option:selected").val();
            $('#content-noi-dung').css("font-size", selectedCountry);
            setCookie("tangkinhcac_sizeFon", SetValueCookie(selectedCountry), 365);
        });
    });
</script>

<script type="text/javascript">
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function ReturnMyCookie(cname) {
        var x = unescape(getCookie(cname));
        return x;
    }

    function SetValueCookie(value) {
        var str_esc = escape(value);
        return str_esc;
    }

    $(document).ready(function() {
        $('#body-truyen').css("background", ReturnMyCookie("tangkinhcac_bgColor"));
        $('#content-noi-dung').css("font-family", ReturnMyCookie("tangkinhcac_fontFam"));
        $('#content-noi-dung').css("font-size", ReturnMyCookie("tangkinhcac_sizeFon"));
    });
</script>


@endsection
@section('script')
<script type="text/javascript">
    var truyen_id = $('#truyen_id').val();
    var user_id = $('#user_id').val();
    var truyen_chap = $('#truyen_chap').val();
    var truyen_comment = $('#truyen_comment_246').val();
    var _token = '{{ csrf_token() }}';
    var chuong_id = '{{ $chuong->id }}';

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
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
    }

    $('#truyen_comment_246').keyup(function() {
        truyen_comment = $('#truyen_comment_246').val()
    })

    $('#btn-binh-luan-truyen').click(function() {
        var number_cmt = parseInt($('#number_comment').text());

        if (user_id <= 0) {
            toastr.error('Vui lòng <b>đăng nhập</b> để bình luận!', '');
        } else {
            if (truyen_comment.length <= 0) {
                toastr.warning('Vui lòng nhập <b>nội dung</b> bình luận!', '');
            } else {
                $.ajax({
                    url: "{{ route('trangchu.truyen_binh_luan') }}",
                    data: {
                        truyen_id: truyen_id,
                        user_id: user_id,
                        content: truyen_comment,
                        chap: truyen_chap,
                        _token: _token
                    },
                    type: 'post',
                    success: function(data_return) {
                        $('#append-comment').append(data_return);
                        $('#truyen_comment_246').val('');
                        $('#number_comment').text(number_cmt + 1);
                    }
                });
            }
        }
    });

    function checkPostComment() {
        if (!check_post_cmt) {
            return false;
        }

        return true;
    }

    $('#btn-like').click(function() {
        if (user_id <= 0) {
            toastr.error('Vui lòng <b>đăng nhập</b> để like!', '');
        } else {
            $.ajax({
                url: "{{ route('trangchu.post.like_chuong') }}",
                data: {
                    id: chuong_id,
                    _token: _token
                },
                type: 'post',
                success: function() {
                    toastr.success('Cảm ơn đạo hữu đã like chương!', '');
                }
            });
        }
    });
</script>
@endsection