@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{trans('trans.customers')}}
                <small>{{trans('trans.preview')}} </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans('trans.customers_data')}} </a></li>
                <li class="active">{{trans('trans.addcustomer')}} </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            {{--@include('dashbord.messageFlash.message')--}}

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <!-- form start -->
                        <form action="{{route('customers.update',$customer->id)}}" method="post" role="form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-xs-6">
                                        <label for="name">{{trans('trans.name')}} </label>
                                        <input type="text" name=name class="form-control" value="{{$customer->name}}" id="name" placeholder="name..">
                                    </div>
                                    @if($errors->has('name'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('name')}}</strong>
                                        </h5>
                                    @endif
                                </div><br>

                                <div class="row">

                                    <div class="col-xs-4">
                                        <label for="mobile">{{trans('trans.tele')}} </label>
                                        <input type="text" name="mobile" class="form-control" value="{{$customer->mobile}}" id="socialnumber" placeholder="Social Number">
                                    </div>
                                    @if($errors->has('mobile'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('mobile')}}</strong>
                                        </h5>
                                    @endif

                                </div>

                                <br>

                                <div class="row">

                                    <div class="col-xs-4">
                                        <label for="socialnumber">{{trans('trans.national_id')}} </label>
                                        <input type="text" name="nationalId" class="form-control" value="{{$customer->nationalId}}" id="socialnumber" placeholder="Social Number">
                                    </div>
                                    @if($errors->has('nationalId'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('nationalId')}}</strong>
                                        </h5>
                                    @endif



                                    <div class="col-xs-4">
                                        <label for="socialnumber">{{trans('trans.dept')}} </label>
                                        <input type="number" name="dept" class="form-control" value="{{$customer->dept}}" id="socialnumber" placeholder="Social Number">
                                    </div>
                                    @if($errors->has('dept'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('dept')}}</strong>
                                        </h5>
                                    @endif


                                </div><br>

                                <div class="row">
                                    <div class="form-group col-xs-8">
                                        <label for="address">{{trans('trans.address')}} </label>
                                        <input type="text" name="address" class="form-control calc" id="address" value="{{$customer->address}}" placeholder="adress">
                                    </div>
                                    @if($errors->has('address'))
                                        <h5 class="text-danger col-xs-4">
                                            <strong>{{$errors->first('address')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>{{trans('trans.notes')}} </label>
                                    <textarea class="form-control" name="note" rows="1"  placeholder="your Notes...">{{$customer->note}}</textarea>
                                </div>
                                @if ($errors->has('note'))
                                    <span class="text-danger" role="alert">
                                      <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif

                                <div>
                                    <input type="checkbox" id="isactive" name="isactive" value="1" checked>
                                    <label for="isactive"> {{trans('trans.isactive')}} </label>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-md-9"><button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> {{trans('trans.update')}} </button></div>
                                    <div class="col-md-3"><a href="{{route('customers.index')}}" role="button" class="btn btn-default btn-sm pull-right"><i class="fa fa-backward"></i> {{trans('trans.back')}} </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection

