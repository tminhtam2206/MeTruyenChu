<!DOCTYPE html>
<html>

<head>
    <title>Đăng Ký | Mê Truyện Chữh</title>
    <meta name="robots" content="index, follow">
    <link rel="shortcut icon" href="{{ asset('public/images/logo.png') }}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('public/css/home/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/home/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/home/style_login-2.css') }}">
    <meta name="description" content="Mê Truyện Chữ, Web đọc truyện miễn phí. metruyenchu.epizy.com" />
    <link rel="canonical" href="http://metruyenchu.epizy.com/" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Mê Truyện Chữ, Web đọc truyện miễn phí. metruyenchu.epizy.com" />
    <meta property="og:site_name" content="metruyenchu.epizy.com" />
    <meta property="og:url" content="http://metruyenchu.epizy.com/" />
    <meta property="og:locale" content="vi_VN" />
</head>

<body style="background-image: url({{ asset('public/images/tien2.jpg') }})">
    <div class="form-login px-3 shadow-sm">
        <div class="temp"></div>
        <div class="frame-img">
            <a href="{{ env('APP_URL') }}">
                <img src="{{ asset('public/images/logo-4.png') }}">
            </a>
        </div>
        <div class="notice mt-2">
            <p class="text-muted">
                Nếu bạn đã có tài khoản, vui lòng nhấn vào đăng nhập.
            </p>
        </div>
        <?php if (isset($_COOKIE['error_message'])) { ?>
            <div class="alert alert-warning shadow-sm px-2" role="alert">
                <?php echo $_COOKIE['error_message']; ?>
            </div>
        <?php } ?>
        <form action="{{ route('register') }}" method="POST" class="mt-2">
            @csrf
            <div class="form-group">
                <div class="col-xs-12">
                    <input type="text" name="name" class="form-control input-1 @error('name') is-invalid @enderror" placeholder="Tên đăng nhập" maxlength="{{ tbl_fields['user']['name'] }}" autocomplete="off" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input type="email" name="email" class="form-control input-1 @error('email') is-invalid @enderror" placeholder="Địa chỉ email" maxlength="{{ tbl_fields['user']['email'] }}" autocomplete="off" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <input type="password" name="password" class="form-control input-1 @error('password') is-invalid @enderror" minlength="8" placeholder="Mật khẩu" maxlength="{{ tbl_fields['user']['password'] }}" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input type="password" name="password_confirmation" class="form-control input-1" minlength="8" placeholder="Nhập lại mật khẩu" maxlength="{{ tbl_fields['user']['password'] }}" required>
                </div>
            </div>
            <div class="form-group form-check">
                <div class="col-xs-12">
                    <input type="checkbox" class="form-check-input" id="check_input">
                    <label class="form-check-label" for="check_input" style="cursor: pointer;">Tôi đồng ý với 
                        <a href="{{ route('trangchu.dieukhoan') }}" target="blank">Điều Khoản</a> &
                        <a href="{{ route('trangchu.chinhsach') }}" target="blank">Dịch vụ</a> trên.
                    </label>
                </div>
            </div>

            <div class="form-group text-center m-t-20 mt-2">
                <div class="col-xs-12">
                    <button id="btn-submit" type="submit" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light btn-dangnhap" disabled>Đăng Ký</button>
                </div>
            </div>

            <div class="form-group m-b-0">
                <div class="col-sm-12 text-center">
                    <p>Bạn đã tài khoản? <a href="{{ route('trangchu.dang_nhap') }}" class="text-primary m-l-5"><b>Đăng Nhập</b></a></p>
                </div>
            </div>
        </form>
    </div>

    <script src="{{ asset('public/js/home/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('public/js/home/popper.min.js') }}"></script>
    <script src="{{ asset('public/js/home/bootstrap.min.js') }}"></script>
    <script>
        $('#check_input').click(function(){
            var item = $(this).is(":checked");
            
            if(item == true){
                $('#btn-submit').attr("disabled", false);
            }else{
                $('#btn-submit').attr("disabled", true);
            }
        });
    </script>
</body>

</html>