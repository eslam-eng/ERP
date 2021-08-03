@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{trans('trans.customerdeal')}}
                <small>{{trans('trans.preview')}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans('trans.customer_data')}}</a></li>
                <li class="active">{{trans('trans.customerdeal')}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
{{--            @include('dashbord.messageFlash.message')--}}
            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border bg-blue-gradient">
                            <i class="fa fa-file"></i>
                            <h3 class="box-title">{{trans('trans.customerdeal')}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form method="post" action="{{route('customer-Deal.store')}}" role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">{{trans('trans.name')}}</label>
                                    <div>
                                        <select name="customer_id" id="name" class="form-control select2">
                                            @foreach($customers as $customer)
                                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="value">{{trans('trans.desc_deal')}}</label>
                                    <input type="text" name="descdeal"  class="form-control">
                                    @if($errors->has('descdeal'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('descdeal')}}</strong>
                                        </h5>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label for="value">{{trans('trans.customerdealtotal')}}</label>
                                    <input type="number" name="dealtotal"  class="form-control">
                                    @if($errors->has('dealtotal'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('dealtotal')}}</strong>
                                        </h5>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label for="pay_type">{{trans('trans.paytype')}}</label>
                                    <div>
                                        <select name="pay_type" id="pay_type" class="form-control">
                                            <option value="0">{{trans("trans.cash")}}</option>
                                            <option value="-1">{{trans("trans.pendding")}}</option>
                                            <option value="1">{{trans("trans.somemony")}}</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group" id="somepaid">
                                    <label for="value">{{trans('trans.pay_value')}}</label>
                                    <input type="number" min="1" name="somepaid" class="form-control" placeholder="value or balance....">
                                    @if($errors->has('somepaid'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('somepaid')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="form-group col-xs-8">
                                        <label for="file">{{trans('trans.attachments')}} </label>
                                        <input type="file" name="file[]" class="form-control" multiple="yes" id="file" value="{{old('file[]')}}">
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
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
                                    <div class="col-md-4"><a href="{{route('customer-Deal.index')}}" role="button" class="btn btn-default pull-right">{{trans('trans.back')}}</a></div>
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
        $("#somepaid").hide();
        $("#pay_type").change(function () {
            if ($("#pay_type").val()==0||$("#pay_type").val()==-1) {$("#somepaid").hide();}
            else {$("#somepaid").show();}


        });
    </script>
@endsection
