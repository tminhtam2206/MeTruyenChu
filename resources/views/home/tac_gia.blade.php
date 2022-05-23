@extends('layouts.home')
@section('title', 'Tác Giả '.$name)
@section('content')
<div class="my-card card shadow-sm">
    <h5 class="card-header font-roman py-2 font-weight-bolder my-t-shadow bg-xanh" style="text-transform: uppercase;">
        <i class="fas fa-user-tie"></i> {{ $name }}
    </h5>
    <div class="card-body py-0 pb-3 my-pad">
        <div class="row">
            <!-- nội dung truyện hot -->
            @foreach($truyen as $val)
            <div class="col-md-2 col-6 my-2 test">
                <div class="my-card card bg-dark">
                    <a href="{{ route('trangchu.truyen', ['name_slug'=>$val->name_slug]) }}">
                        <div class="card-body py-0 px-0 position-relative">
                            <img src="{{ getStoryCover($val->cover) }}" class="img-fluid my-thumb">
                            <span class="the-chuong position-absolute">{{ $val->num_chaps }} chương</span>
                        </div>
                        <div class="card-footer py-1 font-roman title-truyen-home">{{ $val->name }}</div>
                    </a>
                </div>
            </div>
            @endforeach
            <!-- end nội dung truyện hot -->
        </div>
    </div>
    <div class="card-footer my-pagination">
        <div class="my-pagination text-center">
            <a id="btn-fist" href="{{ route('trangchu.tac_gia', ['name' => $name]) }}?page=1" class="btn {{ disibleButtonPrev($page) }}"><i class="fad fa-backward"></i></a>
            <a id="btn-truoc" href="{{ route('trangchu.tac_gia', ['name' => $name]) }}?page={{ ($page-1) }}" class="btn btn-outline-secondary btn-trang {{ disibleButtonPrev($page) }}"><i class="fas fa-caret-left"></i> Trước</a>

            <span id="page-of" class="btn btn-outline-secondary btn-page-of disabled ml-2"><span id="currPage">{{ $page }}</span>/{{ $numOfPage }}</span>

            <a id="btn-sau" href="{{ route('trangchu.tac_gia', ['name' => $name]) }}?page={{ ($page+1) }}" class="btn btn-outline-secondary btn-trang ml-2 {{ disibleButtonNext($page, $numOfPage) }}">Tiếp <i class="fas fa-caret-right"></i></a>
            <a id="btn-tail" href="{{ route('trangchu.tac_gia', ['name' => $name]) }}?page={{ $numOfPage }}" class="btn {{ disibleButtonNext($page, $numOfPage) }}"><i class="fad fa-forward"></i></a>
        </div>
    </div>
</div>
<div class="container-fluid px-0 mt-3 banner-benduoi an-banner mb-3">
    <a href="#">
        <img class="img-fluid" src="{{ asset('public/images/banner3.jpg') }}" style="height: 61px; width: 100%;">
    </a>
</div>
<div class="phan-cach"></div>

@endsection