<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title', '') | Mê Truyện Chữ</title>
    <link rel="shortcut icon" href="{{ asset('public/images/logo.png') }}" type="image/png">
    <meta name="theme-color" content="#3063A0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" />
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/open-iconic/css/open-iconic-bootstrap.min.cs') }}s" />
    <link rel="stylesheet" href="{{ asset('public/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/flatpickr/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/stylesheets/theme.min.css') }}" data-skin="default" />
    <link rel="stylesheet" href="{{ asset('public/assets/stylesheets/theme-dark.min.css') }}" data-skin="dark" />
    <link rel="stylesheet" href="{{ asset('public/assets/stylesheets/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/emojionearea-master/dist/emojionearea.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/forum.css') }}" />
    @yield('css')
    <script>
        var skin = localStorage.getItem('skin') || 'default';
        var isCompact = JSON.parse(localStorage.getItem('hasCompactMenu'));
        var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
        disabledSkinStylesheet.setAttribute('rel', '');
        disabledSkinStylesheet.setAttribute('disabled', true);
        if (isCompact == true) document.querySelector('html').classList.add('preparing-compact-menu');
    </script>
</head>

<body>
    <div class="app has-fullwidth">
        <header class="app-header app-header-dark">
            <nav class="navbar navbar-expand-lg bg-dark-2 py-lg-0">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('trangchu') }}">
                        <img src="{{ asset('public/images/brand.png') }}" alt="Mê Truyện Chữ">
                    </a>
                    <button class="hamburger hamburger-squeeze d-flex d-lg-none" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('forum.index') }}">Diễn Đàn <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Thẻ Tag</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('forum.dangbai') }}"><i class="far fa-edit"></i></a>
                            </li>
                        </ul>
                        <form class="top-bar-search d-lg-inline-block w-auto my-2 my-lg-0 px-0 px-lg-2">
                            <div class="input-group input-group-search">
                                <input class="form-control" type="search" placeholder="Tìm kiếm..." aria-label="Search" autocomplete="off">
                            </div>
                        </form>
                        @guest
                        <div class="navbar-nav dropdown d-flex mr-lg-n3">
                            <a href="{{ route('trangchu.dang_nhap') }}" class="btn-account w-100">
                                <span class="user-avatar user-avatar-md mr-lg-0">
                                    <img src="{{ asset('public/images/default-avatar.jpeg') }}" alt="user">
                                </span>
                                <span class="account-summary d-lg-none">
                                    <span class="account-name">Tài khoản</span>
                                    <span class="account-description">Đăng nhập</span>
                                </span>
                            </a>
                        </div>
                        @else
                        <div class="navbar-nav dropdown d-flex mr-lg-n3">
                            <button class="btn-account w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="user-avatar user-avatar-md mr-lg-0">
                                    <img src="{{ getAvatar(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                                </span>
                                <span class="account-summary d-lg-none">
                                    <span class="account-name">{{ Auth::user()->name }}</span>
                                    <span class="account-description text-capitalize">{{ Auth::user()->role }}</span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-arrow mr-3"></div>
                                <h6 class="dropdown-header d-none d-lg-block d-lg-none">{{ Auth::user()->name }}</h6>
                                @if(Auth::user()->role == 'admin')
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}"><span class="dropdown-icon oi oi-person"></span> Tài khoản</a>
                                @elseif(Auth::user()->role == 'mod')
                                <a class="dropdown-item" href="#"><span class="dropdown-icon oi oi-person"></span> Tài khoản</a>
                                @else
                                <a class="dropdown-item" href="{{ route('member.dashboard') }}"><span class="dropdown-icon oi oi-person"></span> Tài khoản</a>
                                @endif
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="dropdown-icon oi oi-account-logout"></span> Đăng xuất
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        @endguest
                    </div>
                </div>
            </nav>
        </header>
        <main class="app-main">
            <div class="wrapper">
                <div class="page">
                    @yield('content')
                </div>
            </div>
            <footer class="app-footer">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">Trung Tâm Trợ Giúp</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="{{ route('trangchu.chinhsach') }}">Chính Sách Bảo Mật</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="{{ route('trangchu.dieukhoan') }}">Điều Khoản Dịch Vụ</a>
                    </li>
                </ul>
                <div class="copyright">Copyright © @php echo date('Y') @endphp. All right reserved.</div>
            </footer>
        </main>
    </div>
    <script src="{{ asset('public/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/pace-progress/pace.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/stacked-menu/js/stacked-menu.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('public/assets/javascript/theme.min.js') }}"></script>
    <script src="{{ asset('public/assets/javascript/pages/dashboard-demo.js') }}"></script>
    <script src="{{ asset('public/emojionearea-master/dist/emojionearea.min.js') }}"></script>
    @yield('script')
</body>

</html>