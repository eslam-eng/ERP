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
                <div class="col-md-5">
                    <p style="display: inline-block">
                        {{trans('trans.date')}}:  {{$variabls['date']['todate']}} <strong class="padd">{{trans('trans.to')}}</strong> {{$variabls['date']['fromdate']}}
                    </p>
                </div>
                <div class="col-md-7"><i class="fa fa-globe"></i>{{trans('trans.elmhlawy')}}</div>
                <!-- /.col -->
                <!-- /.col -->
            </div><hr><br>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    {{trans('trans.name')}} : <strong>{{$variabls['employee']->name}}</strong>
                    <address>
                        {{trans('trans.address')}} :  {{$variabls['employee']->address}}<br>
                        {{trans('trans.tele')}} : {{$variabls['employee']->mobile}}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <address>
                        <h3 class="text-bold bg-info">{{trans('trans.total_production_work')}} : {{$variabls['finaltotal']}}</h3>
                    </address>
                </div>
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <tbody>
                        @foreach($variabls['productabls'] as $productabl)
                            <tr>
                                <td class="bg-info" colspan="3">{{$productabl->date}}</td>
                                <td class="bg-info" colspan="3"> {{$productabl->desc_work}} </td>
                                <td class="bg-info" colspan="2">{{$productabl->finaltotal}} </td>
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
