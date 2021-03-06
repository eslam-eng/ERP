@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <h5><a href="{{route('customer-Deal-order.index')}}" class="btn btn-default" role="button"><i class="fa fa-chevron-circle-left"></i> {{trans("trans.back")}}</a></h5>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans("trans.purchase")}}</a></li>
                <li class="active">{{trans("trans.add")}}</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="invoice printthis">
{{--        @include('dashbord.messageFlash.message')--}}
        <!-- title row -->
            <div class="row">
                <div class="col-md-4"><strong class="pull-right">{{trans("trans.date")}}: {{Carbon\Carbon::now('Africa/Cairo')->toDateString()}}</strong></div>
                <div class="col-md-8"><i class="fa fa-globe"></i><strong>{{trans('trans.elmhlawy')}}</strong></div>
            </div>
            <hr>
            {{--start Form -----------------------------------------------------------------}}
            <form  id="formdata" method="post" role="form" action="{{route('customer-Deal-order.store')}}">
            @csrf
            <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <label for="socialstatus"><strong>{{trans("trans.customers")}}</strong></label>
                        <select class="form-control" name="customer_id" id="customer" style="width: 100%">
                            <option value="0" selected>{{trans('trans.select_customer')}}</option>
                            @foreach($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <input type="hidden" id="payvalue" value="">
                    <div class="col-sm-4 invoice-col">
                        <label for="recevier"><strong>{{trans("trans.deals")}}</strong></label>
                        <select class="form-control" name="deal_id" id="customer_deals" style="width: 100%">
                            <option value="0" selected>{{trans('trans.deals')}}</option>
                            @foreach($customer_deals as $customer_deal)
                                <option class="remove d{{$customer_deal->customer_id}}" value="{{$customer_deal->id}}">{{$customer_deal->id." / ".$customer_deal->descdeal."/".$customer_deal->date}}</option>
                            @endforeach
                        </select>

                        @if($errors->has('deal_id'))
                            <h5 class="text-danger">
                                <strong>{{$errors->first('deal_id')}}</strong>
                            </h5>
                        @endif
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
                            <th width="3%"><button class="btn-sm btn-success no-border" id="addrow"><i class="fa fa-plus"></i></button></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="text" class="form-control name" name="product[]"></td>
                            <td><input type="number" min="1" value="1" class="form-control qty" name="qty[]" autocomplete="off"></td>
                            <td><input type="number" class="form-control price" name="unitprice[]" autocomplete="off"></td>
                            <td><input type="number" class="form-control subtotal" name="subtotal[]" readonly></td>
                            <td><input type="text" class="form-control notes" name="note[]"></td>
                            <td></td>
                        </tr>

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
                                    <td class="total"><input type="text" name="total" class="form-control" id="billsubtotal" readonly></td>
                                </tr>
                                <tr>
                                    <th>{{trans("trans.tax")}} : </th>
                                    <td><input type="number" name="tax" class="form-control" id="tax" autocomplete="off" placeholder="???????? ?????????????? ?????????????? ??????????????"></td>
                                </tr>
                                <tr>
                                    <th>{{trans("trans.discount")}}:</th>
                                    <td><input type="number" name="discount" id="discount" class="form-control" autocomplete="off" placeholder="..???????? ??????????"></td>
                                </tr>
                                <tr>
                                    <th>{{trans("trans.finaltotal")}}:</th>
                                    <td><input type="text" name="finaltotal" id="finaltotal" class="form-control" readonly></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-xs-6 pull-left">

                        <h4 class="alert-danger alert-error">
                            @if($errors->has('product'))
                                <h5 class="text-danger">
                                    <strong>{{$errors->first('product')}}</strong>
                                </h5>
                            @endif
                        </h4>

                    </div>
                    <!-- /.col -->
                </div>
                <br><br>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-xs-12">
                        <button type="submit" id="submit" class="btn btn-lg btn-primary">{{trans("trans.submit")}}</button>
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
