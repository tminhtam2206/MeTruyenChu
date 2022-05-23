@extends('layouts.home')
@section('title', 'Điều Khoản Dịch Vụ')
@section('content')
<div class="my-card card shadow-sm mb-3">
	<h5 class="card-header font-roman py-2 font-weight-bolder my-t-shadow bg-xanh">
		<i class="fas fa-pencil-ruler"></i> ĐIỀU KHOẢN DỊCH VỤ
	</h5>
	<div class="card-body py-0 pb-3 my-pad">
        {!! $dieukhoan !!}
	</div>
</div>
@endsection