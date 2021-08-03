@extends('dashbord.master')
@section('content')
    <meta name="csrf-token" content="{{csrf_token()}}">
        <style>
            .padd{
                padding: 8px;
            }
        </style>
    <div class="content-wrapper">
        <!-- Main content -->
            <section class="content">
            <section class="content-header">
                <div class="row no-print">
                    <div class="col-xs-12">
                        <button  class=" print btn btn-default"><i class="fa fa-print"></i> {{trans('trans.print')}}</button>
                    </div>
                </div>
            </section>
            <section class="invoice printthis">
                <!-- title row -->
                <div class="row">
                    <div class="col-md-7">
                        <i class="fa fa-globe"></i> <strong>{{trans('trans.elmhlawy')}}</strong>
                    </div>
                    <div class="col-md-5">
                        <strong>
                            <b class="padd">{{trans('trans.date')}}:</b>
                            {{$variabls['date']}}
                        </strong>
                    </div>
                    <!-- /.col -->
                </div>
                <br>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="text-info">{{trans('trans.mony_data')}}</h3>
                        </div>
                        <div class="box-footer">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <td>{{trans('trans.mony')}}</td>
                                        <td>{{trans('trans.from')}}</td>
                                        <td>{{trans('trans.to')}}</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($variabls['mony'] as $mony)
                                        <tr>
                                            <td>{{$mony->value}}</td>
                                            <td>{{$mony->from}}</td>
                                            <td>{{$mony->to}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-sm-4 invoice-col bg-info">
                                <address>
                                    <h4>{{trans('trans.sum_mony')}} : {{$variabls['sum_mony']}}</h4>
                                    <h4>{{trans('trans.remain_mony')}} : {{$variabls['sum_mony']-($variabls['sum_borrows']+$variabls['sum_suppliers_paid']+$variabls['sum_purchase_values']+$variabls['sum_dalily_expense'])}}</h4>
                                </address>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <hr>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-striped table-responsive">
                            <tr class="bg-gray">
                                <td >
                                    <p class="text-right text-bold">
                                        {{trans('trans.employees_expense')}}
                                    </p>
                                </td>
                                <td>{{$variabls['sum_borrows']."L.E "}}</td>
                            </tr>
                        </table>
                        @if(count($variabls['dalily_expense']))
                            <table class="table table-striped">
                                <thead>
                                    <tr class="bg-gray">
                                        <td colspan="4">
                                            <p class="text-right text-bold">
                                                <strong>{{trans('trans.generalexpense')}}</strong>
                                            </p>
                                        </td>
                                        <td>{{$variabls['sum_dalily_expense']}}L.E</td>
                                    </tr>
                                <tr>
                                    <td></td>
                                    <td>{{trans('trans.value')}}</td>
                                    <td>{{trans('trans.maker')}}</td>
                                    <td colspan="2">{{trans('trans.notes')}}</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($variabls['dalily_expense'] as $g_expense)
                                    <tr>
                                        <td>{{$g_expense->genralexpense }}</td>
                                        <td>{{$g_expense->value }}</td>
                                        <td>{{$g_expense->maker }}</td>
                                        <td colspan="2">{{$g_expense->note}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    {{--Start suppliers paid --}}

                    @if(count($variabls['suppliers_paid']))
                        <div class="col-xs-12">
                            <table class="table table-striped">
                                <thead>
                                <tr class="bg-gray">

                                    <td colspan="4">
                                        <p class="text-right text-bold">
                                            <strong>{{trans('trans.suppliers_paid')}}</strong>
                                        </p>
                                    </td>
                                    <td>{{$variabls['sum_suppliers_paid']}}L.E</td>
                                </tr>
                                <tr>
                                    <td>{{trans('trans.company')}}</td>
                                    <td>{{trans('trans.receiver')}}</td>
                                    <td>{{trans('trans.value')}}</td>
                                    <td>{{trans('trans.notes')}}</td>
{{--                                    <td>{{trans('trans.balance')}}</td>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($variabls['suppliers_paid'] as $suplier_paid)
                                    <tr>
                                        <td>{{$suplier_paid->getName()->name}}</td>
                                        <td>{{$suplier_paid->receiver}}</td>
                                        <td>{{$suplier_paid->value}}</td>
                                        <td>{{$suplier_paid->note}}</td>
{{--                                        <td class="{{$suplier_paid->getName()->balance<0?'bg-red':''}}">{{$suplier_paid->getName()->balance}}</td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                @endif

                    {{--Start purchases Invoices (cach or Some Paid)--}}
                    @if(count($variabls['purchase_invoices']))
                        <div class="col-xs-12">
                            <table class="table table-striped">
                                <thead>
                                <tr class="bg-gray">
                                    <td colspan="4">
                                        <p class="text-right text-bold">
                                            <strong>{{trans('trans.purchases_supplier')}}</strong>
                                        </p>
                                    </td>
                                    <td>{{$variabls['sum_purchase_values']}}L.E</td>
                                </tr>
                                <tr>
                                    <td>{{trans('trans.company')}}</td>
                                    <td>{{trans('trans.finaltotal')}}</td>
                                    <td>{{trans('trans.discount')}}</td>
                                    <td>{{trans('trans.tax')}}</td>
                                    <td>{{trans('trans.finaltotal')}}</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($variabls['purchase_invoices'] as $purchase_invoice)
                                    <tr>
                                        <td>{{$purchase_invoice->Supplier->name}}</td>
                                        <td>{{$purchase_invoice->total}}</td>
                                        <td>{{$purchase_invoice->discount}}</td>
                                        <td>{{$purchase_invoice->tax}}</td>
                                        <td>{{$purchase_invoice->finaltotal}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                @endif
                    <!-- /.col -->
                </div>
            </section>
            <!-- /.content -->
            <div class="clearfix"></div>
        </section>
        <!-- /.content -->
    </div>
        <!-- /.content -->
@endsection
