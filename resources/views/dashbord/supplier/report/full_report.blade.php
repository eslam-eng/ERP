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
                    <div class="col-sm-4 invoice-col">
                        <strong>{{trans('trans.supplier_data')}}</strong>
                        <address>
                            <strong class="padd">{{trans('trans.company')}}</strong> : {{$variabls['supplier']->name}}<br>
                            <strong class="padd">{{trans('trans.responsible')}}</strong>: {{$variabls['supplier']->responsible}}<br>
                            <strong class="padd">{{trans('trans.tele')}}</strong> : {{$variabls['supplier']->mobile}}<br>
                        </address>
                    </div>


                    <div class="col-sm-4 invoice-col">
                        <address>
                            <strong class="padd">{{trans('trans.total_paid')}}</strong> : {{$variabls['sum_paid']}}<br>
                            <strong class="padd">{{trans('trans.total_purchase')}}</strong>: {{$variabls['sum_purchase']}}<br><br>
                            <strong class="padd bg-info">{{trans('trans.balance')." : ".$variabls['supplier']->balance}}</strong>
                        </address>
                    </div>


                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td colspan="4" class="bg-gray">
                                        <p class="text-center">
                                            <strong>{{trans('trans.suppliers_paid')}}</strong>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{trans('trans.date')}}</td>
                                    <td>{{trans('trans.receiver')}}</td>
                                    <td>{{trans('trans.value')}}</td>
                                    <td>{{trans('trans.notes')}}</td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($variabls['catch_receipts'] as $paid)
                                <tr>
                                    <td>{{$paid->date}}</td>
                                    <td>{{$paid->receiver}}</td>
                                    <td>{{$paid->value}}</td>
                                    <td>{{$paid->note}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td colspan="4" class="bg-gray">
                                    <p class="text-center text-bold">
                                        {{trans('trans.purchases_supplier')}}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>{{trans('trans.date')}}</td>
                                <td>{{trans('trans.receiver')}}</td>
                                <td>{{trans('trans.finaltotal')}}</td>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($variabls['purchases'] as $purchase)
                                <tr>
                                    <td>{{$purchase->id}}</td>
                                    <td>{{$purchase->date}}</td>
                                    <td>{{$purchase->employee->name}}</td>
                                    <td>{{$purchase->finaltotal}}</td>
                                </tr>
                            @endforeach
                            </tbody>
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

