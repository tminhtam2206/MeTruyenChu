<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Quên Mật Khẩu</title>
	<link rel="shortcut icon" href="{{ asset('public/images/logo.png') }}" type="image/png">
	<meta name="theme-color" content="#3063A0" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" />
	<link rel="stylesheet" href="{{ asset('public/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('public/assets/stylesheets/theme.min.css') }}" data-skin="default" />
	<link rel="stylesheet" href="{{ asset('public/assets/stylesheets/theme-dark.min.css') }}" data-skin="dark" />
	<link rel="stylesheet" href="{{ asset('public/assets/stylesheets/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/toastr.min.css') }}">
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
	<main class="auth">
		<form class="auth-form auth-form-reflow" method="POST" action="{{ route('trangchu.quenmatkhau.post') }}">
            @csrf
			<div class="text-center mb-4">
				<div class="mb-4">
					<img class="rounded" src="{{ asset('public/images/logo.png') }}" alt="" height="72">
				</div>
				<h1 class="h3">Khôi Phục Mật Khẩu</h1>
			</div>
			<p class="mb-4 text-center">Chúng tôi không thể đưa ra mật khẩu cho bạn, nhưng chúng tôi sẽ cấp lại mật khẩu mới cho bạn, thông qua tên đăng nhập và email.</p>
			<div class="form-group mb-4">
				<label class="d-block text-left" for="name">Tên đăng nhập</label>
                <input type="text" id="name" name="name" class="form-control form-control-lg" autocomplete="off" required autofocus>
			</div>
            <div class="form-group mb-4">
				<label class="d-block text-left" for="email">Địa chỉ email</label>
                <input type="email" id="email" name="email" class="form-control form-control-lg" autocomplete="off" required>
			</div>
			<div class="d-block d-md-inline-block mb-2">
				<button class="btn btn-lg btn-block btn-primary" type="submit">Khôi phục mật khẩu</button>
			</div>
			<div class="d-block d-md-inline-block">
				<a href="{{ route('trangchu.dang_nhap') }}" class="btn btn-block btn-light">Trở lại trang đăng nhập</a>
			</div>
		</form>
		<footer class="auth-footer mt-5 text-center">
			© @php echo date('Y') @endphp All Rights Reserved. <br> <a href="{{ route('trangchu.chinhsach') }}">Chính Sách Bảo Mật</a> và <a href="{{ route('trangchu.dieukhoan') }}">Điều Khoản Dịch Vụ</a>
		</footer>
	</main>
	<script src="{{ asset('public/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ asset('public/assets/vendor/popper.js/umd/popper.min.js') }}"></script>
	<script src="{{ asset('public/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/assets/javascript/theme.min.js') }}"></script>
    <script src="{{ asset('public/js/toastr.min.js') }}"></script>
    {!! Toastr::message() !!}
</body>
</html>