@extends('layouts.admin')
@section('title', 'Bảng Điều Khiển')
@section('content')
<div class="page">
    <div class="page-inner">
        <header class="page-title-bar">
            <div class="d-flex flex-column flex-md-row">
                <p class="lead">
                    <span class="font-weight-bold">Chào, {{ Auth::user()->display_name }}.</span>
                    <span class="d-block text-muted">Đây là những gì diễn ra với tài khoản của bạn vào ngày hôm nay.</span>
                </p>
                <div class="ml-auto">
                    <div class="dropdown">
                        <button class="btn btn-secondary">
                            <span>{{ date('d-m-Y') }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <div class="page-section">
            <div class="section-block">
                <div class="metric-row">
                    <div class="col-lg-9">
                        <div class="metric-row metric-flush">
                            <div class="col">
                                <a href="{{ route('admin.users') }}" class="metric metric-bordered align-items-center">
                                    <h2 class="metric-label">THÀNH VIÊN</h2>
                                    <p class="metric-value h3">
                                        <sub><i class="fas fa-users"></i></sub>
                                        <span class="value">{{ number_format($users) }}</span>
                                    </p>
                                </a>
                            </div>
                            <div class="col">
                                <a href="{{ route('admin.stories') }}" class="metric metric-bordered align-items-center">
                                    <h2 class="metric-label">TỔNG TRUYỆN</h2>
                                    <p class="metric-value h3">
                                        <sub><i class="fas fa-layer-group"></i></sub>
                                        <span class="value">{{ number_format($truyen) }}</span>
                                    </p>
                                </a>
                            </div>
                            <div class="col">
                                <a href="{{ route('admin.type_story') }}" class="metric metric-bordered align-items-center">
                                    <h2 class="metric-label">THỂ LOẠI</h2>
                                    <p class="metric-value h3">
                                        <sub><i class="fa fa-list"></i></sub>
                                        <span class="value">{{ number_format($theloai) }}</span>
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <span class="metric metric-bordered">
                            <div class="metric-badge">
                                <span class="badge badge-lg badge-success"><span class="oi oi-media-record pulse mr-1"></span> DUNG LƯỢNG DATABASE</span>
                            </div>
                            <p class="metric-value h3">
                                <sub><i class="fas fa-database"></i></sub>
                                <span class="value">{{ getSizeDB() }}</span>
                            </p>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-12 col-xl-4">
                    <div class="card card-fluid">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Lượt xem</h3>
                            <div class="chartjs" style="height: 292px">
                                <canvas id="completion-tasks"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div class="card card-fluid">
                        <div class="card-body">
                            <h3 class="card-title">Thành viên</h3>
                            <div class="text-center pt-3">
                                <div class="chart-inline-group" style="height:214px">
                                    <div class="easypiechart" data-toggle="easypiechart" data-percent="{{ $user_thanhvien }}" data-size="214" data-bar-color="#346CB0" data-track-color="false" data-scale-color="false" data-rotate="225"></div>
                                    <div class="easypiechart" data-toggle="easypiechart" data-percent="{{ $user_chapsu }}" data-size="174" data-bar-color="#00A28A" data-track-color="false" data-scale-color="false" data-rotate="225"></div>
                                    <div class="easypiechart" data-toggle="easypiechart" data-percent="{{ $user_quantri }}" data-size="134" data-bar-color="#5F4B8B" data-track-color="false" data-scale-color="false" data-rotate="225"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="card-footer-item">
                                <i class="fa fa-fw fa-circle text-indigo"></i> {{ $user_thanhvien }}% <div class="text-muted small">Thành viên</div>
                            </div>
                            <div class="card-footer-item">
                                <i class="fa fa-fw fa-circle text-purple"></i> {{ $user_chapsu }}% <div class="text-muted small">Chấp sự</div>
                            </div>
                            <div class="card-footer-item">
                                <i class="fa fa-fw fa-circle text-teal"></i> {{ $user_quantri }}% <div class="text-muted small">Quản trị</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-4">
                    <div class="card card-fluid">
                        <div class="card-body pb-0">
                            <h3 class="card-title">Thống kê truyện</h3>
                            <ul class="list-inline small">
                                <li class="list-inline-item">
                                    <i class="fa fa-fw fa-circle text-purple"></i> Bình thường
                                </li>
                                <li class="list-inline-item">
                                    <i class="fa fa-fw fa-circle text-teal"></i> Bị khóa
                                </li>
                                <li class="list-inline-item">
                                    <i class="fa fa-fw fa-circle text-red"></i> Bị xóa
                                </li>
                                <li class="list-inline-item">
                                    <i class="fa fa-fw fa-circle" style="color: #666c33;"></i> Hoàn thành
                                </li>
                                <li class="list-inline-item">
                                    <i class="fa fa-fw fa-circle" style="color: #b2c137;"></i> Đang cập nhật
                                </li>
                                <li class="list-inline-item">
                                    <i class="fa fa-fw fa-circle" style="color: #414615;"></i> Ngừng
                                </li>
                            </ul>
                        </div>
                        <div class="list-group list-group-flush mb-2">
                            <div class="list-group-item">
                                <div class="list-group-item-figure">
                                    <i class="fas fa-books" style="font-size: 21px;"></i>
                                </div>
                                <div class="list-group-item-body" data-toggle="tooltip" title="Bình thường: {{ $truyen_binhthuong }}%">
                                    <div class="progress progress-animated bg-transparent rounded-0">
                                        <div class="progress-bar bg-purple" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{ $truyen_binhthuong }}%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="list-group-item-figure">
                                    <i class="fas fa-books" style="font-size: 21px;"></i>
                                </div>
                                <div class="list-group-item-body" data-toggle="tooltip" title="Bị khóa: {{ $truyen_bikhoa }}%">
                                    <div class="progress progress-animated bg-transparent rounded-0">
                                        <div class="progress-bar bg-teal" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{ $truyen_bikhoa }}%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="list-group-item-figure">
                                    <i class="fas fa-books" style="font-size: 21px;"></i>
                                </div>
                                <div class="list-group-item-body" data-toggle="tooltip" title="Bị xóa: {{ $truyen_bixoa }}%">
                                    <div class="progress progress-animated bg-transparent rounded-0">
                                        <div class="progress-bar bg-red" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{ $truyen_bixoa }}%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="list-group-item-figure">
                                    <i class="fas fa-books" style="font-size: 21px;"></i>
                                </div>
                                <div class="list-group-item-body" data-toggle="tooltip" title="Hoàn thành: {{ $truyen_hoanthanh }}%">
                                    <div class="progress progress-animated bg-transparent rounded-0">
                                        <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="background-color: #666c33; width: {{ $truyen_hoanthanh }}%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="list-group-item-figure">
                                    <i class="fas fa-books" style="font-size: 21px;"></i>
                                </div>
                                <div class="list-group-item-body" data-toggle="tooltip" title="Đang cập nhật: {{ $truyen_dangcapnhat }}%">
                                    <div class="progress progress-animated bg-transparent rounded-0">
                                        <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="background-color: #b2c137; width: {{ $truyen_dangcapnhat }}%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="list-group-item-figure">
                                    <i class="fas fa-books" style="font-size: 21px;"></i>
                                </div>
                                <div class="list-group-item-body" data-toggle="tooltip" title="Ngừng: {{ $truyen_ngung }}%">
                                    <div class="progress progress-animated bg-transparent rounded-0">
                                        <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="background-color: #414615; width: {{ $truyen_ngung }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-deck-xl">
                <div class="card card-fluid">
                    <div class="card-header">Phản Hồi</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="20">#</th>
                                        <th> HỌ TÊN</th>
                                        <th> THÔNG BÁO</th>
                                        <th> THỜI GIAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($phanhoi as $val)
                                    <tr>
                                        <td class="align-middle">{{ $loop->index+1 }}</td>
                                        <td class="align-middle">{{ $val->name }}</td>
                                        <td class="align-middle"><textarea class="form-control" rows="1" readonly>{{ $val->message }}</textarea></td>
                                        <td class="align-middle"> {{ $val->created_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.feedbacks') }}" class="card-footer-item">Xem tất cả <i class="fa fa-fw fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="card card-fluid">
                    <div class="card-header">Liên Hệ</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="20">#</th>
                                        <th> EMAIL</th>
                                        <th> LỜI NHẮN</th>
                                        <th> THỜI GIAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lienhe as $val)
                                    <tr>
                                        <td class="align-middle">{{ $loop->index+1 }}</td>
                                        <td class="align-middle">{{ $val->email }}</td>
                                        <td class="align-middle"><textarea class="form-control" rows="1" readonly>{{ $val->message }}</textarea></td>
                                        <td class="align-middle"> {{ $val->created_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.contacts') }}" class="card-footer-item">Xem tất cả <i class="fa fa-fw fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('public/assets/vendor/chart.js/Chart.min.js') }}"></script>
<script>
    "use strict";

    function _classCallCheck(instance, Constructor) {
        if (!(instance instanceof Constructor)) {
            throw new TypeError("Cannot call a class as a function");
        }
    }

    function _defineProperties(target, props) {
        for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || false;
            descriptor.configurable = true;
            if ("value" in descriptor) descriptor.writable = true;
            Object.defineProperty(target, descriptor.key, descriptor);
        }
    }

    function _createClass(Constructor, protoProps, staticProps) {
        if (protoProps) _defineProperties(Constructor.prototype, protoProps);
        if (staticProps) _defineProperties(Constructor, staticProps);
        return Constructor;
    }
    // Dashboard Demo
    // =============================================================
    var DashboardDemo =
        /*#__PURE__*/
        function() {
            function DashboardDemo() {
                _classCallCheck(this, DashboardDemo);
                this.init();
            }
            _createClass(DashboardDemo, [{
                key: "init",
                value: function init() {
                    // event handlers
                    this.completionTasksChart();
                }
            }, {
                key: "completionTasksChart",
                value: function completionTasksChart() {
                    var data = {
                        labels: ['{{ date("d-m-Y", strtotime($day1)) }}', '{{ date("d-m-Y", strtotime($day2)) }}', '{{ date("d-m-Y", strtotime($day3)) }}', '{{ date("d-m-Y", strtotime($day4)) }}', '{{ date("d-m-Y", strtotime($day5)) }}', '{{ date("d-m-Y", strtotime($day6)) }}', '{{ date("d-m-Y", strtotime($day7)) }}'],
                        datasets: [{
                            backgroundColor: Looper.getColors('brand').indigo,
                            borderColor: Looper.getColors('brand').indigo,
                            data: ['{{ $val_day1 }}', '{{ $val_day2 }}', '{{ $val_day3 }}', '{{ $val_day4 }}', '{{ $val_day5 }}', '{{ $val_day6 }}', '{{ $val_day7 }}']
                        }] // init chart bar
                    };
                    var canvas = $('#completion-tasks')[0].getContext('2d');
                    var chart = new Chart(canvas, {
                        type: 'bar',
                        data: data,
                        options: {
                            responsive: true,
                            legend: {
                                display: false
                            },
                            title: {
                                display: false
                            },
                            scales: {
                                xAxes: [{
                                    gridLines: {
                                        display: true,
                                        drawBorder: false,
                                        drawOnChartArea: false
                                    },
                                    ticks: {
                                        maxRotation: 0,
                                        maxTicksLimit: 3
                                    }
                                }],
                                yAxes: [{
                                    gridLines: {
                                        display: true,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        beginAtZero: true,
                                        stepSize: 100
                                    }
                                }]
                            }
                        }
                    });
                }
            }]);
            return DashboardDemo;
        }();
    /**
     * Keep in mind that your scripts may not always be executed after the theme is completely ready,
     * you might need to observe the `theme:load` event to make sure your scripts are executed after the theme is ready.
     */
    $(document).on('theme:init', function() {
        new DashboardDemo();
    });
</script>
@endsection