@extends('mod.truyen.index')
@section('title', 'Tổng Quan Truyện')
@section('truyen_content')
<div class="page-inner">
    <div class="page-section">
        @if($truyen->lock == 'Y')
        <div class="alert alert-warning" role="alert">
            <i class="fas fa-exclamation-triangle"></i> Truyện <b>[{{ $truyen->name }}]</b> đã bị khóa, vui lòng liên hệ chấp sự!
        </div>
        @endif
        <div class="row">
            <div class="col-xl-8">
                <div class="card card-body card-fluid">
                    <ul class="list-inline small" style="float: right;">
                        <span style="font-weight: bold; font-weight: 600 !important; font-size: .875rem;">THÀNH TÍCH</span>
                        <div class="float-right">
                            <li class="list-inline-item">
                                <i class="fa fa-fw fa-circle text-teal"></i> Lượt xem
                            </li>
                            <li class="list-inline-item">
                                <i class="fa fa-fw fa-circle text-purple"></i> Đề cử
                            </li>
                        </div>
                    </ul>
                    <div class="chartjs" style="height: 253px">
                        <canvas id="canvas-achievement"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card card-fluid" style="height: 324px;">
                    <div class="card-header">BÌNH LUẬN
                        <small style="float: right;">5 bình luận mới nhất</small>
                    </div>
                    @foreach($comment as $val)
                    <div class="card-body border-top">
                        <dl class="d-flex justify-content-between">
                            <dt class="text-left" style="font-weight: 400 !important;">
                                <span>Chương {{ $val->chap }}</span>
                                <small class="text-danger">{{ $val->content }}</small>
                            </dt>
                            <dd class="text-right mb-0">
                                <strong style="font-weight: 400 !important;">{{ $val->created_at->diffForHumans() }}</strong>
                            </dd>
                        </dl>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-fluid" style="height: 337px;">
                    <div class="card-header border-0">
                        <div class="d-flex align-items-center">
                            <span class="mr-auto">CHƯƠNG MỚI NHẤT</span>
                            <small>5 chương mới nhất</small>
                        </div>
                    </div>
                    <div class="table-responsive" style="height: 230px;">
                        <table class="table">
                            <tbody>
                                @foreach($chuong as $val)
                                <tr>
                                    <td class="align-middle" width="5">{{ $loop->index+1 }}</td>
                                    <td class="align-middle text-truncate">
                                        <a href="{{ route('trangchu.chuong', ['truyen'=>$truyen->name_slug, 'chuong'=>$val->name_slug]) }}" target="_blank">Chương {{ $val->numchap }}: {{ $val->name }}</a>
                                    </td>
                                    <td class="align-middle text-right">{{ $val->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('mod.truyen_da_dang.danh_sach_chuong', ['name_slug'=>$truyen->name_slug]) }}" class="card-footer-item">Xem tất cả <i class="fa fa-fw fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card card-fluid" style="height: 337px;">
                    <div class="card-header border-0">
                        <div class="d-flex align-items-center">
                            <span class="mr-auto">NHẬT KÝ</span>
                            <small>5 nhật ký mới nhất</small>
                        </div>
                    </div>
                    <div class="table-responsive" style="height: 230px;">
                        <table class="table">
                            <tbody>
                                @foreach($record as $val)
                                <tr>
                                    <td class="align-middle" width="5">{{ $loop->index+1 }}</td>
                                    <td class="align-middle text-truncate">
                                        <a href="#">{{ $val->log }}</a>
                                    </td>
                                    <td>
                                        <span>chương {{ $val->numchap }}</span>
                                    </td>
                                    <td class="align-middle text-right">{{ $val->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('mod.truyen_da_dang.nhat_ky', ['name_slug'=>$truyen->name_slug]) }}" class="card-footer-item">Xem tất cả <i class="fa fa-fw fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script2')
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

    // Profile Demo
    // =============================================================
    var ProfileDemo = /*#__PURE__*/ function() {
        function ProfileDemo() {
            _classCallCheck(this, ProfileDemo);

            this.init();
        }

        _createClass(ProfileDemo, [{
            key: "init",
            value: function init() {
                // event handlers
                this.achievementChart();
            }
        }, {
            key: "achievementChart",
            value: function achievementChart() {
                var self = this;
                var data = {
                    labels: ['{{ $day1 }}', '{{ $day2 }}', '{{ $day3 }}', '{{ $day4 }}', '{{ $day5 }}', '{{ $day6 }}', '{{ $day7 }}'],
                    datasets: [{
                        label: 'Lượt xem',
                        borderColor: Looper.colors.brand.teal,
                        backgroundColor: Looper.colors.brand.teal,
                        data: ['{{ $val_day1->views }}', '{{ $val_day2->views }}', '{{ $val_day3->views }}', '{{ $val_day4->views }}', '{{ $val_day5->views }}', '{{ $val_day6->views }}', '{{ $val_day7->views }}']
                    }, {
                        label: 'Đề cử',
                        borderColor: Looper.colors.brand.purple,
                        backgroundColor: Looper.colors.brand.purple,
                        data: ['{{ $val_day1->vote }}', '{{ $val_day2->vote }}', '{{ $val_day3->vote }}', '{{ $val_day4->vote }}', '{{ $val_day5->vote }}', '{{ $val_day6->vote }}', '{{ $val_day7->vote }}']
                    }]
                }; // init achievement chart

                var canvas = $('#canvas-achievement')[0].getContext('2d');
                var chart = new Chart(canvas, {
                    type: 'bar',
                    data: data,
                    options: {
                        tooltips: {
                            mode: 'index',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                gridLines: {
                                    display: true,
                                    drawBorder: false,
                                    drawOnChartArea: false
                                }
                            }],
                            yAxes: [{
                                gridLines: {
                                    display: true,
                                    borderDash: [8, 4]
                                },
                                ticks: {
                                    stepSize: 20
                                }
                            }]
                        }
                    }
                });
            }
        }]);

        return ProfileDemo;
    }();

    $(document).on('theme:init', function() {
        new ProfileDemo();
    });
</script>
@endsection