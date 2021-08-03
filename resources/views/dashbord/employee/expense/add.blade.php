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
{{--           @include('dashbord.messageFlash.message')--}}
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <!-- form start -->
                        <form action="{{route('expense.store')}}" method="post" role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="employee"><strong>{{trans('trans.employee')}}</strong></label>
                                        <select class="form-control select2" name="empId" id="employee" style="width: 100%">
                                          {{--<option value="0">{{trans('trans.generalexpense')}}</option>--}}
                                            @foreach($employees as $employee)
                                                <option value="{{$employee->id}}">{{$employee->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if($errors->has('empId'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('empId')}}</strong>
                                        </h5>
                                    @endif
                                </div><br>
                                {{--<div class="row"  id="expensevalue">--}}
                                    {{--<div class="col-xs-3">--}}
                                        {{--<label for="generalExpenseValue">{{trans('trans.value')}}</label>--}}
                                        {{--<input type="number" name="generalExpenseValue" min="0" class="form-control">--}}
                                    {{--</div>--}}
                                    {{--@if($errors->has('generalExpenseValue'))--}}
                                        {{--<h5 class="text-danger pull-right">--}}
                                            {{--<strong>{{$errors->first('generalExpenseValue')}}</strong>--}}
                                        {{--</h5>--}}
                                    {{--@endif--}}
                                {{--</div>--}}

                                <div class="row" id="expenseInput">

                                    <div class="col-xs-3">
                                        <label for="S_deduct">{{trans('trans.deduct')}}</label>
                                        <input type="number" min="0" name="S_deduct" class="form-control" id="S_deduct">
                                    </div>
                                    @if($errors->has('S_deduct'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('S_deduct')}}</strong>
                                        </h5>
                                    @endif

                                    <div class="col-xs-3">
                                        <label for="borrow">{{trans('trans.borrows')}}</label>
                                        <input type="number" name="borrow" min="0" class="form-control" id="borrow">
                                    </div>
                                    @if($errors->has('borrow'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('borrow')}}</strong>
                                        </h5>
                                    @endif

                                    <div class="col-xs-3">
                                        <label for="reward">{{trans('trans.reward')}}</label>
                                        <input type="number" min="0" name="reward" class="form-control"  id="reward">
                                    </div>
                                    @if($errors->has('reward'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('reward')}}</strong>
                                        </h5>
                                    @endif

                                </div><br>

                                <div class="form-group">
                                    <label>{{trans('trans.notes')}}</label>
                                    <textarea class="form-control" name="note" rows="1"  placeholder="your Notes...">{{old('note')}}</textarea>
                                </div>
                                @if ($errors->has('note'))
                                    <span class="text-danger" role="alert">
                                      <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <!-- /.box-body -->
                            <div class=" row box-footer">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> {{trans('trans.submit')}}</button>
                                </div>

                                <div class="col-md-4">
                                    <a href="{{route('expense.index')}}" role="button" class="btn btn-default pull-right"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> {{trans('trans.back')}}</a>
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
@section('script')
  {{--<script>--}}
      {{--$(function () {--}}
         {{--$("#expenseInput").hide();--}}
         {{--$("#employee").change(function () {--}}
             {{--if ($("#employee").val()=='0'){--}}
                 {{--$("#expensevalue").show();--}}
                 {{--$("#expenseInput").hide();--}}
             {{--} else {--}}
                 {{--$("#expensevalue").hide();--}}
                 {{--$("#expenseInput").show();--}}
             {{--}--}}
         {{--});--}}
      {{--});--}}

  {{--</script>--}}
@endsection


