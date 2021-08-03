@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <button class="btn btn-primary"><i class="fa fa-print"></i> {{trans("trans.print")}}</button>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans("trans.purchase")}}</a></li>
                <li class="active">{{trans("trans.add")}}</li>
            </ol>
        </section>
        <!-- Main content -->
{{--        @include('dashbord.messageFlash.message')--}}
        <section class="invoice printthis">
            <!-- title row -->
            <div class="row">
                <div class="col-md-4"><small>{{trans("trans.date")}}: {{$deal_order->date}}</small></div>
                <div class="col-md-8"><i class="fa fa-globe"></i><strong>{{trans('trans.elmhlawy')}}</strong></div>
            </div>
            <hr>
            {{--start Form -----------------------------------------------------------------}}
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    {{trans('trans.customer_data')}}
                    <strong>
                        <address>
                            {{trans("trans.name")}} : <strong class="text text-bold">{{$deal->customer->name}}</strong><br>
                            {{trans('trans.tele')." : ".$deal->customer->mobile}}<br>
                            {{trans("trans.dept")}} : <strong class="text text-bold">{{$deal->customer->dept}}</strong><br>
                        </address>
                    </strong>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    {{trans('trans.deal_data')}}
                    <strong>
                        <address>
                            {{trans('trans.deal_num')." : ".$deal->id}}<br>
                            {{trans('trans.date')." : ".$deal->date}}<br>
                            {{trans('trans.somemony')." : ".$deal->somepaid}}<br>
                            {{trans('trans.finaltotal')." : ".$deal->dealtotal}}<br>
                        </address>
                    </strong>
                </div>

                <div class="col-sm-4 invoice-col bg-green-active">
                   <label class="text text-bold"><strong>{{trans('trans.profit')}}</strong></label><br>
                    <strong>
                      {{$deal->dealtotal-($deal_order->total/100*$deal_order->tax+$deal_order->total-$deal_order->discount)}} <br>
                    </strong>
                </div>
            </div>
                <br><br>
                <!-- /.row -->

                <!-- Table row -->
                <div class="table-responsive">
                    <table class="table table-striped table-responsive table-bordered" id="bill">
                        <thead>
                        <tr>
                            <th width="30%">{{trans("trans.product")}}</th>
                            <th>{{trans("trans.qty")}}</th>
                            <th>{{trans("trans.price")}}</th>
                            <th>{{trans("trans.finaltotal")}}</th>
                            <th>{{trans("trans.notes")}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($deal_order->dealOrderDetail as $index=>$order_detail)
                            <tr>
                                <td>{{$order_detail->product}}</td>
{{--                                <td><p  class="form-control name">{{$order_detail->product}}</p></td>--}}
                                <td>{{$order_detail->qty}}</td>
                                <td>{{$order_detail->price}}</td>
                                <td>{{$order_detail->subtotal}}</td>
                                <td>{{$order_detail->note}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-6 pull-right">
                        <div class="table-responsive">
                            <table class="table" id="tfooter">
                                <tr>
                                    <th style="width:50%">{{trans("trans.finaltotal")}}:</th>
                                    <td class="total"><p type="text" class="form-control">{{$deal_order->total}}</p></td>
                                </tr>
                                <tr>
                                    <th>{{trans("trans.tax")}} : </th>
                                    <td><p type="number" name="tax" class="form-control">{{$deal_order->tax}}</p></td>
                                </tr>
                                <tr>
                                    <th>{{trans("trans.discount")}}:</th>
                                    <td><p type="number" class="form-control">{{$deal_order->discount}}</p></td>
                                </tr>
                                <tr>
                                    <th>{{trans("trans.finaltotal")}}:</th>
                                    <td><p class="form-control">{{$deal_order->total/100*$deal_order->tax+$deal_order->total-$deal_order->discount}}</p></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <br><br>
                <!-- /.row -->
        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
@endsection

