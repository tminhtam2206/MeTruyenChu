@extends('member.account.profile_setting')
@section('content_setting_profile')
<div class="card card-fluid">
    <h6 class="card-header" style="text-transform: uppercase;">Thông Tin Thanh Toán</h6>
    <div class="card-body">
        <form method="post" action="#" onsubmit="return false">
            <div class="form-row">
                <label for="input01" class="col-md-3">Họ và tên</label>
                <div class="col-md-9 mb-3">
                    <input type="text" class="form-control" id="input01" value="Beni" required="">
                </div>
            </div>
            <div class="form-row">
                <label for="input03" class="col-md-3">Quốc gia</label>
                <div class="col-md-9 mb-3">
                    <select id="input03" class="custom-select">
                        <option value="">Chọn quốc gia</option>
                        <option value="id" selected> VietNam</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <label for="input04" class="col-md-3">Địa chỉ</label>
                <div class="col-md-9 mb-3">
                    <input type="text" class="form-control" id="input04" placeholder="Nhập địa chỉ" required="">
                </div>
            </div>
            <div class="form-row">
                <label for="input06" class="col-md-3">Thành phố</label>
                <div class="col-md-9 mb-3">
                    <input type="text" class="form-control" id="input06" placeholder="Nhập thành phố" required="">
                </div>
            </div>
            <div class="form-row">
                <label for="input07" class="col-md-3">Tỉnh</label>
                <div class="col-md-9 mb-3">
                    <input type="text" class="form-control" id="input07" placeholder="Nhập tỉnh" required="">
                </div>
            </div>
            <div class="form-row">
                <label for="input08" class="col-md-3">Mã số bưu điện (Zip)</label>
                <div class="col-md-9 mb-3">
                    <input type="text" class="form-control" id="input08" placeholder="9999" required="">
                </div>
            </div>
            <hr class="my-4">
            <h4 class="card-title text-uppercase">Phương thức thanh toán</h4>
            <div class="custom-control custom-radio mb-2">
                <input type="radio" class="custom-control-input" name="input09" id="pmd1"><label class="custom-control-label" for="pmd1">Thẻ tín dụng</label>
                <div class="custom-control-hint">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <input type="text" class="form-control" id="pm1" value="Dorian Feeney" placeholder="Name on card" required=""><label for="pm1">Card holder</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <input type="text" class="form-control" id="pm2" value="3129 0713 0072 6258" placeholder="XXXX XXXX XXXX XXXX" required=""><label for="pm2">Card number</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <input type="text" class="form-control" id="pm3" value="01/20" placeholder="MM/YY" required=""><label for="pm3">Exp. date</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <input type="text" class="form-control" id="pm4" value="123" placeholder="XXX" required=""><label for="pm4">CVC</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-lg btn-primary btn-block">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-control custom-radio mb-2">
                <input type="radio" class="custom-control-input" name="input09" id="pmd2" checked><label class="custom-control-label" for="pmd2">Paypal</label>
                <div class="custom-control-hint">
                    <div class="form-row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="input-group h-auto">
                                    <div class="form-label-group">
                                        <input type="text" class="form-control" value="paypal@looper.com" readonly><label>Personal account</label>
                                    </div>
                                    <div class="input-group-append ml-auto">
                                        <span class="input-group-text text-success"><strong>Connected</strong></span>
                                    </div>
                                </div>
                            </div><button class="btn btn-danger" type="button">Disconnect</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-control custom-radio mb-2">
                <input type="radio" class="custom-control-input" name="input09" id="pmd3"><label class="custom-control-label" for="pmd3">Mã vạch</label>
                <div class="custom-control-hint">
                    <button class="btn btn-primary" type="button">Connect with <strong><em>Stripe</em></strong></button>
                </div>
            </div>
            <hr>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary ml-auto" disabled>Cập nhật thanh toán</button>
            </div>
        </form>
    </div>
</div>
@endsection