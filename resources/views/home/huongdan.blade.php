@extends('layouts.home')
@section('title', 'Hướng Dẫn Website')
@section('content')
<div class="my-card card shadow-sm mb-3">
	<h5 class="card-header font-roman py-2 font-weight-bolder my-t-shadow bg-xanh">
		<i class="fas fa-chalkboard-teacher"></i> HƯỚNG DẪN WEBSITE
	</h5>
	<div class="card-body py-0 pb-3 my-pad">
        {!! $huongdan !!}
	</div>
</div>
@endsection