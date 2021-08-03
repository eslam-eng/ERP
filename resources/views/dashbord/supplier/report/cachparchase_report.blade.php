@extends('dashbord.master')
@section('content')
    <style>
        .padd{
            padding: 8px;
        }
    </style>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <button class="btn btn-default print"><i class="fa fa-print"></i> {{trans("trans.print")}}</button>
            <section class="invoice printthis">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-md-7">
                            <b class="padd">{{trans('trans.from')}}</b>
                            {{$variabls['date']['fromdate']}}
                            <b class="padd">{{trans('trans.to')}}</b>
                            {{$variabls['date']['todate']}}<br>
                        </div>
                        <div class="col-md-5"><i class="fa fa-globe"></i><strong>{{trans('trans.elmhlawy')}}</strong></div>
                    </div>
                    <!-- /.col -->
                </div>
                <hr>
                <!-- info row -->
                <div class="row invoice-info">
                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td colspan="5" class="bg-gray">
                                    <p class="text-center text-bold">
                                        {{trans('trans.purchases_supplier')." : ".trans('trans.cash')}}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td width="4%">#</td>
                                <td>{{trans('trans.company')}}</td>
                                <td>{{trans('trans.date')}}</td>
                                <td>{{trans('trans.receiver')}}</td>
                                <td>{{trans('trans.finaltotal')}}</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($variabls['purchases'] as $purchase)
                                <tr>
                                    <td>{{$purchase->id}}</td>
                                    <td>{{$purchase->supplier->name}}</td>
                                    <td>{{$purchase->date}}</td>
                                    <td>{{$purchase->employee->name}}</td>
                                    <td>{{$purchase->finaltotal}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="5">
                                    <h3 class="bg-info">{{trans('trans.total_purchase')}}:{{$variabls['sum_purchase']}}</h3>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
            <div class="clearfix"></div>
        </section>
        <!-- /.content -->
    </div>
@endsection

