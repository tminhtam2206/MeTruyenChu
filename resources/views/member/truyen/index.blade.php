@extends('layouts.member')
@section('title', 'Chi Tiết Truyện')
@section('content')
<div class="page">
    <div class="frame-chua" style="background-image: url('{{ getStoryThumb($truyen->thumb) }}'); background-size: cover;">
        <header class="page-cover" style="background-color: rgba(0,0,0,0.5) !important;">
            <div class="text-center">
                <span>
                    <img class="image" src="{{ getStoryCover($truyen->cover) }}" alt="{{ $truyen->name }}" width="100">
                </span>
                <h2 class="h4 mt-2 mb-0 text-light">{{ $truyen->name }}</h2>
                <div class="my-1">
                    @for($i = 1; $i <= 5; $i++) @if($i <=$danhgia['marks']) <i class="fa fa-star text-yellow"></i>
                        @else
                        <i class="far fa-star text-yellow"></i>
                        @endif
                        @endfor

                </div>
                <p style="color: #bdbfc9 !important;">
                    <i class="fas fa-user-edit"></i>
                    {{ $truyen->author }} <span>@</span>{{ $truyen->User->display_name }}
                </p>
                <p> {{ $truyen->notify }}</p>
            </div>
            <div class="cover-controls cover-controls-bottom">
                <a href="#" class="btn btn-light" style="color: #bdbfc9;"><i class="fas fa-bookmark"></i> {{ number_format($truyen->bookmarks) }} Cất giữ</a>
                <a href="#" class="btn btn-light" style="color: #bdbfc9;"><i class="fas fa-heart-rate"></i> {{ number_format($truyen->views) }} lượt đọc</a>
            </div>
        </header>
    </div>
    <nav class="page-navs">
        <div class="nav-scroller">
            <div class="nav nav-center nav-tabs">
                <a class="nav-link {{ ActiveLink2('chi-tiet', 'active') }}" href="{{ route('member.dashboard.my_story.detail', ['name_slug'=>$truyen->name_slug]) }}"><i class="fab fa-accusoft"></i> Tổng Quan</a>
                <a class="nav-link {{ ActiveLink2('danh-sach-chuong', 'active') }}" href="{{ route('member.dashboard.my_story.list_chapter', ['name_slug'=>$truyen->name_slug]) }}"><i class="fas fa-list-ol"></i> Danh Sách Chương <span class="badge badge-primary">{{ $truyen->num_chaps }}</span></a>
                <a class="nav-link {{ ActiveLink2('van-de', 'active') }}" href="{{ route('member.story.problem', ['name_slug'=>$truyen->name_slug]) }}"><i class="fas fa-bug"></i> Vấn Đề <span class="badge badge-danger">{{ $truyen->problem }}</span></a>
                <a class="nav-link {{ ActiveLink2('nhat-ky', 'active') }}" href="{{ route('member.story.diary', ['name_slug'=>$truyen->name_slug]) }}"><i class="fas fa-history"></i> Nhật Ký</a>
                <a id="id-members" class="nav-link" href="#" data-toggle="modal" data-target="#modalMembers"><i class="fas fa-users"></i> Thành Viên</a>
                @if(getCraw() == 'Y')
                <a class="nav-link {{ ActiveLink2('craw-chuong', 'active') }}" href="{{ route('member.story.craw', ['name_slug'=>$truyen->name_slug]) }}"><i class="fas fa-hat-wizard"></i> Craw Chương</a>
                @endif
                <a class="nav-link {{ ActiveLink2('thiet-lap', 'active') }}" href="{{ route('member.story.setting', ['name_slug'=>$truyen->name_slug]) }}"><i class="fas fa-sliders-v-square"></i> Thiết Lập</a>
            </div>
        </div>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="modalMembers" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalMembersLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="modalMembersLabel" style="width: 100%;">THÀNH VIÊN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-10">
                                    <select id="select-members" class="form-control" data-toggle="select2" name="type_story">
                                        <option value="">-- Chọn Thành Viên --</option>
                                        @foreach($thanhvien as $val)
                                        <option value="{{ $val->id }}">{{ $val->display_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button id="btn-select-members" class="btn btn-primary"><i class="fas fa-user-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div id="id-members-users-2" class="row overflow-auto" style="max-height: 500px;"></div>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    @yield('truyen_content')
</div>
@endsection
@section('script2')
<script>
    var ID_TRUYEN = {{ $truyen->id }};
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
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
    };

    $('#id-members').click(function(){
        refreshListMember();
    });

    function refreshListMember(){
        $.ajax({
            url: "{{ route('member.get_members_story') }}",
            data: {
                truyen_id: ID_TRUYEN
            },
            type: 'get',
            success: function(data) {
                $('#id-members-users-2').html(data);
            }
        });
    }

    $('#btn-select-members').click(function(){
        let get_id_user = $('#select-members').val();
        $.ajax({
            url: "{{ route('member.add_members_story') }}",
            data: {
                user_id: get_id_user,
                truyen_id: ID_TRUYEN
            },
            type: 'get',
            success: function() {
                refreshListMember();
                toastr.success('Thêm thành viên thành công!', '');
            }
        });
    });

    function deleteMember(id){
        if(confirm('Bạn có muốn xóa thành viên ra khỏi danh sách?')){
            $.ajax({
                url: "{{ route('member.delete_members_story') }}",
                data: {
                    id: id
                },
                type: 'get',
                success: function() {
                    refreshListMember();
                    toastr.success('Xóa thành viên thành công!', '');
                }
            });
        }
    }
</script>
@endsection