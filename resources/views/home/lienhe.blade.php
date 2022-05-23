@extends('layouts.home')
@section('title', 'Thông Tin Liên Hệ')
@section('content')
<div class="my-card card shadow-sm mb-3">
    <h5 class="card-header font-roman py-2 font-weight-bolder my-t-shadow bg-xanh">
        <i class="fas fa-id-card"></i> THÔNG TIN LIÊN HỆ
    </h5>
    <div class="card-body py-0 pb-3 my-pad">
        <form method="post" action="{{ route('trangchu.lienhe.post') }}" class="mt-3 mb-2">
            @csrf
            <div class="form-group">
                <label for="email_">Địa chỉ email (*)</label>
                <input type="email" class="form-control" id="email_" aria-describedby="emailHelp" maxlength="255" name="email" placeholder="Địa chỉ email của bạn..." required>
                <small id="emailHelp" class="form-text text-muted">Chúng tôi sẽ liên hệ với bạn qua email này.</small>
            </div>
            <div class="form-group">
                <label for="message">Tin nhắn (*)</label>
                <textarea class="form-control" name="message" id="message" cols="30" rows="10" maxlength="255" placeholder="Tin nhắn của bạn..." required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Gửi</button>
            </div>
        </form>
    </div>
</div>
@endsection