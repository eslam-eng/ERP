@extends('dashbord.master')
@section('content')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="alert-danger alert-error">

            </div>
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <h4 class="text-center">
                           {{trans("trans.supplier_paid")}}
                            <small>{{trans("trans.report")}}</small>
                        </h4>

                        {{--action="{{route('expenses.report')}}"--}}
                        <form  action="{{route('supplier.payments.report')}}" class="form-horizontal" id="form" role="form" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">{{trans("trans.name")}}</label>
                                <div class="col-sm-9">
                                    <select name="supplierId" id="supplierId" class="form-control select2">
                                        <option value="0">{{trans("trans.suppliers")}}</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    @if($errors->has('supplierId'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('supplierId')}}</strong>
                                        </h5>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDate" class="col-sm-2 control-label">{{trans("trans.from")}}</label>
                                <div class="col-sm-4">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="fromdate" class="form-control pull-right datepicker" id="fromdate">
                                    </div>
                                </div>

                                <label for="inputDate" class="col-sm-1 control-label">{{trans("trans.to")}}</label>
                                <div class="col-sm-4">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="todate" class="form-control pull-right datepicker" id="todate">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    @if($errors->has('fromdate'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('fromdate')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="col-md-5">
                                    @if($errors->has('todate'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('todate')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-10 col-sm-2 pull-left">
                                    <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-search"></i> {{trans("trans.search")}}</button>
                                </div>
                            </div>
                            <br>
                        </form>

                    </div>
                    <!-- /.box -->
                </div>
                <!--/.col (left) -->
            </div>

        </section>
    </div>
@endsection

@section('script')
    <script>
        $('.datepicker').datepicker({
            autoclose: true,
            rtl: true,
            format:'yyyy-mm-dd'
        }).datepicker('setDate','now');
    </script>
    {{--<script src="{{asset('dashbord/dist/js/printThis.js')}}"></script>--}}
    {{--<script>--}}
        {{--$('#myreport').css('display','none');--}}
        {{--$("#submit").click(function (e) {--}}
            {{--e.preventDefault();--}}
            {{--var  data = $("#form").serialize();--}}
            {{--$.ajax({--}}
                {{--url:"{{route('expenses.report')}}",--}}
                {{--method:"post",--}}
                {{--dataType:'json',--}}
                {{--data:data,--}}
                {{--success:function (data) {--}}
                    {{--if (data.status==true){--}}
                        {{--$('#myreport').css('display','block');--}}
                        {{--$("#myreport .contentTable").html(data.result);--}}
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
            {{--});--}}
        {{--});--}}

        {{--$("#print").click(function () {--}}
            {{--$('#myreport table').printThis()--}}
        {{--});--}}
    {{--</script>--}}
@endsection

