@extends('dashbord.master')
@section('content')
    {{--<style>--}}
        {{--#paymentvalue{--}}
            {{--display: none;--}}
        {{--}--}}
    {{--</style>--}}
    <div class="content-wrapper">
        {{--{{$purchaseinvoice}}--}}
        <section class="content-header">
            <a href="{{route('purchaseInvoice.index')}}" class="btn btn-default" role="button"><i class="fa fa-chevron-circle-left"></i> {{trans('trans.back')}}</a>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>{{trans('trans.purchases_data')}}</a></li>
                <li class="active">{{trans('trans.show_data')}}</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                    <div class="col-md-4"><small class="pull-right" style="display: inline-block">{{trans('trans.date')}}: {{$purchaseinvoice->date}}</small></div>
                    <div class="col-md-8"><i class="fa fa-globe text-danger"></i>{{trans('trans.elmhlawy')}}</div>
                    <!-- /.col -->
                <!-- /.col -->
            </div><hr><br>
            {{--start Form -----------------------------------------------------------------}}
            <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <label for="socialstatus"><strong>{{trans('trans.company')}}</strong></label>
                        <p class="form-control" name="supplier_id" id="socialstatus">
                            {{$purchaseinvoice->Supplier->name}}
                        </p>
                    </div>


                    <div class="col-sm-4 invoice-col">
                        <label for="recevier"><strong>{{trans('trans.receiver')}}</strong></label>
                        <p class="form-control" name="receiver" id="recevier">
                            <strong>{{$purchaseinvoice->employee->name}}</strong>
                        </p>
                    </div>

                    <!-- /.col -->
                    <div class="col-sm-2 invoice-col">
                        <label for="paytype"><strong>{{trans('trans.paytype')}}</strong></label>
                        <select class="form-control" name="paytype" id="paytype" disabled>
                            <option value="0" {{$purchaseinvoice->paytype==0?'selected':''}}>{{trans('trans.cash')}}</option>
                            <option value="-1" {{$purchaseinvoice->paytype==-1?'selected':''}}>{{trans('trans.pendding')}}</option>
                            <option value="1" {{$purchaseinvoice->paytype==1?'selected':''}}>{{trans('trans.somemony')}}</option>
                        </select>

                    </div>

                @if($purchaseinvoice->payvalue!='')
                        <div class="col-sm-2 invoice-col">
                            <label for="recevier"><strong>{{trans('trans.somemony')}}</strong></label>
                            <p class="form-control" name="receiver" id="recevier">
                                <strong>{{$purchaseinvoice->payvalue}}</strong>
                            </p>
                        </div>
                @endif

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
                        @foreach($purchaseinvoice->purchaseInvoiceDetail as $index=>$purchasedetail)
                            <tr>
                                <td>{{$purchasedetail->product}}</td>
                                <td>{{$purchasedetail->qty}}</td>
                                <td>{{$purchasedetail->unitprice}}</td>
                                <td>{{$purchasedetail->subtotal}}</td>
                                <td>{{$purchasedetail->note}}</td>
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
                                    <td class="total"><input type="text" name="total" class="form-control" value="{{$purchaseinvoice->total}}" id="billsubtotal" readonly></td>
                                </tr>
                                <tr>
                                    <th>{{trans("trans.tax")}} : </th>
                                    <td><input type="number" name="tax" class="form-control" id="tax" value="{{$purchaseinvoice->tax}}" autocomplete="off" placeholder="قيمه الضريبه بالنسبه المئويه"></td>
                                </tr>
                                <tr>
                                    <th>{{trans("trans.discount")}} : </th>
                                    <td><input type="number" name="discount" id="discount" class="form-control" value="{{$purchaseinvoice->discount}}" autocomplete="off" placeholder="..قيمه الخصم"></td>
                                </tr>
                                <tr>
                                    <th>{{trans("trans.finaltotal")}} : </th>
                                    <td><input type="text" name="finaltotal" id="finaltotal" class="form-control" value="{{$purchaseinvoice->finaltotal}}" readonly></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <br><br>
                <!-- /.row -->
{{--            @if(count($purchaseinvoice->returnItems)>0)--}}
{{--                <div class="box">--}}
{{--                <div class="box-header bg-red-active text-center">--}}
{{--                    <h4>{{trans('trans.return_items')}}</h4>--}}
{{--                </div>--}}
{{--                <div class="box-body">--}}
{{--                    <table class="table table-striped">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>{{trans("trans.product")}}</th>--}}
{{--                            <th>{{trans("trans.qty")}}</th>--}}
{{--                            <th>{{trans("trans.price")}}</th>--}}
{{--                            <th>{{trans("trans.finaltotal")}}</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach($purchaseinvoice->returnItems as $item)--}}
{{--                            <tr>--}}
{{--                                <td>{{$item->product}}</td>--}}
{{--                                <td>{{$item->qty}}</td>--}}
{{--                                <td>{{$item->unitprice}}</td>--}}
{{--                                <td>{{$item->subtotal}}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @endif--}}

{{--            <div class="row">--}}
{{--                <div class="col-xs-6 pull-right">--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table">--}}
{{--                            <tr class="bg-blue-gradient">--}}
{{--                                <th>{{trans("trans.total_after_return_items")}} : </th>--}}
{{--                                <td>{{$purchaseinvoice->finaltotal-$purchaseinvoice->payvalue-$sum_return_items}}</td>--}}
{{--                            </tr>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- /.col -->--}}
{{--            </div>--}}
        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
@endsection
{{-------------------------------------------------------}}

