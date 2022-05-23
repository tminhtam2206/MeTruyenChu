@extends('layouts.home')
@section('title', 'Truyện '.$truyen->name.' - '.$truyen->author)
@section('seo')
<!-- HTML Meta Tags -->
<meta name="description" content="{{ $truyen->name }}" />
<!-- Google / Search Engine Tags -->
<meta itemprop="name" content="{{ $truyen->name }}">
<meta itemprop="description" content="{{ $truyen->name }}">
<meta itemprop="image" content="{{ getStoryCover($truyen->cover) }}">
<!-- Facebook Meta Tags -->
<link rel="canonical" href="http://tangkinhcac.atwebpages.com" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:type" content="website" />
<meta property="og:title" content="{{ $truyen->name }}" />
<meta property="og:description" content="{{ $truyen->name }}" />
<meta property="og:image" content="{{ getStoryCover($truyen->cover) }}" />
<meta property="og:site_name" content="http://tangkinhcac.atwebpages.com" />
<meta property="og:locale" content="vi_VN" />
@endsection
@section('content')
<ol class="breadcrumb shadow-sm thanh-tran-chi-tiet-truyen an-chu" style="background-color: #FFFFFF;">
    <li class="breadcrumb-item"><a href="{{ env('APP_URL') }}" class="text-muted"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active an-chu" aria-current="page">{{ $truyen->name }}</li>
</ol>

<div class="card card-noi-dung-trang-truyen-chi-tiet">
    <div class="card-title-truyen card-header text-center an-noi-dung">
        <i class="fas fa-book-reader"></i> Truyện {{ $truyen->name }}
    </div>
    <div class="card-body card-body-trang-truyen">
        <div class="row">
            <div class="col-md-3 hide-pc">
                <img class="img-fluid myboder-2 mx-auto my-vien" src="{{ getStoryCover($truyen->cover) }}" style="display: block;">
                <h4 class="text-center mt-2 text-uppercase">{{ $truyen->name }}</h4>
                <p><b>Tác giả: </b><a class="badge badge-light text-primary" href="{{ route('trangchu.tac_gia', ['name'=>$truyen->author]) }}">{{ $truyen->author }}</a></p>
                <p><b>Thể loại: </b>
                    <!-- nội dung thể loại -->
                    @foreach($theloai as $val)
                    <a class="badge badge-light text-primary" href="{{ route('trangchu.truyen_the_loai', ['name_slug'=>$val->name_slug]) }}">{{ $val->name }}</a>
                    @endforeach
                    <!-- end nội dung thể loại -->
                </p>
                <p class="nguon"><b>Nguồn: </b>{{ $truyen->source }}</p>
            </div>
            <div class="col-md-3 show-mobile">
                <img class="img-fluid myboder-2 mx-auto my-vien" src="{{ getStoryCover($truyen->cover) }}" style="display: block;">
                <div class="bao-xau text-center mt-3">
                    <button class="btn text-muted" onclick="FeedBack()"><i class="fas fa-flag"></i> Báo lỗi</button>
                    <button class="btn text-muted" onclick="$('#btn-danhgia').click()"><i class="fas fa-grin-stars"></i> Đánh giá</button>
                </div>
                <h4 class="text-center mt-2 text-uppercase">{{ $truyen->name }}</h4>
                <div class="author-mobile text-center">
                    <a href="{{ route('trangchu.tac_gia', ['name'=>$truyen->author]) }}"><i class="far fa-user-edit"></i> {{ $truyen->author }}</a>
                </div>
                <div class="danh-gia-mobile text-center mt-2">
                    @for($num_marks = 0; $num_marks < 5; $num_marks++) @if($num_marks < $point_marks['marks']) <i class="fa fa-star star"></i>
                        @else
                        <i class="far fa-star star"></i>
                        @endif
                        @endfor
                        <span class="text-muted">({{ $point_marks['num'] }} đánh giá)</span>
                </div>
            </div>
            <div class="col-md-9">
                <h2 id="title-md" class="text-center mt-2 text-uppercase">{{ $truyen->name }}</h2>
                <div class="info-thong-so text-center mt-3 hide-pc">
                    <span class="my-btn my-1 badge badge-primary font-weight-bolder my-gage">{{ $truyen->status }}</span>
                    <span class="my-btn my-1 badge badge-info font-weight-bolder my-gage ml-2">{{ $truyen->type_story }}</span>
                    <span class="my-btn my-1 badge badge-success font-weight-bolder my-gage ml-2">{{ number_format($truyen->num_chaps) }} chương</span>
                    <span class="my-btn my-1 badge badge-secondary font-weight-bolder my-gage ml-2">{{ number_format($truyen->views) }} lượt đọc</span>
                </div>
                <div class="frame-info-detail mt-3 show-mobile">
                    <div class="row text-center small">
                        <div class="col-3">
                            <b>{{ ConverNumber($truyen->num_chaps) }}</b><br>
                            Chương
                        </div>
                        <div class="col-3">
                            <b>{{ ConverNumber($truyen->number_letters) }}</b><br>
                            Chữ
                        </div>
                        <div class="col-3">
                            <b>{{ ConverNumber($truyen->bookmarks) }}</b><br>
                            Cất giữ
                        </div>
                        <div class="col-3">
                            <b>{{ ConverNumber($truyen->views) }}</b><br>
                            Lượt đọc
                        </div>
                    </div>
                </div>
                <div class="share-save text-center mt-3 hide-pc">
                    <button class="text-center btn border shadow-sm rounded-circle mx-3 my-button-like text-danger" onclick="FeedBack()">
                        <i class="fas fa-exclamation-triangle fa-lg" data-toggle="tooltip" data-placement="bottom" title="Báo lỗi truyện"></i>
                    </button>
                    <button id="mark-book" class="text-center btn border shadow-sm rounded-circle mx-3 my-button-like text-success">
                        <i id="icon-bookmark" class="{{ checkTuSach($truyen->id) }} fa-bookmark fa-lg" data-toggle="tooltip" data-placement="bottom" title="Đánh dấu"></i>
                    </button>
                    <button id="btn-danhgia" class="text-center btn border shadow-sm rounded-circle mx-3 my-button-like text-success" data-toggle="tooltip" data-placement="bottom" title="Đánh giá">
                        <i class="fas fa-grin-stars fa-lg"></i>
                    </button>
                    <button id="btn_decu_truyen" class="text-center btn border shadow-sm rounded-circle mx-3 my-button-like text-danger" data-toggle="tooltip" data-placement="bottom" title="Đề cử ({{ $truyen->vote }} phiếu)">
                        <i class="fas fa-flower-tulip fa-lg"></i>
                    </button>
                </div>
                <div class="frame-read mt-3">
                    <a class="read-story btn btn-primary btn-lg btn-block shadow-sm @if($truyen->num_chaps <= 0) disabled @endif" href="{{ getFirstChap($truyen->id) }}"><i class="fas fa-book-reader"></i> đọc truyện</a>
                    <div class="download-story btn btn-primary btn-lg btn-block shadow-sm hide-pc" onclick="Alert('Tính năng download <b>EBOOK PRC</b> hiện đang phát triển!')"><i class="fas fa-file-download"></i> ebook prc</div>
                    <div class="show-mobile">
                        <button id="mark-book-2" class="btn my-btn-super-2 mt-2">
                            <i id="icon-bookmark-2" class="{{ checkTuSach($truyen->id) }} fa-bookmark fa-lg"></i> Đánh dấu
                        </button>
                        <button id="btn_decu_truyen-2" class="btn my-btn-super-2 mt-2" style="float: right;">
                            <i class="fas fa-flower-tulip fa-lg"></i> Đề cử ({{ ConverNumber($truyen->vote) }})
                        </button>
                    </div>
                    <div style="clear: both;"></div>
                </div>

                <div class="ngay-tao mt-3">
                    <p class="py-0 my-0">
                        <i class="fas fa-calendar-alt"></i> Ngày tạo: {{ $truyen->created_at->format('d-m-Y H:i:s') }}
                    </p>
                    <p class="py-0 my-0">
                        <i class="fas fa-calendar-edit"></i> Cập nhật: {{ $truyen->updated_at->format('d-m-Y H:i:s') }}
                    </p>
                </div>
                <div class="review-truyen mt-3">
                    <div class="pb-2">
                        <h3 class="title-review"><i class="fad fa-book-reader"></i> GIỚI THIỆU TRUYỆN</h3>
                    </div>
                    <p>{!! $truyen->description !!}</p>
                </div>
                <div class="chuong-moi-5 mt-3">
                    <div class="pb-2">
                        <h3 class="title-review"><i class="fad fa-galaxy"></i> 5 chương mới nhất</h3>
                    </div>
                    <ul>
                        <!-- nội dung 5 chuong mới -->
                        @foreach($chuongmoi as $val)
                        <li>
                            <a href="{{ route('trangchu.chuong', ['truyen'=>$truyen->name_slug, 'chuong'=>'chuong-'.$val->numchap]) }}">Chương {{ $val->numchap }}: {{ $val->name }}</a>
                            <small>({{ $val->created_at->diffForHumans() }})</small>
                        </li>
                        @endforeach
                        <!-- nội dung 5 chuong mới -->
                    </ul>
                </div>
                <div class="list-chapter mt-3">
                    <div class="pb-2">
                        <h3 class="title-review"><i class="fas fa-layer-group"></i> danh sách chương</h3>
                    </div>
                    <ul id="list-chaps">
                        <!-- nội dung 25 chuong -->
                        @foreach($chuong as $val)
                        <li>
                            <a href="{{ route('trangchu.chuong', ['truyen'=>$truyen->name_slug, 'chuong'=>'chuong-'.$val->numchap]) }}">Chương {{ $val->numchap }}: {{ $val->name }}
                                @if($val->lock == 'Y')
                                <span class="float-right"><i class="fad fa-lock-alt"></i></span>
                                @endif
                            </a>
                        </li>
                        @endforeach
                        <!-- end nội dung 25 chuong -->
                    </ul>
                </div>
                <div id="hinh-kieu" class="mb-2 mt-2"><img class="mx-auto d-block" src="{{ asset('public/images/bg_bottom.png') }}"></div>
            </div>
        </div>

    </div>
</div>

@if($truyen['num_chaps'] > 25)
<div class="my-pagination mt-4 text-center my-3">
    <a id="btn-fist" href="{{ route('trangchu.truyen', ['name_slug' => $truyen['name_slug']]) }}?page=1" class="btn {{ disibleButtonPrev($page) }}"><i class="fad fa-backward"></i></a>
    <a id="btn-truoc" href="{{ route('trangchu.truyen', ['name_slug' => $truyen['name_slug']]) }}?page={{ ($page - 1) }}" class="btn btn-outline-secondary btn-trang {{ disibleButtonPrev($page) }}"><i class="fas fa-caret-left"></i> Trước</a>

    <span id="page-of" class="btn btn-outline-secondary btn-page-of disabled ml-2"><span id="currPage">{{ $page }}</span>/{{ $numOfPage }}</span>

    <a id="btn-sau" href="{{ route('trangchu.truyen', ['name_slug' => $truyen['name_slug']]) }}?page={{ ($page + 1) }}" class="btn btn-outline-secondary btn-trang ml-2 {{ disibleButtonNext($page, $numOfPage) }}">Tiếp <i class="fas fa-caret-right"></i></a>
    <a id="btn-tail" href="{{ route('trangchu.truyen', ['name_slug' => $truyen['name_slug']]) }}?page={{ $numOfPage }}" class="btn {{ disibleButtonNext($page, $numOfPage) }}"><i class="fad fa-forward"></i></a>
</div>
@endif

@if($truyen->lock_comment == 'N')
<!-- danh gia truyen -->
<div class="card mt-2 px-2 py-2 mb-3">
    <div class="review-truyen mt-3">
        <div class="pb-2">
            <h3 class="title-review"><i class="fas fa-comments"></i> ĐÁNH GIÁ / BÌNH LUẬN</h3>
        </div>
    </div>
    <div class="mynav mb-3">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <span id="btn-comment-tab" class="nav-link active my-active" style="cursor: pointer;">Bình luận (<span id="number_comment">{{ count($binhluan) }}</span>)</span>
            </li>
            <li class="nav-item">
                <span id="btn-danhgia-tab" class="nav-link" style="cursor: pointer;">Đánh giá (<span id="number_comment">{{ $point_marks['num'] }}</span>)</span>
            </li>
        </ul>
    </div>
    <div id="frame-comment" class="row">
        <div class="col-md-8">
            <div class="khung-binh-luan-truyen">
                <div style="position: relative;">
                    <input id="truyen_id" type="text" value="{{ $truyen->id }}" hidden>
                    <input id="user_id" type="text" value="{{ getIdUser() }}" hidden>
                    <input id="truyen_chap" type="text" value="0" hidden>
                    <div class="fream-img" style="width: 75px; float: left; margin-right: 5px;"><img src="{{ checkAvatar() }}" width="65" class="mr-3"></div>
                    <textarea id="truyen_comment_246" class="form-control" rows="2" style="float: left; width: calc(100% - 80px);" placeholder="Bình luận của bạn..." maxlength="{{ tbl_fields['truyen_binhluan']['content'] }}"></textarea>
                    <button id="btn-binh-luan-truyen" class="btn" type="submit" style="position: absolute; right: 5px; top: 5px;"><i class="fas fa-paper-plane" style="font-size: 24px;"></i></button>
                </div>
            </div>
            <div class="cls-comment" style="clear: both;"></div>

            <div class="frame-chua-binh-luan mt-3 overflow-auto" style="max-height: 500px;">
                <ul class="list-unstyled">
                    <!-- start loop -->
                    <div id="append-comment"></div>
                    @foreach($binhluan as $val)
                    <li class="media mb-2 pt-3" style="border-top: 1px solid rgba(0,0,0,.1);">
                        <div class="frame-image-thum position-relative">
                            <img src="{{ getAvatar($val->User->avatar) }}" width="65" class="mr-3 rounded-circle" alt="{{ $val->User->display_name }}">
                            <small class="position-absolute title-level badge badge-success show-mobile">{{ $val->User->exp_level }}</small>
                        </div>
                        <div class="media-body">
                            <div class="title-name">{{ $val->User->display_name }}
                                <div class="float-right badge badge-success hide-mobile" style="border-radius: 12px;">
                                    <small>{{ $val->User->exp_level }}</small>
                                </div>
                            </div>
                            <small class="text-muted">
                                <i class="far fa-clock"></i> {{ $val->created_at->diffForHumans() }} |
                                <i class="fas fa-glasses"></i> Chương {{ $val->chap }}
                            </small>
                            <p>{{ $val->content }}</p>
                        </div>
                    </li>
                    @endforeach
                    <hr>
                    <!-- end loop -->
                </ul>
            </div>
        </div>
        <div class="col-md-4 hide-mobile">
            <div class="card card-body">
                <h5>NỘI QUI BÌNH LUẬN</h5>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-warning">1</span>
                    Không được chèn link trang khác vào.
                </div>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-success">2</span>
                    Không văng tục trong bình luận.
                </div>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-info">3</span>
                    Nội dung bình luận tối đa 255 ký tự.
                </div>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-secondary">4</span>
                    Không chèn hình vào trong bình luận.
                </div>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-secondary">5</span>
                    Sai qui định quá 5 lần sẽ bị khóa acc.
                </div>
            </div>
        </div>
    </div>
    <div id="frame-danhgia" class="row">
        <div class="col-md-8">
            <div class="frame-chua-binh-luan mt-3 overflow-auto" style="max-height: 500px;">
                <ul class="list-unstyled">
                    <!-- start loop -->
                    <div id="append-comment"></div>
                    @foreach($danhgia as $val)
                    <li class="media mb-2 pt-3" style="border-top: 1px solid rgba(0,0,0,.1);">
                        <img src="{{ getAvatar($val->User->avatar) }}" width="75" class="mr-3 rounded-circle" alt="{{ $val->User->display_name }}">
                        <div class="media-body">
                            <h5 class="mt-0 mb-1">{{ $val->User->display_name }}
                                <div class="float-right hide-mobile">
                                    @for($num_binhluan = 0; $num_binhluan < 5; $num_binhluan++) 
                                        @if($num_binhluan < $val->marks) 
                                            <i class="fa fa-star star"></i>
                                        @else
                                            <i class="far fa-star star"></i>
                                        @endif
                                    @endfor
                                </div>
                            </h5>
                            <small class="text-muted">
                                <i class="far fa-clock"></i> {{ $val->created_at->diffForHumans() }} |
                                <i class="fas fa-glasses"></i> Chương {{ $val->chap }}
                            </small>
                            <div class="show-mobile">
                                @for($num_binhluan = 0; $num_binhluan < 5; $num_binhluan++) 
                                    @if($num_binhluan < $val->marks) 
                                        <i class="fa fa-star star"></i>
                                    @else
                                        <i class="far fa-star star"></i>
                                    @endif
                                @endfor
                            </div>
                            <p>{{ $val->content }}</p>
                        </div>
                    </li>
                    @endforeach
                    <hr>
                    <!-- end loop -->
                </ul>
            </div>
        </div>
        <div class="col-md-4 hide-mobile">
            <div class="card card-body">
                <h5>NỘI QUI ĐÁNH GIÁ</h5>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-warning">1</span>
                    Không được chèn link trang khác vào.
                </div>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-success">2</span>
                    Không văng tục trong bình luận.
                </div>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-info">3</span>
                    Nội dung bình luận tối đa 255 ký tự.
                </div>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-secondary">4</span>
                    Đánh giá hoặc bình luận không liên quan tới truyện sẽ bị xóa.
                </div>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-secondary">5</span>
                    Đánh giá có điểm số sai lệch với nội dung sẽ bị xóa.
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end danh gia truyen -->
@endif
@if($truyen->lock_comment == 'Y')
<!-- binh lua truyen -->
<div class="card mt-2 px-2 py-2 mb-3">
    <div class="review-truyen mt-3">
        <div class="pb-2">
            <h3 class="title-review"><i class="fas fa-comments"></i> ĐÁNH GIÁ TRUYỆN 
                <span class="float-right mr-2">(<span id="number_comment">{{ $point_marks['num'] }}</span>)</span>
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">

            <div class="frame-chua-binh-luan mt-3 overflow-auto" style="max-height: 500px;">
                <ul class="list-unstyled">
                    <!-- start loop -->
                    <div id="append-comment"></div>
                    @foreach($danhgia as $val)
                    <li class="media mb-2 pt-3" style="border-top: 1px solid rgba(0,0,0,.1);">
                        <img src="{{ getAvatar($val->User->avatar) }}" width="75" class="mr-3 rounded-circle" alt="{{ $val->User->display_name }}">
                        <div class="media-body">
                            <h5 class="mt-0 mb-1">{{ $val->User->display_name }}
                                <div class="float-right hide-mobile">
                                    @for($num_binhluan = 0; $num_binhluan < 5; $num_binhluan++) 
                                        @if($num_binhluan < $val->marks) 
                                            <i class="fa fa-star star"></i>
                                        @else
                                            <i class="far fa-star star"></i>
                                        @endif
                                    @endfor
                                </div>
                            </h5>
                            <small class="text-muted">
                                <i class="far fa-clock"></i> {{ $val->created_at->diffForHumans() }} |
                                <i class="fas fa-glasses"></i> Chương {{ $val->chap }}
                            </small>
                            <div class="show-mobile">
                                @for($num_binhluan = 0; $num_binhluan < 5; $num_binhluan++) 
                                    @if($num_binhluan < $val->marks) 
                                        <i class="fa fa-star star"></i>
                                    @else
                                        <i class="far fa-star star"></i>
                                    @endif
                                @endfor
                            </div>
                            <p>{{ $val->content }}</p>
                        </div>
                    </li>
                    @endforeach
                    <hr>
                    <!-- end loop -->
                </ul>
            </div>
        </div>
        <div class="col-md-4 hide-mobile">
            <div class="card card-body">
                <h5>NỘI QUI ĐÁNH GIÁ</h5>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-warning">1</span>
                    Không được chèn link trang khác vào.
                </div>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-success">2</span>
                    Không văng tục trong bình luận.
                </div>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-info">3</span>
                    Nội dung bình luận tối đa 255 ký tự.
                </div>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-secondary">4</span>
                    Đánh giá hoặc bình luận không liên quan tới truyện sẽ bị xóa.
                </div>
                <div class="noi-qui text-muted mb-2">
                    <span class="badge badge-secondary">5</span>
                    Đánh giá có điểm số sai lệch với nội dung sẽ bị xóa.
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end binh luan truyen -->
@endif
<!-- truyen cung tac gia -->
<div class="truyen-cung-tac-gia bg-white mt-3 px-3 py-3 mb-3">
    <div class="pb-2">
        <h3 class="title-review"><i class="fab fa-autoprefixer"></i> Truyện cùng tác giả</h3>
    </div>
    <div class="container-slides-book">
        <div id="slides-book">
            <!-- start calasoul -->
            @foreach($cungtacgia as $val)
            <a href="{{ route('trangchu.truyen', ['name_slug'=>$val->name_slug]) }}">
                <img class="slide-book" src="{{ getStoryCover($val->cover) }}" data-toggle="tooltip" data-placement="right" title="{{ $val->name }}">
            </a>
            @endforeach
            <!-- end calasoul -->
        </div>
    </div>
</div>
<!-- truyen cung tac gia end -->
<div class="modal fade" id="formDanhGIa" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formDanhGIaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('trangchu.post.danhgia') }}" method="post">
                @csrf
                <input type="text" name="truyen_id" value="{{ $truyen->id }}" hidden>
                <input type="text" name="user_id" value="{{ getIdUser() }}" hidden>
                <input id="marks_point" type="text" name="marks" value="5" hidden>
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="formDanhGIaLabel">đánh giá truyện</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <i id="icon-1" class="icon_danhgia fa fa-star star"></i>
                        <i id="icon-2" class="icon_danhgia fa fa-star star"></i>
                        <i id="icon-3" class="icon_danhgia fa fa-star star"></i>
                        <i id="icon-4" class="icon_danhgia fa fa-star star"></i>
                        <i id="icon-5" class="icon_danhgia fa fa-star star"></i>
                        <span id="marks_point_hover">(5/5 điểm)</span>
                    </div>
                    <div class="form-group" style="position: relative;">
                        <textarea class="form-control" name="content" placeholder="Đánh giá của bạn về truyện này" maxlength="{{ tbl_fields['truyen_binhluan']['content'] }}" cols="30" rows="5" required></textarea>
                        <small class="form-text text-muted">Đánh giá ngắn ngọn, tối đa [{{ tbl_fields['truyen_binhluan']['content'] }}] ký tự.</small>
                        <button id="btn-sent-danhgia" type="submit" class="btn" style="position: absolute;"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    var truyen_id = $('#truyen_id').val();
    var user_id = $('#user_id').val();
    var truyen_chap = $('#truyen_chap').val();
    var truyen_comment = $('#truyen_comment_246').val();
    var _token = '{{ csrf_token() }}';

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    $('#truyen_comment_246').keyup(function() {
        truyen_comment = $('#truyen_comment_246').val()
    })

    $('#btn-binh-luan-truyen').click(function() {
        var number_cmt = parseInt($('#number_comment').text());

        if (user_id <= 0) {
            toastr.error('Vui lòng <b>đăng nhập</b> để bình luận!', '');
        } else {
            if (truyen_comment.length <= 0) {
                toastr.warning('Vui lòng nhập <b>nội dung</b> bình luận!', '');
            } else {
                $.ajax({
                    url: "{{ route('trangchu.truyen_binh_luan') }}",
                    data: {
                        truyen_id: truyen_id,
                        user_id: user_id,
                        content: truyen_comment,
                        chap: truyen_chap,
                        _token: _token
                    },
                    type: 'post',
                    success: function(data_return) {
                        $('#append-comment').append(data_return);
                        $('#truyen_comment_246').val('');
                        $('#number_comment').text(number_cmt + 1);
                    }
                });
            }
        }
    });

    function checkPostComment() {
        if (!check_post_cmt) {
            return false;
        }

        return true;
    }

    function FeedBack() {
        if (user_id <= 0) {
            toastr.error('Vui lòng <b>đăng nhập</b> để sử dụng!', '');
        } else {
            $.confirm({
                title: '<i class="fas fa-exclamation-triangle" style="color:red;"></i> Báo Lỗi',
                content: '' +
                    '<form action="" class="formName">' +
                    '<div class="form-group">' +
                    '<label>Nội dung báo lỗi</label>' +
                    '<textarea class="form-control name" rows="3" placeholder="Tên lỗi..." maxlength="{{ tbl_fields["truyen_vande"]["problem"] }}"></textarea>' +
                    '</div>' +
                    '</form>',
                type: 'orange',
                buttons: {
                    formSubmit: {
                        text: '<i class="fas fa-paper-plane"></i> Gửi',
                        btnClass: 'btn-blue',
                        action: function() {
                            var _problem = this.$content.find('.name').val();
                            $.ajax({
                                url: "{{ route('trangchu.truyen_van_de') }}",
                                data: {
                                    truyen_id: truyen_id,
                                    user_id: user_id,
                                    problem: _problem,
                                    _token: _token
                                },
                                type: 'post',
                                success: function() {
                                    toastr.success('Phản hồi của bạn đã được ghi nhận, chúng tôi sẽ nhanh chóng khắc phục!', '');
                                }
                            });
                        }
                    },
                    cancel: function() {
                        //close
                    },
                },
                onContentReady: function() {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function(e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
        }
    }

    $('#btn_decu_truyen').click(function() {
        if (user_id <= 0) {
            toastr.error('Vui lòng <b>đăng nhập</b> để đề cử truyện!', '');
        } else {
            $.ajax({
                url: "{{ route('trangchu.truyen_de_cu') }}",
                data: {
                    truyen_id: truyen_id,
                    _token: _token
                },
                type: 'post',
                success: function() {
                    toastr.success('Cảm ơn bạn đã đề cử truyện [{{ $truyen->name }}]!', '');
                }
            });
        }
    });

    $('#btn_decu_truyen-2').click(function() {
        if (user_id <= 0) {
            toastr.error('Vui lòng <b>đăng nhập</b> để đề cử truyện!', '');
        } else {
            $.ajax({
                url: "{{ route('trangchu.truyen_de_cu') }}",
                data: {
                    truyen_id: truyen_id,
                    _token: _token
                },
                type: 'post',
                success: function() {
                    toastr.success('Cảm ơn bạn đã đề cử truyện [{{ $truyen->name }}]!', '');
                }
            });
        }
    });

    $('#mark-book').click(function() {
        if (user_id <= 0) {
            toastr.error('Vui lòng <b>đăng nhập</b> để đánh dấu truyện!', '');
        } else {
            let classBookName = $('#icon-bookmark').attr('class').trim();
            if (classBookName == 'far fa-bookmark fa-lg' || classBookName == 'fa-bookmark fa-lg far') {
                $.ajax({
                    url: "{{ route('trangchu.truyen_them_tu_sach') }}",
                    data: {
                        truyen_id: truyen_id,
                        _token: _token
                    },
                    type: 'post',
                    success: function() {
                        $('#icon-bookmark').removeClass('far');
                        $('#icon-bookmark').addClass('fas');
                        toastr.success('Đã thêm truyện vào tủ sách!', '');
                    }
                });
            } else {
                $.ajax({
                    url: "{{ route('trangchu.truyen_xoa_tu_sach') }}",
                    data: {
                        truyen_id: truyen_id,
                        _token: _token
                    },
                    type: 'post',
                    success: function(data_return) {
                        if (data_return == 'success') {
                            $('#icon-bookmark').removeClass('fas');
                            $('#icon-bookmark').addClass('far');
                            toastr.success('Đã xóa truyện khỏi tủ sách!', '');
                        } else {
                            toastr.error('Lỗi không xác định!', '');
                        }
                    }
                });
            }

        }
    });

    $('#mark-book-2').click(function() {
        if (user_id <= 0) {
            toastr.error('Vui lòng <b>đăng nhập</b> để đánh dấu truyện!', '');
        } else {
            let classBookName = $('#icon-bookmark-2').attr('class').trim();
            if (classBookName == 'far fa-bookmark fa-lg' || classBookName == 'fa-bookmark fa-lg far') {
                $.ajax({
                    url: "{{ route('trangchu.truyen_them_tu_sach') }}",
                    data: {
                        truyen_id: truyen_id,
                        _token: _token
                    },
                    type: 'post',
                    success: function() {
                        $('#icon-bookmark-2').removeClass('far');
                        $('#icon-bookmark-2').addClass('fas');
                        toastr.success('Đã thêm truyện vào tủ sách!', '');
                    }
                });
            } else {
                $.ajax({
                    url: "{{ route('trangchu.truyen_xoa_tu_sach') }}",
                    data: {
                        truyen_id: truyen_id,
                        _token: _token
                    },
                    type: 'post',
                    success: function(data_return) {
                        if (data_return == 'success') {
                            $('#icon-bookmark-2').removeClass('fas');
                            $('#icon-bookmark-2').addClass('far');
                            toastr.success('Đã xóa truyện khỏi tủ sách!', '');
                        } else {
                            toastr.error('Lỗi không xác định!', '');
                        }
                    }
                });
            }

        }
    });

    $('#btn-danhgia').click(function() {
        if (user_id <= 0) {
            toastr.error('Vui lòng <b>đăng nhập</b> để đánh giá truyện!', '');
        } else {
            $('#formDanhGIa').modal('show');
        }
    });

    $('#btn-comment-tab').click(function(){
        $('#frame-comment').css('display', '');
        $('#frame-danhgia').css('display', 'none');
    });

    $('#btn-danhgia-tab').click(function(){
        $('#frame-comment').css('display', 'none');
        $('#frame-danhgia').css('display', '');
    });
</script>
<script src="{{ asset('public/js/danhgia.js') }}"></script>
@endsection