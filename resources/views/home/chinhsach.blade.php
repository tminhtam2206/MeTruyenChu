@extends('layouts.home')
@section('title', 'Chính Sách Bảo Mật')
@section('content')
<div class="my-card card shadow-sm mb-3">
	<h5 class="card-header font-roman py-2 font-weight-bolder my-t-shadow bg-xanh">
		<i class="fas fa-user-shield"></i> CHÍNH SÁCH BẢO MẬT
	</h5>
	<div class="card-body py-0 pb-3 my-pad">
        {!! $chinhsach !!}
	</div>
</div>
@endsection