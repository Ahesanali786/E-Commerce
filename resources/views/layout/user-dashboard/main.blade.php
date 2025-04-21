<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('website-admin/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website-admin/css/animation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website-admin/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website-admin/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website-admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('website-admin/font/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('website-admin/icon/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('website-admin/images/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('website-admin/images/favicon.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website-admin/css/sweetalert.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website-admin/css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('website/css/custom.css') }}">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer></script>
    <!-- jQuery (Agar pehle se included nahi hai) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">
                @include('layout.user-dashboard.sidebar')
                <div class="section-content-right">
                    @include('layout.user-dashboard.header')
                    <div class="main-content">
                        @yield('containt')
                        @include('layout.user-dashboard.footer')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('website-admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('website-admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('website-admin/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('website-admin/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('website-admin/js/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('website-admin/js/main.js') }}"></script>
    {{-- <script>
        (function ($) {
            var tfLineChart = (function () {
                var chartBar = function () {
                    var options = {
                        series: [{
                            name: 'Total Orders',
                            data: [
                                   @foreach ($finalData as $item)
                                     {{ $item['total_orders'] }}{{ !$loop->last ? ',' : '' }}
                                   @endforeach
                                ]
                        }],
                        chart: {
                            type: 'bar',
                            height: 325,
                            toolbar: {
                                show: false,
                            },
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '10px',
                                endingShape: 'rounded'
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        legend: {
                            show: false,
                        },
                        colors: ['#2377FC', '#FFA500', '#078407', '#FF0000'],
                        stroke: {
                            show: false,
                        },
                        xaxis: {
                            labels: {
                                style: {
                                    colors: '#212529',
                                },
                            },
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        },
                        yaxis: {
                            show: false,
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return  val + ""
                                }
                            }
                        }
                    };

                    chart = new ApexCharts(
                        document.querySelector("#line-chart-8"),
                        options
                    );
                    if ($("#line-chart-8").length > 0) {
                        chart.render();
                    }
                };

                /* Function ============ */
                return {
                    init: function () { },

                    load: function () {
                        chartBar();
                    },
                    resize: function () { },
                };
            })();

            jQuery(document).ready(function () { });

            jQuery(window).on("load", function () {
                tfLineChart.load();
            });

            jQuery(window).on("resize", function () { });
        })(jQuery);
    </script> --}}
</body>

</html>
