<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>@yield('title', '')</title>
	<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('public/images/logo.png') }}" />
	<link rel="shortcut icon" href="{{ asset('public/images/logo.png') }}" />
	<meta name="theme-color" content="#3063A0" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" />
	<link rel="stylesheet" href="{{ asset('public/assets/vendor/open-iconic/css/open-iconic-bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/vendor/flatpickr/flatpickr.min.css') }}">
	@yield('mycss')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/dataTables.css') }}">
	<link rel="stylesheet" href="{{ asset('public/assets/stylesheets/theme.min.css') }}" data-skin="default" />
	<link rel="stylesheet" href="{{ asset('public/assets/stylesheets/theme-dark.min.css') }}" data-skin="dark" />
	<link rel="stylesheet" href="{{ asset('public/assets/stylesheets/custom.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/css/all.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/css/app.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/css/style.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/css/jquery-confirm.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/css/ijaboCropTool.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/css/toastr.min.css') }}" />
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
	<div class="app">
		<header class="app-header app-header-dark">
			<div class="top-bar">
				<div class="top-bar-brand">
					<button class="hamburger hamburger-squeeze mr-2" type="button" data-toggle="aside-menu" aria-label="toggle aside menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
					<a href="{{ route('admin.dashboard') }}">
						<img src="{{ asset('public/images/brand.png') }}" alt="Mê Truyện Chữ">
					</a>
				</div>
				<div class="top-bar-list">
					<div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
						<button class="hamburger hamburger-squeeze" type="button" data-toggle="aside" aria-label="toggle menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
					</div>
					<div class="top-bar-item top-bar-item-full">
						<form class="top-bar-search">
							<div class="input-group input-group-search dropdown">
								<div class="input-group-prepend">
									<span class="input-group-text"><span class="oi oi-magnifying-glass"></span></span>
								</div><input type="text" class="form-control" data-toggle="dropdown" aria-label="Search" placeholder="Tìm chức năng">
								<div class="dropdown-menu dropdown-menu-rich dropdown-menu-xl ml-n4 mw-100">
									<div class="dropdown-arrow ml-3"></div>
									<div class="dropdown-scroll perfect-scrollbar h-auto" style="max-height: 360px">
										<div class="list-group list-group-flush list-group-reflow mb-2">
											<h6 class="list-group-header d-flex justify-content-between">
												<span>Thông thường</span>
											</h6>
											<div class="list-group-item py-2">
												<a href="{{ route('member.dashboard.post') }}" class="stretched-link"></a>
												<div class="tile tile-sm bg-muted">
													<i class="fas fa-paper-plane"></i>
												</div>
												<div class="ml-2">Đăng Truyện</div>
											</div>
											<div class="list-group-item py-2">
												<a href="{{ route('admin.account') }}" class="stretched-link"></a>
												<div class="tile tile-sm bg-muted">
													<i class="fas fa-user"></i>
												</div>
												<div class="ml-2">Tài Khoản</div>
											</div>

											<h6 class="list-group-header d-flex justify-content-between mt-2">
												<span>Chức năng cơ bản</span>
											</h6>
											<div class="list-group-item py-2">
												<a href="{{ route('admin.type_story') }}" class="stretched-link"></a>
												<div class="tile tile-sm bg-muted">
													<i class="fas fa-list"></i>
												</div>
												<div class="ml-2">Thể Loại</div>
											</div>
											<div class="list-group-item py-2">
												<a href="{{ route('admin.users') }}" class="stretched-link"></a>
												<div class="tile tile-sm bg-muted">
													<i class="fas fa-users"></i>
												</div>
												<div class="ml-2">Thành Viên</div>
											</div>
											<div class="list-group-item py-2">
												<a href="{{ route('admin.level') }}" class="stretched-link"></a>
												<div class="tile tile-sm bg-muted">
													<i class="fab fa-galactic-senate"></i>
												</div>
												<div class="ml-2">Hệ Thống EXP</div>
											</div>
											<div class="list-group-item py-2">
												<a href="{{ route('admin.stories') }}" class="stretched-link"></a>
												<div class="tile tile-sm bg-muted">
													<i class="fas fa-layer-group"></i>
												</div>
												<div class="ml-2">Danh Sách Truyện</div>
											</div>

											<h6 class="list-group-header d-flex justify-content-between mt-2">
												<span>Liên hệ & Phản hồi</span>
											</h6>
											<div class="list-group-item py-2">
												<a href="{{ route('admin.contacts') }}" class="stretched-link"></a>
												<div class="tile tile-sm bg-muted">
													<i class="fas fa-id-card"></i>
												</div>
												<div class="ml-2">Liên Hệ</div>
											</div>
											<div class="list-group-item py-2">
												<a href="{{ route('admin.feedbacks') }}" class="stretched-link"></a>
												<div class="tile tile-sm bg-muted">
													<i class="fas fa-comment-alt-smile"></i>
												</div>
												<div class="ml-2">Phản Hồi</div>
											</div>

											<h6 class="list-group-header d-flex justify-content-between mt-2">
												<span>Chính sách & Điều khoản</span>
											</h6>
											<div class="list-group-item py-2">
												<a href="{{ route('admin.policy') }}" class="stretched-link"></a>
												<div class="tile tile-sm bg-muted">
													<i class="fas fa-user-shield"></i>
												</div>
												<div class="ml-2">Chính Sách Bảo Mật</div>
											</div>
											<div class="list-group-item py-2">
												<a href="{{ route('admin.rules') }}" class="stretched-link"></a>
												<div class="tile tile-sm bg-muted">
													<i class="fas fa-pencil-ruler"></i>
												</div>
												<div class="ml-2">Điều Khoản Dịch Vụ</div>
											</div>
											<div class="list-group-item py-2">
												<a href="{{ route('admin.instruct') }}" class="stretched-link"></a>
												<div class="tile tile-sm bg-muted">
													<i class="fas fa-chalkboard-teacher"></i>
												</div>
												<div class="ml-2">Hướng Dẫn Websites</div>
											</div>

											<h6 class="list-group-header d-flex justify-content-between mt-2">
												<span>Hệ thống nâng cao</span>
											</h6>
											<div class="list-group-item py-2">
												<a href="https://app.infinityfree.net/login" class="stretched-link" target="_blank"></a>
												<div class="tile tile-sm bg-muted">
													<i class="fas fa-server"></i>
												</div>
												<div class="ml-2">Máy Chủ</div>
											</div>
											<div class="list-group-item py-2">
												<a href="https://cpanel.epizy.com/panel/indexpl.php?option=mysql&ttt=-7765989971350756480" class="stretched-link" target="_blank"></a>
												<div class="tile tile-sm bg-muted">
													<i class="fas fa-database"></i>
												</div>
												<div class="ml-2">Cơ Sở Dữ Liệu</div>
											</div>
											<div class="list-group-item py-2">
												<a href="#" class="stretched-link"></a>
												<div class="tile tile-sm bg-muted">
													<i class="fas fa-cogs"></i>
												</div>
												<div class="ml-2">Cấu Hình Hệ Thống</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
						<ul class="header-nav nav">
							<li id="check-show-icon" class="nav-item dropdown header-nav-dropdown @if(getSoThongBaoMoi() > 0) has-notified @endif">
								<a id="icon-thong-bao" class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="oi oi-pulse"></span>
								</a>
								<div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
									<div class="dropdown-arrow"></div>
									<h6 class="dropdown-header stop-propagation">
										<span>Thông Báo <span class="badge">({{ getSoThongBaoMoi() }})</span></span>
										<small id="" style="cursor: pointer;">Đánh dấu đã đọc</small>
									</h6>
									<div class="dropdown-scroll perfect-scrollbar">
										@foreach(getThongBao() as $val)
										<a href="{{ $val->content }}" class="dropdown-item unread">
											<div class="tile tile-circle tile-lg"><i class="fas fa-bell"></i></div>
											<div class="dropdown-item-body">
												<p class="text">{{ $val->title }}</p>
												<span class="date">{{ $val->created_at->diffForHumans() }}</span>
											</div>
										</a>
										@endforeach
									</div>
								</div>
							</li>
							<!-- <li class="nav-item dropdown header-nav-dropdown has-notified">
								<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="oi oi-envelope-open"></span></a>
								<div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
									<div class="dropdown-arrow"></div>
									<h6 class="dropdown-header stop-propagation">
										<span>Tin Nhắn</span><a href="#">Tất cả</a>
									</h6>
									<div class="dropdown-scroll perfect-scrollbar">
										<a href="#" class="dropdown-item unread">
											<div class="user-avatar">
												<img src="assets/images/avatars/team1.jpg" alt="">
											</div>
											<div class="dropdown-item-body">
												<p class="subject">Stilearning</p>
												<p class="text text-truncate">Invitation: Joe's Dinner @ Fri Aug 22</p><span class="date">2 hours ago</span>
											</div>
										</a>
									</div>
								</div>
							</li> -->
							<li class="nav-item dropdown header-nav-dropdown">
								<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="oi oi-grid-three-up"></span></a>
								<div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
									<div class="dropdown-arrow"></div>
									<div class="dropdown-sheets">
										<div class="dropdown-sheet-item">
											<a href="{{ route('trangchu') }}" class="tile-wrapper" target="_blank">
												<span class="tile tile-lg bg-indigo"><i class="fas fa-home"></i></span>
												<span class="tile-peek">Trang chủ</span>
											</a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('admin.account') }}" class="tile-wrapper">
												<span class="tile tile-lg bg-teal"><i class="fas fa-user"></i></span>
												<span class="tile-peek">Tài khoản</span>
											</a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('admin.type_story') }}" class="tile-wrapper">
												<span class="tile tile-lg bg-pink"><i class="fa fa-list"></i></span>
												<span class="tile-peek">Thể loại</span>
											</a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('admin.users') }}" class="tile-wrapper">
												<span class="tile tile-lg bg-yellow"><i class="fas fa-users"></i></span>
												<span class="tile-peek">Thành viên</span>
											</a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('admin.level') }}" class="tile-wrapper">
												<span class="tile tile-lg bg-cyan"><i class="fab fa-galactic-senate"></i></span>
												<span class="tile-peek">Cảnh giới</span>
											</a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('admin.stories') }}" class="tile-wrapper">
												<span class="tile tile-lg bg-cyan"><i class="fas fa-layer-group"></i></span>
												<span class="tile-peek">DS Truyện</span>
											</a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('admin.policy') }}" class="tile-wrapper">
												<span class="tile tile-lg bg-cyan"><i class="fas fa-user-shield"></i></span>
												<span class="tile-peek">Chính sách</span>
											</a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('admin.rules') }}" class="tile-wrapper">
												<span class="tile tile-lg bg-cyan"><i class="fas fa-pencil-ruler"></i></span>
												<span class="tile-peek">Điều khoản</span>
											</a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('admin.instruct') }}" class="tile-wrapper">
												<span class="tile tile-lg bg-cyan"><i class="fas fa-chalkboard-teacher"></i></span>
												<span class="tile-peek">Hướng dẫn</span>
											</a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('member.dashboard') }}" class="tile-wrapper" target="_blank">
												<span class="tile tile-lg bg-cyan"><i class="fas fa-user-tag"></i></span>
												<span class="tile-peek">Quyền TV</span>
											</a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('mod.dashboard') }}" class="tile-wrapper" target="_blank">
												<span class="tile tile-lg bg-cyan"><i class="fas fa-user-tag"></i></span>
												<span class="tile-peek">Quyền CS</span>
											</a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('admin.config_system') }}" class="tile-wrapper">
												<span class="tile tile-lg bg-cyan"><i class="fas fa-cogs"></i></span>
												<span class="tile-peek">Cấu hình</span>
											</a>
										</div>
									</div>
								</div>
							</li>
						</ul>
						<div class="dropdown d-flex">
							<button class="btn-account d-none d-md-flex" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="user-avatar user-avatar-md">
									<img class="userPicture" src="{{ getAvatar(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
								</span>
								<span class="account-summary pr-lg-4 d-none d-lg-block">
									<span class="account-name">{{ Auth::user()->display_name }}</span>
									<span class="account-description">@if(Auth::user()->role == 'admin') Thánh Chủ @elseif(Auth::user()->role == 'mod') Chấp Sự @else Thành Viên @endif</span>
								</span>
							</button>
							<div class="dropdown-menu">
								<div class="dropdown-arrow ml-3"></div>
								<h6 class="dropdown-header d-none d-md-block d-lg-none">{{ Auth::user()->display_name }}</h6>
								<a class="dropdown-item" href="{{ route('admin.account') }}"><span class="dropdown-icon oi oi-person"></span> Hồ Sơ Cá Nhân</a>
								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="dropdown-icon oi oi-account-logout"></span> Đăng Xuất</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#"><i class="fas fa-user-headset"></i> Trung Tâm Hỗ Trợ</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<aside class="app-aside app-aside-expand-md app-aside-light">
			<div class="aside-content">
				<header class="aside-header d-block d-md-none">
					<button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside">
						<span class="user-avatar user-avatar-lg">
							<img class="userPicture" src="{{ getAvatar(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
						</span>
						<span class="account-icon"><span class="fa fa-caret-down fa-lg"></span></span>
						<span class="account-summary"><span class="account-name">{{ Auth::user()->display_name }}</span>
							<span class="account-description">@if(Auth::user()->role == 'admin') Thánh Chủ @elseif(Auth::user()->role == 'mod') Chấp Sự @else Thành Viên @endif</span></span></button>
					<div id="dropdown-aside" class="dropdown-aside collapse">
						<div class="pb-3">
							<a class="dropdown-item" href="{{ route('admin.account') }}"><span class="dropdown-icon oi oi-person"></span> Hồ Sơ Cá Nhân</a>
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="dropdown-icon oi oi-account-logout"></span> Đăng Xuất</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#"><i class="fas fa-user-headset"></i> Trung Tâm Hỗ Trợ</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</div>
					</div>
				</header>
				<div class="aside-menu overflow-hidden">
					<nav id="stacked-menu" class="stacked-menu">
						<ul class="menu">
							<li class="menu-item">
								<a href="{{ route('admin.dashboard') }}" class="menu-link {{ hasActive('admin/dashboard') }}">
									<span class="menu-icon fas fa-tachometer-alt"></span>
									<span class="menu-text">Bảng Điều Khiển</span>
								</a>
							</li>
							<li class="menu-item has-child {{ ActiveLink2('account', 'has-open') }}">
								<a href="#" class="menu-link">
									<span class="menu-icon oi oi-person"></span>
									<span class="menu-text">Tài Khoản</span>
								</a>
								<ul class="menu">
									<li class="menu-item">
										<a href="{{ route('admin.account') }}" class="menu-link {{ hasActive('admin/account') }}">
											<i class="fab fa-old-republic"></i> Tổng Quan
										</a>
									</li>
									<li class="menu-item">
										<a href="{{ route('admin.account.diary') }}" class="menu-link {{ hasActive('admin/account/diary') }}">
											<i class="fas fa-user-clock"></i> Hoạt Động
										</a>
									</li>
									<li class="menu-item">
										<a href="{{ route('admin.account.comment') }}" class="menu-link {{ hasActive('admin/account/comment') }}">
											<i class="fas fa-comments"></i> Bình Luận
										</a>
									</li>
									<li class="menu-item">
										<a href="{{ route('admin.account.setting') }}" class="menu-link {{ ActiveLink('admin/account/setting', 'has-active') }}">
											<i class="fas fa-user-cog"></i> Thiết Lập
										</a>
									</li>
								</ul>
							</li>
							<li class="menu-header">Chức Năng Cơ Bản</li>
							<li class="menu-item">
								<a href="{{ route('admin.type_story') }}" class="menu-link {{ hasActive('admin/type-story') }}">
									<span class="menu-icon fas fa-list"></span>
									<span class="menu-text">Thể Loại</span>
								</a>
							</li>
							<li class="menu-item">
								<a href="{{ route('admin.users') }}" class="menu-link {{ hasActive('admin/users') }}">
									<span class="menu-icon fas fa-users"></span>
									<span class="menu-text">Thành Viên</span>
								</a>
							</li>
							<li class="menu-item">
								<a href="{{ route('admin.level') }}" class="menu-link {{ hasActive('admin/level') }}">
									<span class="menu-icon fab fa-galactic-senate"></span>
									<span class="menu-text">Hệ Thống EXP</span>
								</a>
							</li>
							<li class="menu-item">
								<a href="{{ route('admin.stories') }}" class="menu-link {{ hasActive('admin/stories') }}">
									<span class="menu-icon fas fa-layer-group"></span>
									<span class="menu-text">Danh Sách Truyện</span>
								</a>
							</li>

							<li class="menu-header">Liên Hệ & Phản Hồi</li>
							<li class="menu-item">
								<a href="{{ route('admin.contacts') }}" class="menu-link {{ hasActive('admin/contacts') }}">
									<span class="menu-icon fas fa-id-card"></span>
									<span class="menu-text">Liên Hệ</span>
								</a>
							</li>
							<li class="menu-item">
								<a href="{{ route('admin.feedbacks') }}" class="menu-link {{ hasActive('admin/feedbacks') }}">
									<span class="menu-icon fas fa-comment-alt-smile"></span>
									<span class="menu-text">Phản Hồi</span>
								</a>
							</li>

							<li class="menu-header">Chính Sách & Điều Khoản</li>
							<li class="menu-item">
								<a href="{{ route('admin.policy') }}" class="menu-link {{ ActiveLink('admin/policy', 'has-active') }}">
									<span class="menu-icon fas fa-user-shield"></span>
									<span class="menu-text">Chính Sách Bảo Mật</span>
								</a>
							</li>
							<li class="menu-item">
								<a href="{{ route('admin.rules') }}" class="menu-link {{ ActiveLink('admin/rules', 'has-active') }}">
									<span class="menu-icon fas fa-pencil-ruler"></span>
									<span class="menu-text">Điều Khoản Dịch Vụ</span>
								</a>
							</li>
							<li class="menu-item">
								<a href="{{ route('admin.instruct') }}" class="menu-link {{ ActiveLink('admin/instruct', 'has-active') }}">
									<span class="menu-icon fas fa-chalkboard-teacher"></span>
									<span class="menu-text">Hướng Dẫn Websites</span>
								</a>
							</li>

							<li class="menu-header">Hệ Thống Nâng Cao</li>
							<li class="menu-item">
								<a href="https://app.infinityfree.net/login" class="menu-link" target="_blank">
									<span class="menu-icon fas fa-server"></span>
									<span class="menu-text">Máy Chủ</span>
								</a>
							</li>
							<li class="menu-item">
								<a href="https://cpanel.epizy.com/panel/indexpl.php?option=mysql&ttt=-7765989971350756480" class="menu-link" target="_blank">
									<span class="menu-icon fas fa-database"></span>
									<span class="menu-text">Cơ Sở Dữ Liệu</span>
								</a>
							</li>
							<li class="menu-item">
								<a href="{{ route('admin.config_system') }}" class="menu-link {{ ActiveLink('admin/config-system', 'has-active') }}">
									<span class="menu-icon fas fa-cogs"></span>
									<span class="menu-text">Cấu Hình Hệ Thống</span>
								</a>
							</li>
						</ul>
					</nav>
				</div>
				<footer class="aside-footer border-top p-2">
					<div class="text-light text-center">{{ app_version }}</div>
				</footer>
			</div>
		</aside>
		<main class="app-main">
			<div class="wrapper">
				@yield('content')
			</div>
			<footer class="app-footer">
				<ul class="list-inline">
					<li class="list-inline-item">
						<a class="text-muted" href="#">Trung Tâm Hỗ Trợ</a>
					</li>
					<li class="list-inline-item">
						<a class="text-muted" href="{{ route('trangchu.chinhsach') }}">Chính Sách Bảo Mật</a>
					</li>
					<li class="list-inline-item">
						<a class="text-muted" href="{{ route('trangchu.dieukhoan') }}">Điều Khoản Dịch Vụ</a>
					</li>
				</ul>
				<div class="copyright">Copyright © <?php echo date('Y'); ?>. All right reserved.</div>
			</footer>
		</main>
	</div>
	<script src="{{ asset('public/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ asset('public/assets/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('public/assets/vendor/popper.js/umd/popper.min.js') }}"></script>
	<script src="{{ asset('public/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/assets/vendor/pace-progress/pace.min.js') }}"></script>
	<script src="{{ asset('public/assets/vendor/stacked-menu/js/stacked-menu.min.js') }}"></script>
	<script src="{{ asset('public/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
	<script src="{{ asset('public/assets/vendor/flatpickr/flatpickr.min.js') }}"></script>
	<script src="{{ asset('public/assets/vendor/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
	<script src="{{ asset('public/assets/javascript/theme.min.js') }}"></script>
	@yield('script2')
	<script src="{{ asset('public/js/jquery-confirm.min.js') }}"></script>
	<script src="{{ asset('public/js/customs_alert.js') }}"></script>
	<script src="{{ asset('public/js/ijaboCropTool.min.js') }}"></script>
	<script src="{{ asset('public/js/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('public/js/toastr.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('#dataTable').DataTable({
				language: {
					url: "{{ asset('public/js/vi.json') }}"
				},
				"bSort": false
			});
		});
	</script>
	@yield('script')
	<script>
		$('#icon-thong-bao').click(function() {
			$.ajax({
				url: "{{ route('member.update.notify') }}",
				data: {},
				type: 'get',
				success: function() {
					$('#check-show-icon').removeClass('has-notified');
				}
			});
		});
	</script>
	{!! Toastr::message() !!}
</body>

</html>