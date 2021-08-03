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
                            {{trans("trans.customers_deal_report")}}
                        </h4>

                        {{--action="{{route('expenses.report')}}"--}}
                        <form  action="{{route('customer.deal.report')}}" class="form-horizontal" id="form" role="form" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans("trans.name")}}</label>
                                <div class="col-sm-9">
                                    <select name="customer" id="customer" class="form-control">
                                        <option value="0">{{trans("trans.allcustomers")}}</option>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">select deal</label>
                                <div class="col-sm-9">
                                    <select name="deal" id="customer_deals" class="form-control">
                                        <option value="0" class="d0">{{trans("trans.all_deals")}}</option>
                                        @foreach($deals as $deal)
                                            <option value="{{$deal->id}}" class="remove d{{$deal->customer_id}}">{{$deal->id."/".$deal->descdeal."/".$deal->date}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5">
                                    @if($errors->has('customer'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('customer')}}</strong>
                                        </h5>
                                    @endif

                                    @if($errors->has('deal'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('deal')}}</strong>
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
                                    <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
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
    </script>
@endsection
