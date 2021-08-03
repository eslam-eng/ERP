@extends('dashbord.master')
@section('content')
    <style>
        .padd{
            padding: 10px;
        }
    </style>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content-header">
            <div class="row no-print">
                <div class="col-xs-12">
                    <button class="print btn btn-default"><i class="fa fa-print"></i> {{trans('trans.print')}}</button>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="invoice printthis">
            <!-- title row -->
            <div class="row">
                <div class="col-md-5"><strong style="display: inline-block">{{trans('trans.date')}}: {{$variabls['date']['todate']}}</strong></div>
                <div class="col-md-7"><i class="fa fa-globe"></i>{{trans('trans.elmhlawy')}}</div>
                <!-- /.col -->
                <!-- /.col -->
            </div><hr><br>

            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <address>
                        <h3 class="text-bold bg-info">{{trans('trans.total_production_work')}}: {{$variabls['finaltotal']}}</h3>
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
                            <th>{{trans('trans.date')}}</th>
                            <th>{{trans('trans.name')}}</th>
                            <th>{{trans('trans.finaltotal')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($variabls['productabls'] as $productabl)
                            <tr>
                                <th>{{$productabl->date}}</th>
                                <th>{{$productabl->employee->name}}</th>
                                <th>{{$productabl->finaltotal}}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <button class="print btn btn-default"><i class="fa fa-print"></i> {{trans('trans.print')}}</button>
                </div>
            </div>
        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- /.content -->
    </div>
@endsection
