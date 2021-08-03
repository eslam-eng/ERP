@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Mony
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Mony</a></li>
                <li class="active">Add Mony</li>
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
                            <h3 class="box-title">Receive money</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form method="post" action="{{route('Monymove.update',$mony->id)}}" role="form">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="value">From</label>
                                    <input type="text"  name="from" class="form-control" value="{{$mony->from}}" placeholder="sender name...">
                                    @if($errors->has('from'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('from')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="value">to</label>
                                    <input type="text" name="to" class="form-control" value="{{$mony->to}}" placeholder="receiver....">
                                    @if($errors->has('to'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('to')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="value">Value</label>
                                    <input type="number" min="1" name="value" value="{{$mony->value}}" class="form-control" placeholder="value or balance....">
                                    @if($errors->has('value'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('value')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <div>
                                        <textarea class="form-control" name="note" id="note" placeholder="Your Notes....">{{$mony->note}}</textarea>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('Monymove.index')}}" role="button" class="btn btn-default pull-right">Back</a>
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
