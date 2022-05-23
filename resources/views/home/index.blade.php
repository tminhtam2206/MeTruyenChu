@extends('layouts.home')
@section('title', 'Trang Chủ | Mê Truyện Chữ')
@section('seo')
<!-- HTML Meta Tags -->
<meta name="description" content="Ứng dụng đọc truyện chữ online với nhiều thể loại Kiếm hiệp, Tiên hiệp, Sắc hiệp, Đô thị, Ngôn tình, Truyện Convert, Truyện YY, Truyện Dịch Hoàn Thành Full." />
<!-- Google / Search Engine Tags -->
<meta itemprop="name" content="Mê Truyện Chữ | MeTruyenChu">
<meta itemprop="description" content="Ứng dụng đọc truyện chữ online với nhiều thể loại Kiếm hiệp, Tiên hiệp, Sắc hiệp, Đô thị, Ngôn tình, Truyện Convert, Truyện YY, Truyện Dịch Hoàn Thành Full.">
<meta itemprop="image" content="http://tangkinhcac.atwebpages.com/public/images/tien-hiep-1.jpeg">
<!-- Facebook Meta Tags -->
<link rel="canonical" href="https://tangkinhcac.atwebpages.com" />
<meta property="og:url" content="https://tangkinhcac.atwebpages.com" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Mê Truyện Chữ | MeTruyenChu" />
<meta property="og:description" content="Ứng dụng đọc truyện chữ online với nhiều thể loại Kiếm hiệp, Tiên hiệp, Sắc hiệp, Đô thị, Ngôn tình, Truyện Convert, Truyện YY, Truyện Dịch Hoàn Thành Full." />
<meta property="og:image" content="http://tangkinhcac.atwebpages.com/public/images/tien-hiep-1.jpeg" />
<meta property="og:site_name" content="https://tangkinhcac.atwebpages.com" />
<meta property="og:locale" content="vi_VN" />
@endsection
@section('content')
<div class="my-carsoul mb-3">
    <div class="row">
        <div class="col-md-9 truyen-de-cu">
            <!-- start-carousel -->
            @if(count($slideHOT) > 0)
            <div id="carouselExampleCaptions" class="carousel slide shadow" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <!-- nội dung carasoul -->
                    @foreach($slideHOT as $val)
                    <div class="carousel-item @if($loop->index == 0) active @endif">
                        <a href="{{ route('trangchu.truyen', ['name_slug'=>$val->name_slug]) }}">
                            <img src="{{ getStoryThumb($val->thumb) }}" alt="{{ $val->name }}" class="d-block w-100">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $val->name }}</h5>
                                <p>
                                    <i class="fal fa-user"></i>
                                    {{ $val->author }} |
                                    <i class="fal fa-clock"></i> {{ $val->updated_at->diffForHumans() }}
                                </p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    <!-- end nội dung carasoul -->
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            @endif
            <!-- end-carousel -->
        </div>
        <div class="col-md-3 goi-y-tao-tai-khoan">
            <div class="content-car bg-white shadow px-3 py-3" style="background-color: #f4f4f4;height: 340px;border-radius: 3px;">
                <h5 class="text-center text-sd">BẠN ĐÃ CÓ TÀI KHOẢN?</h5>
                <hr>
                <p>
                    <small>
                        Chúng tôi sẵn sàng hỗ trợ bạn bất cứ lúc nào. Hãy nhấn vào lựa chọn bên dưới.
                    </small>
                </p>
                @guest
                <a class="btn btn-success" href="{{ route('trangchu.dang_ky') }}" style="width: 100%;"><i class="fas fa-user-plus"></i> Tạo Tài Khoản</a>
                @else
                <a class="btn btn-success" href="{{ route('forum.index') }}" style="width: 100%;"><i class="fab fa-fort-awesome"></i> Diễn Đàn</a>
                @endguest
                <a class="btn btn-primary mt-3" href="{{ route('trangchu.huongdan') }}" style="width: 100%;">Hướng Dẫn Đăng Truyện</a>
                <a class="btn btn-primary mt-3" href="{{ route('member.dashboard') }}" style="width: 100%;" target="_blank">Trung Tâm Đăng Truyện</a>
                <p class="text-center mt-3"><small><i>(Cần đăng nhập để xem thông tin)</i></small></p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 py-1">
        <div class="my-card card shadow-sm">
            <h5 class="card-header font-roman py-2 font-weight-bolder my-t-shadow bg-xanh">
                <i class="far fa-fire-alt"></i> TRUYỆN HOT
                <a class="float-right bgg-trang" href="{{ route('trangchu.truyen_hot') }}">
                    <i class="fad fa-arrow-alt-circle-right"></i>
                </a>
            </h5>
            <div class="card-body py-0 pb-3 my-pad">
                <div class="row">
                    <!-- nội dung truyện mới update -->
                    @foreach($truyenHot as $val)
                    <div class="col-md-4 col-6 my-2 test">
                        <div class="my-card card bg-dark">
                            <a href="{{ route('trangchu.truyen', ['name_slug'=>$val->name_slug]) }}">
                                <div class="card-body py-0 px-0 position-relative">
                                    <img src="{{ getStoryCover($val->cover) }}" class="img-fluid my-thumb">
                                    <span class="the-chuong position-absolute">{{ $val->num_chaps }} chương</span>
                                    <span class="ribbon ribbon-{{ $loop->index+1 }}">{{ $loop->index+1 }}</span>
                                    <div class="danh-gia-truyen">
                                        <i class="far fa-star" style="color: #ffc000;"></i>
                                        <i class="far fa-star" style="color: #ffc000;"></i>
                                        <i class="far fa-star" style="color: #ffc000;"></i>
                                        <i class="far fa-star" style="color: #ffc000;"></i>
                                        <i class="far fa-star" style="color: #ffc000;"></i>
                                    </div>
                                </div>
                                <div class="card-footer py-1 font-roman title-truyen-home">{{ $val->name }}</div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    <!-- end nội dung truyện mới update -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 py-1 mr-truyenhoanthanh">
        <div class="my-card card shadow-sm pb-2">
            <h5 class="card-header font-roman py-2 font-weight-bolder my-t-shadow bg-xanh">
                <i class="fab fa-stack-overflow"></i> TRUYỆN HOÀN THÀNH
                <a class="float-right bgg-trang" href="{{ route('trangchu.truyen_hoan_thanh') }}"><i class="fad fa-arrow-alt-circle-right"></i></a>
            </h5>
            <div class="card-body py-0 pb-2">
                <ul class="ul-hoan-thanh">
                    <!-- nội dung truyện hoàn thành -->
                    @foreach($truyenComplete as $val)
                    <li class="py-2">
                        <a class="d-block font-roman chu-nau an-chu hover truyen-hoan-thanh" href="{{ route('trangchu.truyen', ['name_slug'=>$val->name_slug]) }}">
                            <i class="fas fa-books"></i> {{ $val->name }}
                        </a>
                        <a class="d-block font-roman chu-nau an-chu hover truyen-tac-gia" href="{{ route('trangchu.tac_gia', ['name'=>$val->author]) }}">
                            <small><i class="fal fa-user fa-fw"></i> {{ $val->author }}</small>
                        </a>
                    </li>
                    @endforeach
                    <!-- end nội dung truyện hoàn thành -->
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid px-0 mt-2 an-banner">
    <a href="#"><img class="img-fluid" src="{{ asset('public/images/banner1.jpg') }}"></a>
</div>
<div class="my-card card shadow-sm mt-3">
    <h5 class="card-header font-roman py-2 font-weight-bolder my-t-shadow bg-xanh">
        <i class="far fa-stopwatch"></i> TRUYỆN MỚI CẬP NHẬT
        <a class="float-right bgg-trang" href="{{ route('trangchu.truyen_moi_cap_nhat') }}"><i class="fad fa-arrow-alt-circle-right"></i></a>
    </h5>
    <div class="card-body py-0 pb-3 my-pad">
        <div class="row">
            <!-- nội dung truyện hot -->
            @foreach($truyenUpdate as $val)
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
</div>
<div class="container-fluid px-0 mt-3 banner-benduoi an-banner">
    <a href="#">
        <img class="img-fluid" src="{{ asset('public/images/banner3.jpg') }}" style="height: 61px; width: 100%;">
    </a>
</div>
<div class="phan-cach"></div>
<div class="row mt-3">
    <div class="col-md-3 my-truyen-the-loai">
        <div class="card bg-light mb-3 my-carddd" style="max-width: 18rem;">
            <div class="card-header bg-xanh font-weight-bolder py-2">
                <i class="fab fa-phoenix-squadron fa-fw"></i> Tiên Hiệp
                <a class="float-right bgg-trang" href="{{ route('trangchu.truyen_the_loai', ['name_slug'=>'tien-hiep']) }}"><i class="fad fa-arrow-alt-circle-right"></i></a>
            </div>
            <div class="card-body py-2">
                <ul class="p-0 m-0" style="list-style: none;">
                    <!-- nội dung tiên hiệp -->
                    @foreach($tien_hiep as $val)
                    <li class="an-chu py-1">
                        <a class="link-nhieu color{{ $loop->index+1 }}" href="{{ route('trangchu.truyen', ['name_slug'=>$val->name_slug]) }}">
                            <span class="badge badge-primary rounded-circle num{{ $loop->index+1 }}">{{ $loop->index+1 }}</span> {{ $val->name }}
                        </a>
                    </li>
                    @endforeach
                    <!-- end nội dung tiên hiệp -->
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-3 my-truyen-the-loai">
        <div class="card bg-light mb-3 my-carddd" style="max-width: 18rem;">
            <div class="card-header bg-xanh font-weight-bolder py-2">
                <i class="fab fa-phoenix-framework fa-fw"></i> Huyền Huyễn
                <a class="float-right bgg-trang" href="{{ route('trangchu.truyen_the_loai', ['name_slug'=>'huyen-huyen']) }}"><i class="fad fa-arrow-alt-circle-right"></i></a>
            </div>
            <div class="card-body py-2">
                <ul class="p-0 m-0" style="list-style: none;">
                    <!-- nội dung huyền huyễn -->
                    @foreach($huyen_huyen as $val)
                    <li class="an-chu py-1">
                        <a class="link-nhieu color{{ $loop->index+1 }}" href="{{ route('trangchu.truyen', ['name_slug'=>$val->name_slug]) }}">
                            <span class="badge badge-primary rounded-circle num{{ $loop->index+1 }}">{{ $loop->index+1 }}</span> {{ $val->name }}
                        </a>
                    </li>
                    @endforeach
                    <!-- end nội dung huyền huyễn -->
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-3 my-truyen-the-loai">
        <div class="card bg-light mb-3 my-carddd" style="max-width: 18rem;">
            <div class="card-header bg-xanh font-weight-bolder py-2">
                <i class="fas fa-city"></i> Đô Thị
                <a class="float-right bgg-trang" href="{{ route('trangchu.truyen_the_loai', ['name_slug'=>'do-thi']) }}"><i class="fad fa-arrow-alt-circle-right"></i></a>
            </div>
            <div class="card-body py-2">
                <ul class="p-0 m-0" style="list-style: none;">
                    <!-- nội dung truyện đô thị -->
                    @foreach($do_thi as $val)
                    <li class="an-chu py-1">
                        <a class="link-nhieu color{{ $loop->index+1 }}" href="{{ route('trangchu.truyen', ['name_slug'=>$val->name_slug]) }}">
                            <span class="badge badge-primary rounded-circle num{{ $loop->index+1 }}">{{ $loop->index+1 }}</span> {{ $val->name }}
                        </a>
                    </li>
                    @endforeach
                    <!-- nội dung truyện đô thị -->
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-3 my-truyen-the-loai">
        <div class="card bg-light mb-3 my-carddd" style="max-width: 18rem;">
            <div class="card-header bg-xanh font-weight-bolder py-2">
                <i class="fas fa-heart"></i> Ngôn Tình
                <a class="float-right bgg-trang" href="{{ route('trangchu.truyen_the_loai', ['name_slug'=>'ngon-tinh']) }}"><i class="fad fa-arrow-alt-circle-right"></i></a>
            </div>
            <div class="card-body py-2">
                <ul class="p-0 m-0" style="list-style: none;">
                    <!-- nội dung ngôn tình -->
                    @foreach($ngon_tinh as $val)
                    <li class="an-chu py-1">
                        <a class="link-nhieu color{{ $loop->index+1 }}" href="{{ route('trangchu.truyen', ['name_slug'=>$val->name_slug]) }}">
                            <span class="badge badge-primary rounded-circle num{{ $loop->index+1 }}">{{ $loop->index+1 }}</span> {{ $val->name }}
                        </a>
                    </li>
                    @endforeach
                    <!-- end nội dung ngôn tình -->
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection