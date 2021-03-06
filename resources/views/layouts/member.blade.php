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
	<link rel="stylesheet" href="{{ asset('public/assets/stylesheets/theme.min.css') }}" data-skin="default" />
	<link rel="stylesheet" href="{{ asset('public/assets/stylesheets/theme-dark.min.css') }}" data-skin="dark" />
	<link rel="stylesheet" href="{{ asset('public/assets/stylesheets/custom.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/css/all.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/css/app.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/css/style.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/css/member.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/css/jquery-confirm.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/css/ijaboCropTool.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/css/toastr.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/assets/vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/assets/vendor/tributejs/tribute.css') }}">
<link rel="stylesheet" href="{{ asset('public/assets/vendor/at.js/css/jquery.atwho.min.css') }}">
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
					<a href="{{ route('member.dashboard') }}">
						<img src="{{ asset('public/images/brand.png') }}" alt="M?? Truy???n Ch???">
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
								</div><input type="text" class="form-control" data-toggle="dropdown" aria-label="Search" placeholder="T??m ch???c n??ng">
								<div class="dropdown-menu dropdown-menu-rich dropdown-menu-xl ml-n4 mw-100">
									<div class="dropdown-arrow ml-3"></div>
									<div class="dropdown-scroll perfect-scrollbar h-auto" style="max-height: 360px">
										<div class="list-group list-group-flush list-group-reflow mb-2">
											<h6 class="list-group-header d-flex justify-content-between">
												<span>???????ng t???t</span>
											</h6>
											<div class="list-group-item py-2 border-0">
												<a href="{{ route('member.dashboard.post') }}" class="stretched-link"></a>
												<div class="tile tile-sm bg-muted float-left">
													<i class="fas fa-file-plus"></i>
												</div>
												<div class="ml-2 float-left">????ng Truy???n</div>
											</div>
											<div class="list-group-item py-2 border-0">
												<a href="{{ route('member.dashboard.my_story') }}" class="stretched-link"></a>
												<div class="tile tile-sm bg-muted float-left">
													<i class="fas fa-layer-group"></i>
												</div>
												<div class="ml-2 float-left">Truy???n ???? ????ng</div>
											</div>
											<div class="list-group-item py-2 border-0">
												<a href="{{ route('member.account.setting') }}" class="stretched-link"></a>
												<div class="tile tile-sm bg-muted float-left">
													<i class="fas fa-user-circle"></i>
												</div>
												<div class="ml-2 float-left">???nh ?????i Di???n</div>
											</div>
											<div class="list-group-item py-2 border-0">
												<a href="{{ route('member.account.setting.detail') }}" class="stretched-link"></a>
												<div class="tile tile-sm bg-muted float-left">
													<i class="fas fa-user-alt"></i>
												</div>
												<div class="ml-2 float-left">Th??ng Tin T??i Kho???n</div>
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
										<span>Th??ng B??o <span class="badge">({{ getSoThongBaoMoi() }})</span></span>
										<a href="{{ route('member.notify') }}">T???t c???</a>
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
										<span>H???p Th??</span><a href="#">T???t c??? h???p th??</a>
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
											<a href="{{ env('APP_URL') }}" class="tile-wrapper" target="_blank">
												<span class="tile tile-lg bg-cyan">
													<i class="fas fa-home"></i>
												</span>
												<span class="tile-peek">Trang Ch???</span></a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('member.dashboard.post') }}" class="tile-wrapper">
												<span class="tile tile-lg bg-indigo">
													<i class="fad fa-file-plus"></i>
												</span>
												<span class="tile-peek">????ng Truy???n</span></a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('member.dashboard.my_story') }}" class="tile-wrapper">
												<span class="tile tile-lg bg-teal">
													<i class="fas fa-layer-group"></i>
												</span>
												<span class="tile-peek">Truy???n ????ng</span></a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('member.account') }}" class="tile-wrapper">
												<span class="tile tile-lg bg-pink">
													<i class="fas fa-user-circle"></i>
												</span>
												<span class="tile-peek">T??i Kho???n</span></a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('member.account.setting.detail') }}" class="tile-wrapper">
												<span class="tile tile-lg bg-yellow">
													<i class="fas fa-user-clock"></i>
												</span>
												<span class="tile-peek">Nh???t K??</span></a>
										</div>
										<div class="dropdown-sheet-item">
											<a href="{{ route('trangchu.huongdan') }}" class="tile-wrapper">
												<span class="tile tile-lg bg-cyan">
													<i class="fas fa-question"></i>
												</span>
												<span class="tile-peek">H?????ng D???n</span></a>
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
									<span class="account-description">@if(Auth::user()->role == 'admin') Th??nh Ch??? @elseif(Auth::user()->role == 'mod') Ch???p S??? @else Th??nh Vi??n @endif</span>
								</span>
							</button>
							<div class="dropdown-menu">
								<div class="dropdown-arrow ml-3"></div>
								<h6 class="dropdown-header d-none d-md-block d-lg-none">{{ Auth::user()->display_name }}</h6>
								<a class="dropdown-item" href="{{ route('member.account') }}"><span class="dropdown-icon oi oi-person"></span> H??? S?? C?? Nh??n</a>
								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="dropdown-icon oi oi-account-logout"></span> ????ng Xu???t</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#"><i class="fas fa-user-headset"></i> Trung T??m H??? Tr???</a>
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
							<span class="account-description">@if(Auth::user()->role == 'admin') Th??nh Ch??? @elseif(Auth::user()->role == 'mod') Ch???p S??? @else Th??nh Vi??n @endif</span></span></button>
					<div id="dropdown-aside" class="dropdown-aside collapse">
						<div class="pb-3">
							<a class="dropdown-item" href="{{ route('member.account') }}"><span class="dropdown-icon oi oi-person"></span> H??? S?? C?? Nh??n</a>
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="dropdown-icon oi oi-account-logout"></span> ????ng Xu???t</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#"><i class="fas fa-user-headset"></i> Trung T??m H??? Tr???</a>
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
								<a href="{{ route('member.dashboard') }}" class="menu-link {{ hasActive('bang-dieu-khien') }}">
									<span class="menu-icon fas fa-tachometer-alt {{ hasActive('bang-dieu-khien') }}"></span>
									<span class="menu-text">B???ng ??i???u Khi???n</span>
								</a>
							</li>
							<li class="menu-item">
								<a href="{{ route('member.dashboard.post') }}" class="menu-link {{ hasActive('dang-truyen') }}">
									<span class="menu-icon fas fa-file-plus {{ hasActive('dang-truyen') }}"></span>
									<span class="menu-text">????ng Truy???n</span>
								</a>
							</li>
							<li class="menu-item">
								<a href="{{ route('member.dashboard.my_story') }}" class="menu-link {{ ActiveLink2('truyen-da-dang', 'has-active') }}">
									<span class="menu-icon fas fa-books {{ ActiveLink2('dashboard/my-story', 'has-active') }}"></span>
									<span class="menu-text">Truy???n ???? ????ng</span>
								</a>
							</li>
							<li class="menu-item">
								<a href="{{ route('member.bookmarks') }}" class="menu-link {{ ActiveLink2('tu-truyen-cua-toi', 'has-active') }}">
									<span class="menu-icon fas fa-book-reader {{ ActiveLink2('tu-truyen-cua-toi', 'has-active') }}"></span>
									<span class="menu-text">T??? Truy???n C???a T??i</span>
								</a>
							</li>
							<li class="menu-header">Ch???c N??ng C?? B???n</li>
							<li class="menu-item has-child {{ ActiveLink2('tai-khoan', 'has-open') }}">
								<a href="#" class="menu-link">
									<span class="menu-icon oi oi-person"></span>
									<span class="menu-text">T??i Kho???n</span>
								</a>
								<ul class="menu">
									<li class="menu-item">
										<a href="{{ route('member.account') }}" class="menu-link {{ hasActive('tai-khoan') }}">
											<i class="fas fa-id-badge"></i> T???ng Quan
										</a>
									</li>
									<li class="menu-item">
										<a href="{{ route('member.account.diary') }}" class="menu-link {{ hasActive('tai-khoan/hoat-dong') }}">
											<i class="fas fa-user-clock"></i> Ho???t ?????ng
										</a>
									</li>
									<li class="menu-item">
										<a href="{{ route('member.account.comment') }}" class="menu-link {{ hasActive('tai-khoan/binh-luan') }}">
											<i class="fas fa-comment-dots"></i> B??nh Lu???n
										</a>
									</li>
									<li class="menu-item">
										<a href="{{ route('member.account.setting') }}" class="menu-link {{ ActiveLink2('tai-khoan/thiet-lap', 'has-active') }}">
											<i class="fas fa-user-cog"></i> Thi???t L???p
										</a>
									</li>
								</ul>
							</li>
							<li class="menu-item">
								<a href="{{ route('member.notify') }}" class="menu-link {{ hasActive('thong-bao') }}">
									<span class="menu-icon fa fa-bullhorn"></span>
									<span class="menu-text">Th??ng B??o</span>
								</a>
							</li>
							<li class="menu-item">
								<a href="{{ route('trangchu.lienhe') }}" class="menu-link">
									<span class="menu-icon fas fa-id-card"></span>
									<span class="menu-text">Li??n H??? Ch??ng T??i</span>
								</a>
							</li>
							<li class="menu-item">
								<a href="{{ route('trangchu.phanhoi') }}" class="menu-link">
									<span class="menu-icon fa fa-comment-alt-smile"></span>
									<span class="menu-text">Ph???n H???i Ch??ng T??i</span>
								</a>
							</li>
							
							<li class="menu-header">Ch??nh S??ch & ??i???u Kho???n</li>
							<li class="menu-item">
								<a href="{{ route('trangchu.chinhsach') }}" class="menu-link">
									<span class="menu-icon fas fa-user-shield"></span>
									<span class="menu-text">Ch??nh S??ch B???o M???t</span>
								</a>
							</li>
							<li class="menu-item">
								<a href="{{ route('trangchu.dieukhoan') }}" class="menu-link">
									<span class="menu-icon fas fa-pencil-ruler"></span>
									<span class="menu-text">??i???u Kho???n D???ch V???</span>
								</a>
							</li>
							<li class="menu-item">
								<a href="{{ route('trangchu.huongdan') }}" class="menu-link">
									<span class="menu-icon fas fa-chalkboard-teacher"></span>
									<span class="menu-text">H?????ng D???n Website</span>
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
						<a class="text-muted" href="#">Trung T??m Tr??? Gi??p</a>
					</li>
					<li class="list-inline-item">
						<a class="text-muted" href="{{ route('trangchu.chinhsach') }}">Ch??nh S??ch B???o M???t</a>
					</li>
					<li class="list-inline-item">
						<a class="text-muted" href="{{ route('trangchu.dieukhoan') }}">??i???u Kho???n D???ch V???</a>
					</li>
				</ul>
				<div class="copyright">Copyright ?? <?php echo date('Y'); ?>. All right reserved.</div>
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
	<script src="{{ asset('public/assets/vendor/chart.js/Chart.min.js') }}"></script>
	<script src="{{ asset('public/assets/javascript/theme.min.js') }}"></script>
	@yield('script2')
	<script src="{{ asset('public/assets/javascript/pages/dashboard-demo.js') }}"></script>
	<script src="{{ asset('public/js/jquery-confirm.min.js') }}"></script>
	<script src="{{ asset('public/js/customs_alert.js') }}"></script>
	<script src="{{ asset('public/js/ijaboCropTool.min.js') }}"></script>
	<script src="{{ asset('public/js/toastr.min.js') }}"></script>
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
	{!! Toastr::message() !!}
	@yield('script2')
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
</body>

</html>