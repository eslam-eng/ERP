@extends('dashbord.master')
@section('content')
    {{--<meta name="csrf-token" content="{{csrf_token()}}">--}}
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="alert-danger alert-error">

            </div>
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <h4 class="text-center">
                            {{trans('trans.empspecialreport')}}
                        </h4>


                        <form class="form-horizontal" action="{{route('emp_peoductableReport')}}" id="form" role="form" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label"> {{trans('trans.name')}}</label>
                                <div class="col-sm-9">
                                    <select name="empId" id="empId" class="form-control select2">
                                        <option value="0"> {{trans('trans.allemployees')}}</option>
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    @if($errors->has('empId'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('empId')}}</strong>
                                        </h5>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> {{trans('trans.from')}}</label>
                                <div class="col-sm-4">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="fromdate" class="form-control pull-right datepicker" id="fromdate">
                                    </div>
                                </div>

                                <label for="inputDate" class="col-sm-1 control-label"> {{trans('trans.to')}}</label>
                                <div class="col-sm-4">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="todate" class="form-control pull-right datepicker" id="todate">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    @if($errors->has('fromdate'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('fromdate')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="col-md-5">
                                    @if($errors->has('todate'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('todate')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-10 col-sm-2 pull-left">
                                    <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-search"></i>  {{trans('trans.search')}}</button>
                                </div>
                            </div>
                            <br>
                        </form>

                    </div>
                    <!-- /.box -->
                </div>
                <!--/.col (left) -->
            </div>

        </section>
        <section class="content" id="myreport">

        </section>


        <!-- /.content -->
    </div>
@endsection
{{--@section('script')--}}
    {{--<script>--}}
        {{--$('.datepicker').datepicker({--}}
            {{--autoclose: true,--}}
            {{--rtl: true,--}}
            {{--format:'yyyy-mm-dd'--}}
        {{--}).datepicker('setDate','now');--}}
    {{--</script>--}}
{{--@endsection--}}

