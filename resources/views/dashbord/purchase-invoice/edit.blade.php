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
                <div class="col-md-4"><small class="pull-right" style="display: inline-block">{{trans('trans.date')}}: {{$purchaseinvoice->date}}</small></div>
                <div class="col-md-8"><i class="fa fa-globe text-danger"></i>{{trans('trans.elmhlawy')}}</div>
                <!-- /.col -->
            </div>
            <hr><br>
            {{--start Form -----------------------------------------------------------------}}
            <form action="{{route('purchaseInvoice.update',$purchaseinvoice->id)}}" method="post" role="form">
            @csrf
            @method('PUT')
            <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <label for="socialstatus"><strong>{{trans('trans.company')}}</strong></label>
                        <select class="form-control select2" name="supplier_id" id="socialstatus" style="width: 100%">
                            @foreach($suppliers as $supplier)
                                <option value="{{$supplier->id}}" {{$purchaseinvoice->supplier_id==$supplier->id?'selected':''}}>{{$supplier->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-sm-4 invoice-col">
                        <label for="recevier"><strong>{{trans('trans.receiver')}}</strong></label>
                        <select class="form-control select2" name="receiver" id="recevier" style="width: 100%">
                            @foreach($employees as $employee)
                                <option value="{{$employee->id}}" {{$purchaseinvoice->receiver==$employee->id?'selected':''}}>{{$employee->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- /.col -->
                    <div class="col-sm-2 invoice-col">
                        <label for="paytype"><strong>{{trans('trans.paytype')}}</strong></label>
                        <select class="form-control" name="paytype" id="paytype">
                            <option value="0" {{$purchaseinvoice->paytype==0?'selected':''}}>{{trans('trans.cash')}}</option>
                            <option value="-1" {{$purchaseinvoice->paytype==-1?'selected':''}}>{{trans('trans.pendding')}}</option>
                            <option value="1" {{$purchaseinvoice->paytype==1?'selected':''}}>{{trans('trans.somemony')}}</option>
                        </select>

                    </div>


                    <div class="col-sm-2 invoice-col" id="paymentvalue">
                        <label for="payvalue"><strong>Value</strong></label>
                        <input type="number" name="payvalue" id="payvalue" value="{{$purchaseinvoice->payvalue}}" class="form-control"  placeholder="Payment value">
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
                        @foreach($purchaseinvoice->purchaseInvoiceDetail as $index=>$purchasedetail)
                            <tr>
                                <td><input type="text" class="form-control name" name="product[]" value="{{$purchasedetail->product}}"></td>
                                <td><input type="number" min="1" value="{{$purchasedetail->qty}}" class="form-control qty" name="qty[]" autocomplete="off"></td>
                                <td><input type="number" class="form-control price" value="{{$purchasedetail->unitprice}}" name="unitprice[]" autocomplete="off"></td>
                                <td><input type="number" class="form-control subtotal" value="{{$purchasedetail->subtotal}}" name="subtotal[]" readonly></td>
                                <td><input type="text" class="form-control notes" name="note[]" value="{{$purchasedetail->note}}"></td>
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
