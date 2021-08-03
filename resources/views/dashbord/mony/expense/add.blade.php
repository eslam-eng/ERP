@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{trans('trans.unknounacounts')}} {{trans('trans.employees')}} <small style="color: #2b25ff">{{trans('trans.preview')}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans('trans.employees')}}</a></li>
                <li class="active">{{trans('trans.acounts')}}</li>
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
                        <form action="{{route('DailyExpense.store')}}" method="post" role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="employee"><strong>{{trans('trans.generalexpense')}}</strong></label>
                                        <input type="text" class="form-control" name="genralexpense" id="employee">
                                    </div>
                                    @if($errors->has('genralexpense'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('genralexpense')}}</strong>
                                        </h5>
                                    @endif
                                </div><br>
                                <div class="row"  id="expensevalue">
                                    <div class="col-xs-3">
                                        <label for="generalExpenseValue">{{trans('trans.value')}}</label>
                                        <input type="number" name="value" value="{{old('value')}}" min="0" class="form-control">
                                    </div>
                                    @if($errors->has('value'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('value')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <br>
                                <div class="row" id="expenseInput">
                                    <div class="col-xs-3">
                                        <label>{{trans("trans.maker")}}</label>
                                        <input type="text" name="maker" value="{{old('maker')}}" class="form-control">
                                    </div>
                                    @if($errors->has('maker'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('maker')}}</strong>
                                        </h5>
                                    @endif

                                </div><br>

                                <div class="form-group">
                                    <label>{{trans('trans.notes')}}</label>
                                    <textarea class="form-control" name="note" rows="1" >{{old('note')}}</textarea>
                                </div>
                                @if ($errors->has('note'))
                                    <span class="text-danger" role="alert">
                                      <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <!-- /.box-body -->
                            <div class="row box-footer">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> {{trans('trans.submit')}}</button>
                                </div>

                                <div class="col-md-4">
                                    <a href="{{route('DailyExpense.index')}}" role="button" class="btn btn-default pull-right"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> {{trans('trans.back')}}</a>
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



