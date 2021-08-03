@extends('dashbord.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               <button class="btn btn-default print"><i class="fa fa-print"></i> {{trans('trans.print')}}</button>
            </h1>
        </section>

        <!-- Main content -->
        <section class="invoice printthis">
            <!-- title row -->
            <div class="row">
                <div class="col-md-5"><strong style="display: inline-block">{{trans('trans.date')}}: {{$details->date}}</strong></div>
                <div class="col-md-7"><i class="fa fa-globe"></i>{{trans('trans.elmhlawy')}}</div>
                <!-- /.col -->
                <!-- /.col -->
            </div><hr><br>

            {{--<div class="row">--}}
                {{--<div class="col-xs-12">--}}
                    {{--<h2 class="page-header">--}}
                        {{--<i class="fa fa-globe"></i> AdminLTE, Inc.--}}
                        {{--<small class="pull-right">{{trans('trans.date')}}: {{$details->date}}</small>--}}
                    {{--</h2>--}}
                {{--</div>--}}
                {{--<!-- /.col -->--}}
            {{--</div>--}}
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    {{trans('trans.name')}} : <strong>{{$details->employee->name}}</strong>
                    <address>
                        {{trans('trans.address')}}  : {{$details->employee->address}}<br>
                        {{trans('trans.tele')}} : {{$details->employee->mobile}}
                    </address>
                </div>
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>{{trans('trans.work')}}</th>
                            <th>{{trans('trans.qty')}}</th>
                            <th>{{trans('trans.price')}}</th>
                            <th>{{trans('trans.finaltotal')}}</th>
                            <th>{{trans('trans.notes')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($details->productableDetails as $index=>$productable_detail)
                            <tr>
                                <td>{{$productable_detail->product}}</td>
                                <td>{{$productable_detail->qty}}</td>
                                <td>{{$productable_detail->unitprice}}</td>
                                <td>{{$productable_detail->subtotal}}</td>
                                <td>{{$productable_detail->note}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-xs-6">
                    <div class="table-responsive">
                        <table class="table">
                            <tr class="bg-info">
                                <th>{{trans('trans.finaltotal')}}:</th>
                                <td>{{$details->finaltotal}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <button class="print btn btn-default"><i class="fa fa-print"></i> {{trans('trans.print')}}</button>
                </div>
            </div>
        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
    <!-- /.content-wrapper -->
@endsection
