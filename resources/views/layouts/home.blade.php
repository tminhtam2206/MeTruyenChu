<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('seo')
    <link rel="stylesheet" href="{{ asset('public/css/home/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/home/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/home/jquery-confirm.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('public/images/logo.png') }}" type="image/png">
    <meta name="description" content="Mê Truyện Chữ, Web đọc truyện miễn phí. metruyenchu.epizy.com" />
    <link rel="canonical" href="http://metruyenchu.epizy.com/" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Mê Truyện Chữ, Web đọc truyện miễn phí. metruyenchu.epizy.com" />
    <meta property="og:site_name" content="metruyenchu.epizy.com" />
    <meta property="og:url" content="http://metruyenchu.epizy.com/" />
    <meta property="og:locale" content="vi_VN" />
    <title>@yield('title')</title>
    <!-- font chu -->
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:ital,wght@0,300;0,700;1,300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;1,100;1,200;1,300;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=David+Libre:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pridi|Roboto" rel="stylesheet">
    <script src="{{ asset('public/js/jquery-3.5.1.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('public/css/toastr.min.css') }}">
    <meta name="google-site-verification" content="cp6CUHz97VVZrDP7a4-kgFVIp-pccUSzKYi-iNom3Mw" />
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-W5LS5TR');
    </script>
    <script type='text/javascript'>
        setInterval(function() {
            debugger;
        }, 1)
    </script>
    <!-- End Google Tag Manager -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NGH4XSQJ57"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-NGH4XSQJ57');
    </script>
    <script type="text/JavaScript">
        var message="NoRightClicking"; function defeatIE() {if (document.all) {(message);return false;}} function defeatNS(e) {if (document.layers||(document.getElementById&&!document.all)) { if (e.which==2||e.which==3) {(message);return false;}}} if (document.layers) {document.captureEvents(Event.MOUSEDOWN);document.onmousedown=defeatNS;} else{document.onmouseup=defeatNS;document.oncontextmenu=defeatIE;} document.oncontextmenu=new Function("return false") 
</script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
        document.onkeydown = function(e) {
            if (e.ctrlKey &&
                (e.keyCode === 67 ||
                    e.keyCode === 86 ||
                    e.keyCode === 85 ||
                    e.keyCode === 117)) {
                return false;
            } else {
                return true;
            }
        };
        $(document).keypress("u", function(e) {
            if (e.ctrlKey) {
                return false;
            } else {
                return true;
            }
        });
    </script>
</head>

<body>
    <div class="container px-0 py-0">
        <header>
            <img class="gif-header" src="{{ asset('public/images/tien-hiep-1.jpeg') }}">
            <div class="header-title">
                <a class="header-link-video" href="{{ env('APP_URL') }}">Mê Truyện Chữ</a>
                <p class="header-video-title animate__animated animate__bounce">nơi chia sẽ truyện miễn phí</p>
            </div>
        </header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-black my-nav font-roman">
            <a class="navbar-brand font-robo my-1 an-item" href="{{ env('APP_URL') }}">
                mê truyện <span class="ah-tls">chữ</span>
            </a>
            <a class="navbar-brand font-robo my-1 dung-laptop" href="{{ env('APP_URL') }}">
                <span class="ah-tls">MTC</span>
            </a>
            <div class="form-search-my-custom">
                <!-- start hiện khi dùng điện thoại -->
                <form class="search-box-mobile dung-laptop" method="GET" action="{{ route('trangchu.tim_kiem') }}" style="position: relative;">
                    <input class="search-txb-mobile" type="text" name="key" placeholder="Tìm truyện..." maxlength="40" autocomplete="off">
                    <span style="position: absolute; right: 8px; top: 3px;"><i class="fas fa-search"></i></span>
                </form>
                <!-- end hiện khi dùng điện thoại -->
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('trangchu.truyen_hot') }}"><i class="fab fa-hotjar"></i> Truyện HOT <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('trangchu.loai_truyen', ['name'=>'Truyện Dịch']) }}"><i class="fad fa-language"></i> Truyện Dịch</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('trangchu.loai_truyen', ['name'=>'Truyện Convert']) }}"><i class="fab fa-alipay"></i> Truyện Convert</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('trangchu.loai_truyen', ['name'=>'Sáng Tác']) }}"><i class="fas fa-pen-nib"></i> Sáng Tác</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-bars"></i> Thể Loại
                        </a>
                        <div class="dropdown-menu sub-menu-1 pb-0" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item nav-sub-menu" href="{{ route('trangchu.truyen_the_loai', ['name_slug'=>'tien-hiep']) }}"><i class="fab fa-phoenix-squadron fa-fw"></i> Tiên Hiệp</a>
                            <a class="dropdown-item nav-sub-menu" href="{{ route('trangchu.truyen_the_loai', ['name_slug'=>'huyen-huyen']) }}"><i class="fab fa-phoenix-framework fa-fw"></i> Huyền Huyễn</a>
                            <a class="dropdown-item nav-sub-menu" href="{{ route('trangchu.truyen_the_loai', ['name_slug'=>'trung-sinh']) }}"><i class="fas fa-history fa-fw"></i> Trùng Sinh</a>
                            <a class="dropdown-item nav-sub-menu" href="{{ route('trangchu.the_loai') }}"><i class="far fa-ellipsis-h fa-fw"></i> Xem Thêm</a>
                        </div>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fab fa-fort-awesome"></i> Diễn Đàn
                        </a>
                    </li> -->
                    <!-- start hiện khi dùng điện thoại -->
                    @guest
                    <li class="nav-item dung-laptop">
                        <a class="nav-link" href="{{ route('trangchu.dang_nhap') }}"><i class="fas fa-sign-in-alt"></i> Đăng Nhập</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('trangchu.tu_sach') }}"><i class="fad fa-books"></i> Tủ Sách</a>
                    </li>
                    @if(Auth::user()->role == 'admin')
                    <li class="nav-item dung-laptop">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-user-alt"></i> Tài Khoản</a>
                    </li>
                    @elseif(Auth::user()->role == 'mod')
                    <li class="nav-item dung-laptop">
                        <a class="nav-link" href="{{ route('mod.dashboard') }}"><i class="fas fa-user-alt"></i> Tài Khoản</a>
                    </li>
                    @else
                    <li class="nav-item dung-laptop">
                        <a class="nav-link" href="{{ route('member.dashboard') }}"><i class="fas fa-user-alt"></i> Tài Khoản</a>
                    </li>
                    @endif
                    @endguest
                    <!-- end hiện khi dùng điện thoại -->
                </ul>
                <div class="float-right text-light the-chua an-item">
                    <form class="search-box" method="GET" action="{{ route('trangchu.tim_kiem') }}">
                        <input class="search-txb" type="text" name="key" placeholder="Tìm truyện..." autocomplete="off">
                        <button id="icon-search" class="search-btn"><i class="far fa-search"></i></button>
                    </form>
                    @guest
                    <a class="btn btn-sm btn-primary rounded-circle" href="{{ route('trangchu.dang_nhap') }}"><i class="fas fa-user"></i></a>
                    @else
                    @if(Auth::user()->role == 'admin')
                    <a class="btn btn-sm btn-primary rounded-circle" href="{{ route('admin.dashboard') }}"><i class="fas fa-user"></i></a>
                    @elseif(Auth::user()->role == 'mod')
                    <a class="btn btn-sm btn-primary rounded-circle" href="{{ route('mod.dashboard') }}"><i class="fas fa-user"></i></a>
                    @else
                    <a class="btn btn-sm btn-primary rounded-circle" href="{{ route('member.dashboard') }}"><i class="fas fa-user"></i></a>
                    @endif
                    @endguest
                </div>
            </div>
        </nav>
        <div id="content-main" class="container-fluid mt-3 py-1 px-0">
            @yield('content')
        </div>
        <!-- nội dung footer -->
        <div class="container bg-toi text-light my-footer">
            <footer class="font-display">
                <div class="row footer-top">
                    <div class="col-md-3 mb-2">
                        <h3 class="text-center title-footer"> Mê Truyện Chữ</h3>
                        <p class="text-justify">
                            Đọc truyện online, đọc truyện chữ, truyện hay. Website luôn cập nhật những bộ truyện mới thuộc các thể loại đặc sắc như truyện tiên hiệp, truyện kiếm hiệp, hay truyện ngôn tình một cách nhanh nhất.
                        </p>
                    </div>
                    <div class="col-md-3">
                        <h3 class="text-center title-footer"><i class="fas fa-link"></i> Liên Kết</h3>
                        <ul class="ul">
                            <li><a class="footer-contact-mini" href="{{ route('trangchu.dieukhoan') }}"><i class="fas fa-pencil-ruler"></i> Điều Khoảng Dịch Vụ</a></li>
                            <li><a class="footer-contact-mini" href="{{ route('trangchu.chinhsach') }}"><i class="fas fa-user-shield"></i> Chính Sách Bảo Mật</a></li>
                            <li><a class="footer-contact-mini" href="{{ route('trangchu.phanhoi') }}"><i class="fas fa-comment-alt-smile"></i> Phản Hồi Chúng Tôi</a></li>
                            <li><a class="footer-contact-mini" href="{{ route('trangchu.lienhe') }}"><i class="fas fa-user-headset"></i> Liên Hệ Với Chúng Tôi</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h3 class="text-center title-footer"><i class="fas fa-tags"></i> Tag</h3>
                        <ul class="ul">
                            <li><a class="footer-contact-mini" href="{{ route('trangchu.truyen_the_loai', ['name_slug'=>'tien-hiep']) }}"><i class="fab fa-d-and-d fa-lg"></i> Tiên Hiệp</a></li>
                            <li><a class="footer-contact-mini" href="{{ route('trangchu.truyen_the_loai', ['name_slug'=>'huyen-huyen']) }}"><i class="fas fa-dragon fa-lg"></i> Huyền Huyễn</a></li>
                            <li><a class="footer-contact-mini" href="{{ route('trangchu.truyen_the_loai', ['name_slug'=>'kiem-hiep']) }}"><i class="far fa-swords fa-lg"></i> Kiếm Hiệp</a></li>
                            <li><a class="footer-contact-mini" href="{{ route('trangchu.truyen_the_loai', ['name_slug'=>'ngon-tinh']) }}"><i class="fas fa-flower-tulip fa-lg"></i> Ngôn Tình</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h3 class="text-center title-footer"><i class="fas fa-id-card"></i> Kết Nối</h3>
                        <ul class="ul">
                            <li><a class="footer-contact-mini" href="mailto: minhtuan.it99@gmail.com"><i class="fas fa-envelope fa-lg"></i> MinhTuan.IT99@gmail.com</a></li>
                            <li><a class="footer-contact-mini" href="tel:0333894499"><i class="fas fa-phone-alt fa-lg"></i> 033 389 4499</a></li>
                            <li><a class="footer-contact-mini" href="#"><i class="fab fa-facebook-square fa-lg"></i> Facebook.com/minhtuan</a></li>
                            <li><a class="footer-contact-mini" href="#"><i class="fab fa-google-plus-square fa-lg"></i> Google.com/minhtuan</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row footer-bottom bg-black">
                    <div class="col-md-6 my-footer-bootom-left" style="line-height: 40px;">Copyright &copy; 2019-<?php echo date("Y"); ?> | All Rights Reserved</div>
                    <div class="col-md-6 my-footer-bootom-right">
                        <ul class="ul-footer-bottom-right">
                            <li><a href="#"><i class="fab fa-facebook-square fa-2x"></i></a></li>
                            <li><a href="https://www.youtube.com/channel/UC6GTNdMR15WfS43H2b72Rig?view_as=subscriber"><i class="fab fa-youtube fa-2x"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter-square fa-2x"></i></a></li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end nội dung footer -->
    </div>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W5LS5TR" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <script src="{{ asset('public/js/home/popper.min.js') }}"></script>
    <script src="{{ asset('public/js/home/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/home/main.js') }}"></script>
    <script src="{{ asset('public/js/home/my-calasoul.js') }}"></script>
    <script src="{{ asset('public/js/home/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('public/js/toastr.min.js') }}"></script>
    {!! Toastr::message() !!}

    @yield('script')
</body>

</html>