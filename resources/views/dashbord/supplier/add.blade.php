@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{trans('trans.suppliers')}}
                <small>{{trans('trans.preview')}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans('trans.suppliers')}}</a></li>
                <li class="active">{{trans('trans.addsuppliers')}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

{{--            @include('dashbord.messageFlash.message')--}}
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <!-- form start -->
                        <form action="{{route('supplier.store')}}" method="post" role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-xs-6">
                                        <label for="name">{{trans('trans.company')}}</label>
                                        <input type="text" name=name class="form-control" value="{{old('name')}}" id="name" placeholder="{{trans('trans.company')}}...">
                                    </div>

                                    <div class="form-group col-xs-6">
                                        <label for="name">{{trans('trans.responsible')}}</label>
                                        <input type="text" name="responsible" class="form-control" value="{{old('responsible')}}" id="name" placeholder="{{trans('trans.responsible')}}..">
                                    </div>

                                    @if($errors->has('name'))
                                        <h5 class="text-danger form-group col-xs-6">
                                            <strong>{{$errors->first('name')}}</strong>
                                        </h5>
                                    @endif
                                    @if($errors->has('responsible'))
                                        <h5 class="text-danger form-group col-xs-6">
                                            <strong>{{$errors->first('responsible')}}</strong>
                                        </h5>
                                    @endif
                                </div><br>
                                {{--start part of salary--}}
                                <div class="row">
                                    <div class="col-xs-5">
                                        <label for="mobile">{{trans('trans.tele')}}</label>
                                        <input type="tel" name="mobile" id="mobile" class="form-control" placeholder="{{trans('trans.tele')}}...">
                                    </div>

                                    <div class="col-xs-5">
                                        <label for="email">{{trans('trans.email')}}</label>
                                        <input type="email" name="email" id="emil" class="form-control" placeholder="{{trans('trans.email')}}...">
                                    </div>

                                </div><br>

                                <div class="row">

                                    @if($errors->has('mobile'))
                                        <h5 class="text-danger col-xs-4">
                                            <strong>{{$errors->first('mobile')}}</strong>
                                        </h5>
                                    @endif
                                    @if($errors->has('email'))
                                        <h5 class="text-danger col-xs-4">
                                            <strong>{{$errors->first('email')}}</strong>
                                        </h5>
                                    @endif

                                </div>

                                <div class="row">

                                    <div class="form-group col-xs-8">
                                        <label for="address">{{trans('trans.address')}}</label>
                                        <input type="text" name="address" class="form-control calc" id="address" value="{{old('address')}}" placeholder="{{trans('trans.address')}}...">
                                    </div>
                                    @if($errors->has('address'))
                                        <h5 class="text-danger col-xs-8">
                                            <strong>{{$errors->first('address')}}</strong>
                                        </h5>
                                    @endif


                                    <div class="col-xs-4">
                                        <label for="balance">{{trans('trans.balance')}}</label>
                                        <input type="number" name="balance" class="form-control" id="balance" value="0" placeholder="{{trans('trans.balance')}}....">
                                    </div>

                                    @if($errors->has('balance'))
                                        <h5 class="text-danger col-xs-4">
                                            <strong>{{$errors->first('balance')}}</strong>
                                        </h5>
                                    @endif

                                </div>
                                {{--<div class="row">--}}

                                    {{--@if($errors->has('address'))--}}
                                        {{--<h5 class="text-danger col-xs-8">--}}
                                            {{--<strong>{{$errors->first('address')}}</strong>--}}
                                        {{--</h5>--}}
                                    {{--@endif--}}
                                    {{--@if($errors->has('balance'))--}}
                                        {{--<h5 class="text-danger col-xs-4">--}}
                                            {{--<strong>{{$errors->first('balance')}}</strong>--}}
                                        {{--</h5>--}}
                                    {{--@endif--}}

                                {{--</div>--}}

                                <div>
                                    <input type="checkbox" id="isactive" name="isactive" value="1" checked>
                                    <label for="isactive"> {{trans('trans.isactive')}}</label>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-md-8"><button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> {{trans('trans.submit')}}</button></div>
                                    <div class="col-md-4"><a href="{{route('supplier.index')}}" role="button" class="btn btn-default btn-sm pull-right"><i class="fa fa-backward"></i> {{trans('trans.back')}}</a></div>
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
