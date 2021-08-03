@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <button class="btn btn-default print"><i class="fa fa-print"></i> Print</button>
            <section class="invoice printthis">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-md-7">
                            <b class="padd">{{trans('trans.from')}}</b>
                            {{$variabls['data']['fromdate']}}
                            <b class="padd">{{trans('trans.to')}}</b>
                            {{$variabls['data']['todate']}}<br>
                        </div>
                        <div class="col-md-5"><i class="fa fa-globe"></i><strong>{{trans('trans.elmhlawy')}}</strong></div>
                    </div>
                    <!-- /.col -->
                </div>
                <hr>
                <!-- info row -->
                <div class="row invoice-info">
                    @if($variabls['data']['supplierId']!=0)
                        <div class="col-sm-4 invoice-col">
                            <strong>{{trans('trans.supplier_data')}}</strong>
                            <address>
                                <strong class="padd">{{trans('trans.company')}}</strong> : {{$variabls['supplier']->name}}<br>
                                <span style="margin-left: 10px"> <strong class="padd">{{trans('trans.responsible')}}</strong>: {{$variabls['supplier']->responsible}}</span><br>
                                <span style="margin-left: 10px"> <strong class="padd">{{trans('trans.tele')}}</strong> : {{$variabls['supplier']->mobile}}</span> <br>
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <address>
                                  <strong class="padd">{{trans('trans.total_paid')}}</strong> : {{$variabls['sum_paid']}} <br>
                                  <strong class="padd">{{trans('trans.mony_for_person')}}</strong> : {{$variabls['supplier']->balance}}
                            </address>
                        </div>
                    @endif
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-striped table-bordered table-responsive">
                            <thead>
                            <tr>
                                <td colspan="5" class="bg-gray">
                                    <p class="text-center">
                                        <strong>{{trans('trans.suppliers_paid')}}</strong>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>{{trans('trans.date')}}</td>
                                @if($variabls['data']['supplierId']==0)
                                    <td>{{trans('trans.company')}}</td>
                                @endif
                                <td>{{trans('trans.receiver')}}</td>
                                <td>{{trans('trans.value')}}</td>
                                <td>{{trans('trans.notes')}}</td>
                            </tr>
                            </thead>
                            <tbody>
                            @if($variabls['data']['supplierId']==0)
                                @foreach($variabls['suppliers_paid'] as $paid)
                                    <tr>
                                        <td>{{$paid->date}}</td>
                                        <td>{{$paid->getName()->name}}</td>
                                        <td>{{$paid->receiver}}</td>
                                        <td>{{$paid->value}}</td>
                                        <td>{{$paid->note}}</td>
                                    </tr>
                                @endforeach
                            @else
                                @foreach($variabls['suppliers_paid'] as $paid)
                                    <tr>
                                        <td>{{$paid->date}}</td>
                                        <td>{{$paid->receiver}}</td>
                                        <td>{{$paid->value}}</td>
                                        <td>{{$paid->note}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>

                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                        <h3 class="bg-info">
                            {{trans('trans.finaltotal')." : ".$variabls['sum_paid']}}
                        </h3>
                    </div>
                    <!-- /.col -->
                </div>
            </section>
            <!-- /.content -->
            <div class="clearfix"></div>

            {{--<div class="row">--}}
                {{--<div class="col-md-12">--}}
                    {{--<h5><button class="btn btn-default" onclick="$('#boxData').printThis()"><i class="fa fa-print"></i> Print</button></h5>--}}

                    {{--<div class="box" id="boxData">--}}
                        {{--<div class="box-header with-border bg-gray-light">--}}

                            {{--<p>Total remain balance: <strong>{{$sumbalance}}</strong></p>--}}
                            {{--<p>Total paid: <strong>{{$sumPaid}}</strong></p>--}}
                        {{--</div>--}}
                        {{--<br>--}}
                        {{--<div class="box-body">--}}
                            {{--<table class="table table-bordered table-striped">--}}
                                {{--<thead>--}}
                                    {{--<th>#</th>--}}
                                    {{--<th>date</th>--}}
                                    {{--<th>company</th>--}}
                                    {{--<th>receiver</th>--}}
                                    {{--<th>paid</th>--}}
                                    {{--<th>note</th>--}}
                                {{--</thead>--}}
                              {{--@foreach($suppliers_paid as $index=>$supplier_paid)--}}
                                  {{--<tr>--}}
                                      {{--<td>{{$index+1}}</td>--}}
                                      {{--<td>{{date('l',strtotime($supplier_paid->date))." | ". $supplier_paid->date}}</td>--}}
                                      {{--<td>{{$supplier_paid->getName()->name}}</td>--}}
                                      {{--<td>{{$supplier_paid->receiver}}</td>--}}
                                      {{--<td>{{$supplier_paid->value}}</td>--}}
                                      {{--<td>{{$supplier_paid->note}}</td>--}}
                                  {{--</tr>--}}
                              {{--@endforeach--}}
                            {{--</table>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<!-- /.box -->--}}
                {{--</div>--}}
            {{--</div>--}}
        </section>
        <!-- /.content -->
    </div>
@endsection

