@extends('layouts.home')
@section('title', 'Thể Loại | Mê Truyện Chữ')
@section('content')
<div class="my-card card shadow-sm mb-3">
	<h5 class="card-header font-roman py-2 font-weight-bolder my-t-shadow bg-xanh">
        <i class="far fa-fire-alt"></i> THỂ LOẠI TRUYỆN 
        <span class="float-right" style="color: gold;">{{ count($theloai) }} THỂ LOẠI</span>
    </h5>
	<div class="card-body py-0 pb-3 my-pad">
		<div class="row">
			@foreach($theloai as $val)
			<div class="col-6 col-xl-2 col-lg-3 col-md-4 col-sm-6 mt-2">
				<a href="{{ route('trangchu.truyen_the_loai', ['name_slug'=>$val->name_slug]) }}" class="genre">
					<div class="icon float-left"><img src="{{ asset('public/images/lich-su.png') }}"></div>
					<div class="ml-2 float-left">
						<div class="name_tl">{{ $val->name }}</div>
					</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection