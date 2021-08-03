@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{trans("trans.mony")}}
                <small>{{trans("trans.preview")}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans("trans.mony")}}</a></li>
                <li class="active"> {{trans("trans.addmony")}}</li>
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
                            <i class="fa fa-money"></i>
                            <h3 class="box-title">{{trans("trans.monyreceivedata")}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form method="post" action="{{route('Monymove.store')}}" role="form">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="value">{{trans("trans.from")}}</label>
                                    <input type="text"  name="from" class="form-control">
                                    @if($errors->has('from'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('from')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="value">{{trans("trans.to")}}</label>
                                    <input type="text" name="to" class="form-control">
                                    @if($errors->has('to'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('to')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="value">{{trans("trans.value")}}</label>
                                    <input type="number" min="1" name="value" class="form-control">
                                    @if($errors->has('value'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('value')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="note">{{trans("trans.notes")}}</label>
                                    <div>
                                        <textarea class="form-control" name="note" id="note" placeholder="Your Notes...."></textarea>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="row box-footer">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">{{trans("trans.submit")}}</button>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{route('Monymove.index')}}" role="button" class="btn btn-default pull-right">{{trans("trans.back")}}</a>
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
