@extends('layouts.home')
@section('title', 'Phản Hồi')
@section('content')
<div class="my-card card shadow-sm mb-3">
    <h5 class="card-header font-roman py-2 font-weight-bolder my-t-shadow bg-xanh">
        <i class="fas fa-comment-alt-smile"></i> PHẢN HỒI
    </h5>
    <div class="card-body py-0 pb-3 my-pad">
        <form method="post" action="{{ route('trangchu.phanhoi.post') }}" class="mt-3 mb-2">
            @csrf
            <div class="form-group">
                <label>Họ tên (*)</label>
                <input type="text" class="form-control" maxlength="42" name="name" placeholder="Họ tên của bạn..." required>
            </div>
            <div class="form-group">
                <label for="message">Nội dung phản hồi (*)</label>
                <textarea class="form-control" name="message" id="message" cols="30" rows="10" maxlength="255" placeholder="Nội dung phản hồi của bạn..." required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Gửi</button>
            </div>
        </form>
    </div>
</div>
@endsection