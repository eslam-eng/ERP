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
                            {{trans("trans.customers_paid_report")}}
                        </h4>

                        {{--action="{{route('expenses.report')}}"--}}
                        <form  action="{{route('customer.payments.report')}}" class="form-horizontal" id="form" role="form" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">{{trans("trans.name")}}</label>
                                <div class="col-sm-9">
                                    <select name="customer" id="customer" class="form-control select2">
                                        <option value="0">{{trans("trans.allcustomers")}}</option>
                                        @foreach($deals as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="deals" class="col-sm-2 control-label">{{trans("trans.deals")}}</label>
                                <div class="col-sm-9">
                                    <select name="deal_id" id="customer_deals" class="form-control">
                                        <option value="0" selected>{{trans('trans.all_deals')}}</option>
                                        @foreach($deals as $deal)
                                            @foreach($deal->customerDeal as $cust_deal)
                                                <option class="remove d{{$cust_deal->customer_id}}" value="{{$cust_deal->id}}">{{$cust_deal->id." / ".$cust_deal->descdeal."/".$cust_deal->date}}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-5">
                                    @if($errors->has('customer'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('customer')}}</strong>
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
                                <div class="col-md-4">
                                    @if($errors->has('fromdate'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('fromdate')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    @if($errors->has('todate'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('todate')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    @if($errors->has('deal_id'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('deal_id')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-10 col-sm-2 pull-left">
                                    <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-search"></i> {{trans('trans.search')}}</button>
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

    <!-- /.content -->
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $("#customer_deals option[value!='0']").hide();
            $('#customer').change(function() {
                $('.remove').hide();
                $('.d' + $(this).val()).show();
            });
        });

        $('.datepicker').datepicker({
            autoclose: true,
            rtl: true,
            format:'yyyy-mm-dd'
        }).datepicker('setDate','now');
    </script>
@endsection
