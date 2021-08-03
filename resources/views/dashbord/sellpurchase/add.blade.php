@extends('dashbord.master')
@section('content')
    <style>
        #paymentvalue{
            display: none;
        }
    </style>
    <div class="content-wrapper">
        <section class="content-header">
            <a href="{{route('purchaseInvoice.index')}}" class="btn btn-default" role="button"><i class="fa fa-chevron-circle-left"></i> {{trans("trans.back")}}</a>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans("trans.purchase")}}</a></li>
                <li class="active">{{trans("trans.add")}}</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="invoice printthis">
            <!-- title row -->
            <div class="row">
                <i class="fa fa-globe"></i> {{trans('trans.elmhlawy')}}
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <small>{{trans("trans.date")}}: {{Carbon\Carbon::now('Africa/Cairo')->toDateString()}}</small>
                    </h2>
                </div>

                <!-- /.col -->
            </div>
            {{--start Form -----------------------------------------------------------------}}
            <form action="{{route('customersalebill.index')}}" method="post" role="form">
            @csrf
            <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <label for="socialstatus"><strong>{{trans("trans.customers")}}</strong></label>
                        <select class="form-control select2" name="customer_id" id="socialstatus" style="width: 100%">
                            @foreach($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-sm-4 invoice-col">
                        <label for="recevier"><strong>{{trans("trans.date")}}</strong></label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="date" class="form-control pull-right datepicker" id="datepicker">
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
                    <table class="table table-striped table-responsive table-bordered" id="bill">
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
                                    <td><input type="number" name="tax" class="form-control" id="tax" autocomplete="off" placeholder="قيمه الضريبه بالنسبه المئويه"></td>
                                </tr>
                                <tr>
                                    <th>{{trans("trans.discount")}}:</th>
                                    <td><input type="number" name="discount" id="discount" class="form-control" autocomplete="off" placeholder="..قيمه الخصم"></td>
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

                        </h4>

                    </div>
                    <!-- /.col -->
                </div>
                <br><br>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-xs-12">
                        <button type="submit" id="submit" class="btn btn-lg btn-primary pull-left">{{trans("trans.submit")}}</button>
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
    <script>
        $('.datepicker').datepicker({
            autoclose: true,
            rtl: true,
            format:'yyyy-mm-dd'
        }).datepicker('setDate','now');
    </script>
    {{--<script>--}}
        {{--$("#submit").click(function (e) {--}}
            {{--e.preventDefault();--}}
            {{--var data = $("#formdata").serialize();--}}
            {{--$.ajax({--}}
                {{--method:'post',--}}
                {{--url:"{{route('purchaseInvoice.store')}}",--}}
                {{--data:data,--}}
                {{--success:function (response) {--}}
                    {{--if (response.status==true){--}}
                        {{--swal({--}}
                            {{--title: "{{trans("trans.done")}}",--}}
                            {{--text: "{{trans("trans.print_question")}}",--}}
                            {{--icon: "success",--}}
                            {{--buttons: true,--}}
                            {{--dangerMode: true,--}}
                        {{--})--}}
                            {{--.then((willDelete) => {--}}
                                {{--if (willDelete) {--}}
                                    {{--$("table").removeClass('table-bordered');--}}
                                    {{--$("#addrow,.hiderow").hide();--}}
                                    {{--$("select").attr('disabled','disabled');--}}
                                    {{--$("#payvalue").val()==''?$("#paymentvalue").hide():$("#paymentvalue").show();--}}

                                    {{--$('.printthis').printThis();--}}
                                {{--} else {--}}
                                    {{--$("#formdata")[0].reset();--}}
                                    {{--window.location.reload();--}}
                                {{--}--}}
                            {{--});--}}
                    {{--}--}}
                {{--},error:function (data_error,exception) {--}}
                    {{--if (exception=='error'){--}}
                        {{--var error_list='';--}}
                        {{--$.each(data_error.responseJSON.errors,function (key,value) {--}}
                            {{--error_list+='<li>'+value+'</li>';--}}
                        {{--});--}}
                        {{--$(".alert-error ").html("<ul>"+error_list+"</ul>");--}}
                    {{--}--}}
                {{--}--}}
            {{--})--}}
        {{--});--}}
    {{--</script>--}}
@endsection
