@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{trans('trans.store')}}
                <small>{{trans('trans.preview')}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans('trans.store')}}</a></li>
                <li class="active">{{trans('trans.addstore')}}</li>
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
                        <form action="{{route('stock.store')}}" method="post" role="form">
                            @csrf
                            <div class="box-body">
                                <div class="row">

                                    <div class="col-xs-6">
                                        <label for="name">{{trans('trans.name')}}</label>
                                        <input type="text" name="name" class="form-control" value="{{old('name')}}" id="name">
                                    </div>

                                    <div class="col-xs-6">
                                        <label for="desc">{{trans('trans.descriotion')}}</label>
                                        <input type="text" name="desc" class="form-control" value="{{old('desc')}}" id="desc">
                                    </div>
                                </div><br>

                                <div class="row">
                                    @if($errors->has('name'))
                                        <h5 class="text-danger pull-left col-xs-6">
                                            <strong>{{$errors->first('name')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div>
                                    <input type="checkbox" id="isactive" name="isactive" value="1" checked>
                                    <label for="isactive"> {{trans('trans.isactive')}}</label>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="row box-footer">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> {{trans('trans.submit')}}</button>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{route('stock.index')}}" role="button" class="btn btn-default pull-right"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> {{trans('trans.back')}}</a>
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
