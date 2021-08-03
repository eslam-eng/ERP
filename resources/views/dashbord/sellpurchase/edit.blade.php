@extends('dashbord.master')
@section('content')
    <style>
        #paymentvalue{
            display: none;
        }
    </style>
    <div class="content-wrapper">
        <section class="content-header">
            <a href="{{route('purchaseInvoice.index')}}" class="btn btn-default" role="button"><i class="fa fa-chevron-circle-left"></i> {{trans('trans.back')}}</a>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans('trans.purchases_data')}}</a></li>
                <li class="active">{{trans('trans.update_purchase_invoice')}}</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-md-4"><small class="pull-right" style="display: inline-block">{{trans('trans.date')}}: {{$customerbill->date}}</small></div>
                <div class="col-md-8"><i class="fa fa-globe text-danger"></i>{{trans('trans.elmhlawy')}}</div>
                <!-- /.col -->
            </div>
            <hr><br>
            {{--start Form -----------------------------------------------------------------}}
            <form action="{{route('customersalebill.update',$customerbill->id)}}" method="post" role="form">
            @csrf
            @method('PUT')
            <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <label for="socialstatus"><strong>{{trans("trans.customers")}}</strong></label>
                        <select class="form-control" name="customer_id" id="socialstatus" style="width: 100%">
                                <option value="{{$customerbill->customer_id}}">{{$customerbill->customers->name}}</option>
                        </select>
                    </div>


                    <div class="col-sm-4 invoice-col">
                        <label for="recevier"><strong>{{trans("trans.date")}}</strong></label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="date" value="{{$customerbill->date}}" class="form-control pull-right datepicker" id="datepicker">
                        </div>
                    </div>

                    <div class="col-sm-2 invoice-col" id="paymentvalue">
                        <label for="payvalue"><strong>{{trans("trans.pay_value")}}</strong></label>
                        <input type="number" name="payvalue" id="payvalue" class="form-control">
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
                            <th>{{trans("trans.notes")}}</th>
                            <th><button class="btn-sm btn-success no-border" id="addrow"><i class="fa fa-plus"></i></button></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customerbill->saleInvoiceDetail as $index=>$customerbilldetail)
                            <tr>
                                <td><input type="text" class="form-control name" name="product[]" value="{{$customerbilldetail->product}}"></td>
                                <td><input type="number" min="1" value="{{$customerbilldetail->qty}}" class="form-control qty" name="qty[]" autocomplete="off"></td>
                                <td><input type="number" class="form-control price" value="{{$customerbilldetail->unitprice}}" name="unitprice[]" autocomplete="off"></td>
                                <td><input type="number" class="form-control subtotal" value="{{$customerbilldetail->subtotal}}" name="subtotal[]" readonly></td>
                                <td><input type="text" class="form-control notes" name="note[]" value="{{$customerbilldetail->note}}"></td>
                                <td><button class="btn-sm btn-danger no-border hideRow"><i class="fa fa-close"></i></button></td>
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
                                    <td class="total"><input type="text" name="total" class="form-control" value="{{$customerbill->total}}" id="billsubtotal" readonly></td>
                                </tr>
                                <tr>
                                    <th>{{trans("trans.tax")}} : </th>
                                    <td><input type="number" name="tax" class="form-control" id="tax" value="{{$customerbill->tax}}" autocomplete="off" placeholder="قيمه الضريبه بالنسبه المئويه"></td>
                                </tr>
                                <tr>
                                    <th>{{trans("trans.discount")}} : </th>
                                    <td><input type="number" name="discount" id="discount" class="form-control" value="{{$customerbill->discount}}" autocomplete="off" placeholder="..قيمه الخصم"></td>
                                </tr>
                                <tr>
                                    <th>{{trans("trans.finaltotal")}} : </th>
                                    <td><input type="text" name="finaltotal" id="finaltotal" class="form-control" value="{{$customerbill->finaltotal}}" readonly></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <br><br>
                <!-- /.row -->
                <div class="row no-print">
                    <div class="col-xs-12">
                        <button type="submit" id="submit" class="btn btn-lg btn-primary">{{trans("trans.update")}}</button>
                    </div>
                </div>
            </form>

        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
@endsection
{{-------------------------------------------------------}}
@section('script')
    <script src="{{asset('dashbord/dist/js/purchase_invoice.js')}}"></script>
@endsection
