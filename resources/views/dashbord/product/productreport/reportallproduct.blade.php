{{--@extends('dashbord.master')--}}
{{--@section('content')--}}
{{--    <div class="content-wrapper">--}}
{{--        <!-- Main content -->--}}
{{--        <section class="content">--}}
{{--            <div class="box">--}}
{{--                <div class="box-header bg-info">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-5">--}}
{{--                            <small>--}}
{{--                                <b class="padd">{{trans('trans.from')}}</b>--}}
{{--                                {{$data['fromdate']}}--}}
{{--                                <b class="padd">{{trans('trans.to')}}</b>--}}
{{--                                {{$data['todate']}}--}}
{{--                            </small>--}}
{{--                        </div>--}}

{{--                        <div class="col-md-7">--}}
{{--                            <i class="fa fa-globe"></i> <strong>{{trans('trans.elmhlawy')}}</strong>--}}
{{--                        </div>--}}
{{--                        <!-- /.col -->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <hr><br>--}}
{{--                <div class="box-body">--}}
{{--                    <table class="table table-bordered table-striped">--}}
{{--                        <thead style="background-color: darkgray!important;color: #ffffff">--}}
{{--                        <tr>--}}
{{--                            <td width="2%">#</td>--}}
{{--                            <td>{{trans('trans.name')}}</td>--}}
{{--                            <td>{{trans('trans.current_qty')}}</td>--}}
{{--                            <td>{{trans('trans.onestore')}}</td>--}}
{{--                            <td>{{trans('trans.qty_added')}}</td>--}}
{{--                            <td>{{trans('trans.qty_inorders')}}</td>--}}
{{--                            <td>{{trans('trans.product_allqty')}}</td>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach($products_data as $index=>$product)--}}
{{--                            <tr>--}}
{{--                                <td>{{$index+1}}</td>--}}
{{--                                <td>{{$product->name}}</td>--}}
{{--                                <td>{{$product->qty}}</td>--}}
{{--                                <td>{{$product->getStoreInfo()->name}}</td>--}}
{{--                                <td>--}}
{{--                                    @php($amount_added=0)--}}
{{--                                    @foreach($product->productAdded as $product_added)--}}
{{--                                        @php($amount_added+=$product_added->amount)--}}
{{--                                    @endforeach--}}
{{--                                    {{$amount_added}}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    @php($amount=0)--}}
{{--                                    @foreach($product->productorder as $product_order)--}}
{{--                                        @php($amount+=$product_order->amount)--}}
{{--                                    @endforeach--}}
{{--                                    {{$amount}}--}}
{{--                                </td>--}}
{{--                                <td>{{$product->qty+$amount}}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}

{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="clearfix"></div>--}}
{{--        </section>--}}
{{--        <!-- /.content -->--}}
{{--    </div>--}}
{{--@endsection--}}
{{--@section('script')--}}
{{--    <script>--}}
{{--        $(document).ready(function(){--}}
{{--            window.print();--}}
{{--        });--}}
{{--    </script>--}}

{{--@endsection--}}



<!DOCTYPE html>
<html>
<?php
$total_added = 0;
$total_out = 0;
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ELMAHALLAWY</title>
    <link rel="stylesheet" href="{{asset('dashbord/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashbord/dist/css/rtl/bootstrap-rtl.min.css')}}"/>

    <style>
        @media print {
            .noprint {
                visibility: hidden;
            }
        }
        button
        {
            width: 150px;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <h3> <button id="print" class="btn btn-primary noprint">print</button></h3>
            </div>
        </div>
        <!-- Main content -->
        <section class="content printthis">
            <div class="box">
                <div class="box-header bg-info" style="padding: 10px">
                    <div class="row">
                        <div class="col-md-5">
                            <small>
                                <b class="padd">{{trans('trans.from')}}</b>
                                {{$data['fromdate']}}
                                <b class="padd">{{trans('trans.to')}}</b>
                                {{$data['todate']}}
                            </small>
                        </div>

                        <div class="col-md-7">
                            <i class="fa fa-globe"></i> <strong>{{trans('trans.elmhlawy')}}</strong>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <hr><br>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <td width="2%">#</td>
                            <td>{{trans('trans.name')}}</td>
                            <td>{{trans('trans.current_qty')}}</td>
                            <td>{{trans('trans.onestore')}}</td>
                            <td>{{trans('trans.qty_added')}}</td>
                            <td>{{trans('trans.qty_inorders')}}</td>
                            <td>{{trans('trans.product_allqty')}}</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products_data as $index=>$product)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->qty}}</td>
                                <td>{{$product->getStoreInfo()->name}}</td>
                                <td>
                                    @php($amount_added=0)
                                    @foreach($product->productAdded as $product_added)
                                        @php($amount_added+=$product_added->amount)
                                    @endforeach
                                    {{$amount_added}}
                                </td>
                                <td>
                                    @php($amount=0)
                                    @foreach($product->productorder as $product_order)
                                        @php($amount+=$product_order->amount)
                                    @endforeach
                                    {{$amount}}
                                </td>
                                <td>{{$product->qty+$amount}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="clearfix"></div>
        </section>
        <!-- /.content -->
    </div>
</div>

<!-- jQuery 3 -->
<script src="{{asset('dashbord/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('dashbord/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<script src="{{asset('dashbord/dist/js/printThis.js')}}"></script>
<script>
    $(document).ready(function(){
        window.print()

        $("#print").click(function () {
            $('.printthis').printThis({
                importCSS: true,
                debug: false,
                // header: $('.hidden-print-header-content'),
                // footer: $('.hidden-print-header-content')
            });
        });

    })
</script>
</body>
</html>

