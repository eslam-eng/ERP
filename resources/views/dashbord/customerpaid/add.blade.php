@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{trans('trans.customerpaid')}}
                <small>{{trans('trans.preview')}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans('trans.Dashbord')}}</a></li>
                <li class="active">{{trans('trans.addcustomerpaid')}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            {{--@include('dashbord.messageFlash.message')--}}
            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border bg-blue-gradient">
                            <i class="fa fa-file"></i>
                            <h3 class="box-title">{{trans('trans.customerpaid')}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form method="post" action="{{route('customer-paid.store')}}" role="form">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="date">{{trans('trans.date')}}</label>
                                    <div>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="date" class="form-control pull-right datepicker" id="datepicker">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name">{{trans('trans.name')}}</label>
                                    <div>
                                        <select name="customer_id" id="customer" class="form-control">
                                            <option>{{trans('trans.select_customer')}}</option>
                                            @foreach($customers as $customer)
                                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('customer_id'))
                                            <h5 class="text-danger">
                                                <strong>{{$errors->first('customer_id')}}</strong>
                                            </h5>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="name">{{trans('trans.desc_deal')}}</label>
                                    <div>
                                        <select name="deal_id" id="customer_deals" class="form-control">
                                            <option>{{trans('trans.select_deal')}}</option>
                                            @foreach($deals as $deal)
                                                <option value="{{$deal->id}}" class="remove d{{$deal->customer_id}}">{{$deal->id."/".$deal->descdeal."/".$deal->date}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('deal_id'))
                                            <h5 class="text-danger">
                                                <strong>{{$errors->first('deal_id')}}</strong>
                                            </h5>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group" id="receiver">
                                    <label for="value">{{trans('trans.receiver')}}</label>
                                    <input type="text" name="receiver"  class="form-control" placeholder="Receiver....">
                                    @if($errors->has('receiver'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('receiver')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="value">{{trans('trans.value')}}</label>
                                    <input type="number" min="1" name="value" class="form-control" placeholder="value or balance....">
                                    @if($errors->has('value'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('value')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="note">{{trans('trans.notes')}}</label>
                                    <div>
                                        <textarea class="form-control" name="note" id="note" placeholder="Your Notes...."></textarea>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-md-8"><button type="submit" class="btn btn-primary">{{trans('trans.submit')}}</button></div>
                                    <div class="col-md-4"><a href="{{route('customer-paid.index')}}" role="button" class="btn btn-default pull-right">{{trans('trans.back')}}</a></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
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
