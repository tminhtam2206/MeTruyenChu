<!DOCTYPE html>
<html>

<head>
    <title>Đăng Nhập | Mê Truyện Chữ</title>
    <meta name="robots" content="index, follow">
    <link rel="shortcut icon" href="{{ asset('public/images/logo.png') }}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('public/css/home/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/home/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/jquery-confirm.min.css') }}">
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
                Nếu chưa có tài khoản, vui lòng đăng ký tài khoản mới.
            </p>
        </div>
        <?php if (isset($_COOKIE['error'])) { ?>

        <?php } ?>
        @if(Session::has('error'))
        <div class="alert alert-warning shadow-sm px-2" role="alert">
            {{ Session::get('error') }}
        </div>
        @endif
        <form action="{{ route('login') }}" method="POST" class="mt-2">
            @csrf
            <div class="form-group">
                <div class="col-xs-12">
                    <input type="text" name="name" class="form-control input-1 @error('name') is-invalid @enderror" autocomplete="off" placeholder="Email hoặc tên đăng nhập" maxlength="{{ tbl_fields['user']['email'] }}" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <input type="password" name="password" class="form-control input-1 @error('password') is-invalid @enderror" placeholder="Mật khẩu" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <div class="checkbox checkbox-primary float-left p-t-0">
                        <input id="checkbox-signup" name="remember_me" type="checkbox">
                        <label for="checkbox-signup"> Nhớ mật khẩu </label>
                    </div>
                    <a href="{{ route('trangchu.quenmatkhau') }}" id="to-recover" class="text-dark float-right"> Quên mật khẩu?</a>
                </div>
            </div>

            <div class="form-group text-center m-t-20 mt-2">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light btn-dangnhap">Đăng Nhập</button>
                </div>
            </div>

            <div class="form-group m-b-0">
                <div class="col-sm-12 text-center">
                    <p>Bạn chưa có tài khoản? <a href="{{ route('trangchu.dang_ky') }}" class="text-primary m-l-5"><b>Đăng ký</b></a></p>
                </div>
            </div>
        </form>
    </div>

    <script src="{{ asset('public/js/home/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('public/js/home/popper.min.js') }}"></script>
    <script src="{{ asset('public/js/home/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('public/js/customs_alert.js') }}"></script>
    @if(Session::has('success'))
    <script>
        Alert("{!! Session::get('success') !!}");
    </script>
    @endif
</body>

</html>