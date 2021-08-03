@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Catch-Receipt
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Catch-Receipt</a></li>
                <li class="active">Edit Receipt</li>
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
                            <h3 class="box-title">Receipt</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form method="post" action="{{route('catchreceipt.update',$catchReceipt->id)}}" role="form">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <div>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="date" class="form-control pull-right datepicker" value="{{$catchReceipt->date}}" id="datepicker">
                                        </div>
                                    </div>
                                    @if($errors->has('date'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('date')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="type">type</label>
                                    <select name="type" id="type" class="form-control">
                                        {{--<option value="0">customer</option>--}}
                                        <option value="1" {{$catchReceipt->type==1?'selected':''}}>Employee</option>
                                        <option value="2" {{$catchReceipt->type==2?'selected':''}}>Supplier</option>
                                    </select>
                                    @if($errors->has('type'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('type')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <div>
                                        <select name="name" id="name" class="form-control">
                                            <option class="choose">--Select Employee or Supplier</option>
                                            @foreach($employees as $employee)
                                                <option value="{{$employee->id}}" {{$catchReceipt->name==$employee->id?'selected':''}} class="employees">{{$employee->name}}</option>
                                            @endforeach

                                            @foreach($suppliers as $supplier)
                                                <option value="{{$supplier->id}}" {{$catchReceipt->name==$supplier->id?'selected':''}} class="suppliers">{{$supplier->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if($errors->has('name'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('name')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="value">Value</label>
                                    <input type="text" name="receiver" class="form-control" value="{{$catchReceipt->receiver}}" placeholder="Receiver....">
                                    @if($errors->has('receiver'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('receiver')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="value">Value</label>
                                    <input type="number" min="1" name="value" value="{{$catchReceipt->value}}" class="form-control" placeholder="value or balance....">
                                    @if($errors->has('value'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('value')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <div>
                                        <textarea class="form-control" name="note" id="note" placeholder="Your Notes....">{{$catchReceipt->note}}</textarea>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('catchreceipt.index')}}" role="button" class="btn btn-default pull-right">Back</a>
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
    <script src="{{asset('dashbord/dist/js/receipt.js')}}"></script>
@endsection
