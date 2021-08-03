@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        {{--{{$purchaseinvoice}}--}}
        <section class="content-header">
            <button class="btn btn-primary" role="button"><i class="fa fa-print"></i> {{trans('trans.print')}}</button>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>{{trans('trans.purchases_data')}}</a></li>
                <li class="active">{{trans('trans.show_data')}}</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="invoice printthis">
            <!-- title row -->
            <div class="row">
                <div class="col-md-4"><strong class="pull-right" style="display: inline-block">{{trans('trans.date')}}<br>{{$saleinvoice->date}}</strong>
                    {{--<br>{{trans('trans.elmhlawy')}}--}}
                </div>
                <div class="col-md-8">
                    <img class="pull-left img img-fluid" src="{{asset('upload/logomm.png')}}" width="250" style="margin: -10px">
                </div>
        {{--start Form -----------------------------------------------------------------}}
        <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <hr>
                    <label for="socialstatus"><strong>{{trans('trans.customer_data')}}</strong></label>
                    <p class="text-body">
                        {{trans('trans.name')." : ".$saleinvoice->customers->name}}
                    </p>
                    <p class="text-bold">
                        {{trans('trans.tele')." : ".$saleinvoice->customers->mobile}}
                    </p>
                    <p class="text-bold">
                        {{trans('trans.address')." : ".$saleinvoice->customers->address}}
                    </p>
                </div>
            </div>
            <br><br>
            <!-- /.row -->

            <!-- Table row -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="bill">
                    <thead>
                    <tr>
                        <th>{{trans("trans.product")}}</th>
                        <th>{{trans("trans.qty")}}</th>
                        <th>{{trans("trans.price")}}</th>
                        <th>{{trans("trans.finaltotal")}}</th>
                        <th width="40%">{{trans("trans.notes")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($saleinvoice->saleInvoiceDetail as $index=>$salepurchasedetail)
                        <tr>
                            <td>{{$salepurchasedetail->product}}</td>
                            <td>{{$salepurchasedetail->qty}}</td>
                            <td>{{$salepurchasedetail->unitprice}}</td>
                            <td>{{$salepurchasedetail->subtotal}}</td>
                            <td>{{$salepurchasedetail->note}}</td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-xs-6 pull-right">
                    <div class="table-responsive">
                        <table class="table" id="tfooter">
                            <tr>
                                <th style="width:50%">{{trans("trans.finaltotal")}}:</th>
                                <td class="total"><p>{{$saleinvoice->total}}</p></td>
                            </tr>
                            <tr>
                                <th>{{trans("trans.tax")}} : </th>
                                <td> <p>{{$saleinvoice->tax}}</p></td>
                            </tr>
                            <tr>
                                <th>{{trans("trans.discount")}} : </th>
                                <td><p>{{$saleinvoice->discount}}</p></td>
                            </tr>
                            <tr>
                                <th>{{trans("trans.finaltotal")}} : </th>
                                <td><p>{{$saleinvoice->finaltotal}}</p></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <br><br>
            </div>
        </section>

        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
@endsection
{{-------------------------------------------------------}}

