@extends('dashbord.master')
<!-- Content Wrapper. Contains page content -->
@section('content')
<div class="content-wrapper">
    <style>
        .info-box-content span{
            font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
            font-size: larger;
            font-weight: bold;
        }
        .info-box-text{
            text-transform: capitalize;
        }
    </style>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('trans.num_employee')}}</span>
                        <span class="info-box-number">{{$variables['num_employees']}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-user-circle-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('trans.num_user')}}</span>
                        <span class="info-box-number">{{$variables['num_users']}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-file-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('trans.num_purchase')}}</span>
                        <span class="info-box-number">{{$variables['num_purchaseInvoice']}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-file-text"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('trans.num_byBill')}}</span>
                        <span class="info-box-number">{{$variables['num_purchaseInvoice']}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-olive"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('trans.num_suppliers')}}</span>
                        <span class="info-box-number">{{$variables['num_suppliers']}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-cubes"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('trans.num_products')}}</span>
                        <span class="info-box-number">{{$variables['num_products']}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-purple"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('trans.num_customers')}}</span>
                        <span class="info-box-number">{{$variables['num_customers']}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

<br>
{{--        <div class="row">--}}

{{--            <section class="col-lg-6 connectedSortable">--}}
{{--                <div class="nav-tabs-custom">--}}
{{--                    <canvas id="barchart" height="280"></canvas>--}}
{{--                </div>--}}
{{--                <!-- /.nav-tabs-custom -->--}}
{{--            </section>--}}
{{--        </div>--}}


        <div class="row">

            <section class="col-lg-6 connectedSortable">
                <div class="nav-tabs-custom">
                    <canvas id="mypieChart" height="280"></canvas>
                </div>
                <!-- /.nav-tabs-custom -->
            </section>

            <section class="col-lg-6 connectedSortable">
                <div class="nav-tabs-custom">
                    <canvas id="lineChart" height="280"></canvas>
                </div>
            </section>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('script')
    <script>
        var monychart = document.getElementById('lineChart').getContext('2d'),
         borrowchart = document.getElementById('mypieChart').getContext('2d');



        {{--var profit = document.getElementById('barchart').getContext('2d');--}}
        {{--var mybarChart = new Chart(profit, {--}}
        {{--    type: 'bar',--}}
        {{--    data: {--}}
        {{--        labels: [--}}
        {{--            @foreach($variables['profit'] as $profit)--}}
        {{--                '{{$profit->year}}-{{$profit->month}}',--}}
        {{--            @endforeach--}}
        {{--        ],--}}
        {{--        datasets: [{--}}
        {{--            label: '{{trans('trans.profit')}}',--}}
        {{--            data: [--}}
        {{--                @foreach($variables['profit'] as $profit)--}}
        {{--                {{$profit->deal_total-$profit->total}},--}}
        {{--                @endforeach--}}
        {{--            ],--}}
        {{--            backgroundColor: [--}}
        {{--                'rgba(255, 99, 132, 0.2)',--}}
        {{--                'rgba(54, 162, 235, 0.2)',--}}
        {{--                'rgba(255, 206, 86, 0.2)',--}}
        {{--                'rgba(75, 192, 192, 0.2)',--}}
        {{--                'rgba(153, 102, 255, 0.2)',--}}
        {{--                'rgba(255, 159, 64, 0.2)'--}}
        {{--            ],--}}
        {{--            borderColor: [--}}
        {{--                'rgba(255, 99, 132, 1)',--}}
        {{--                'rgba(54, 162, 235, 1)',--}}
        {{--                'rgba(255, 206, 86, 1)',--}}
        {{--                'rgba(75, 192, 192, 1)',--}}
        {{--                'rgba(153, 102, 255, 1)',--}}
        {{--                'rgba(255, 159, 64, 1)'--}}
        {{--            ],--}}
        {{--            borderWidth: 1--}}
        {{--        }]--}}
        {{--    },--}}
        {{--    options: {--}}
        {{--        scales: {--}}
        {{--            yAxes: [{--}}
        {{--                ticks: {--}}
        {{--                    beginAtZero: true--}}
        {{--                }--}}
        {{--            }]--}}
        {{--        }--}}
        {{--    }--}}
        {{--});--}}


        var mony = new Chart(monychart, {
            type: 'line',
            data: {
                labels: [
                    @foreach($variables['money'] as $mony)
                      '{{$mony->year}}-{{$mony->month}}',
                    @endforeach
                ],
                datasets: [{
                    label: '{{trans('trans.mony_data')}}',
                    fill:false,
                    data: [
                        @foreach($variables['money'] as $mony)
                            {{$mony->total}},
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 3
                }]
            },

            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },

            },
        });

        var borrow = new Chart(borrowchart, {
            type: 'line',
            data: {
                labels: [
                    @foreach($variables['emp_borrow'] as $borrow)
                        '{{$borrow->year}}-{{$borrow->month}}',
                    @endforeach
                ],
                datasets: [{
                    label: '{{trans('trans.borrows')}}',
                    data: [
                            @foreach($variables['emp_borrow'] as $borrow)
                            {{$borrow->total}},
                            @endforeach
                        ],
                    backgroundColor: [
                        '#FFC7AF'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 3
                }]
            },

            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },

            },
        });

    </script>


@endsection
