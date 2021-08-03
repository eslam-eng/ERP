<?php
$timezone = 'Africa/Cairo';
date_default_timezone_set($timezone);
?>
@extends('dashbord.master')
@section('content')
<style>
    .open{
        width: 80px !important;
        direction: ltr !important;
    }
</style>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{trans('trans.employees')}} {{trans('trans.AttLeave')}} <small style="color: #2b25ff">{{trans('trans.preview')}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans('trans.employees_data')}}</a></li>
                <li class="active"><a href="#">{{trans('trans.AttLeave')}}</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
{{--            @include('dashbord.messageFlash.message')--}}
            {{--_____________________________________--}}
            <div class="row">
                <!-- /.col -->
                <div class="col-md-11">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab">{{trans('trans.attendance')}}</a></li>
                            <li><a href="#settings" data-toggle="tab">{{trans('trans.leave')}}</a></li>
                            {{--<li><a href="#absent" data-toggle="tab">{{trans('trans.absent')}}</a></li>--}}
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <p class="text-center text-green text-bold">{{trans('trans.addattendance')}}</p>
                                <form action="{{route('store.Attendance')}}" class="form-horizontal" role="form" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{trans('trans.name')}}</label>
                                        <div class="col-sm-10">
                                            <select name="empId" class="form-control select2">
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
                                        <label class="col-sm-2 control-label">{{trans('trans.date')}}</label>
                                        <div class="col-sm-10">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" name="date" class="form-control pull-right datepicker" id="datepicker">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            @if($errors->has('date'))
                                                <h5 class="text-danger pull-right">
                                                    <strong>{{$errors->first('date')}}</strong>
                                                </h5>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="attTime" class="col-sm-2 control-label">{{trans('trans.attendance')}}</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                                <input type="text" name="attendanceTime" class="form-control timepicker" id="attTime">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            @if($errors->has('date'))
                                                <h5 class="text-danger pull-right">
                                                    <strong>{{$errors->first('attendanceTime')}}</strong>
                                                </h5>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputNote" class="col-sm-2 control-label">{{trans('trans.notes')}}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="attnote" id="inputNote" placeholder="Your Notes...."></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-success">{{trans('trans.submit')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
{{--------------------------Start Section of Add Leaves --------------------------------}}

                            <div class="tab-pane" id="settings">
                                <p class="text-center text-danger text-bold">{{trans('trans.addleave')}}</p>
                                <form action="{{route('store.Leave')}}" class="form-horizontal" role="form" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">{{trans('trans.name')}}</label>
                                        <div class="col-sm-10">
                                            <select name="empId" class="form-control">
                                                @foreach($employees as $employee)
                                                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDate" class="col-sm-2 control-label">{{trans('trans.date')}}</label>
                                        <div class="col-sm-10">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text"  name="date" class="form-control pull-right datepicker">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{trans('trans.addleave')}}</label>

                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                                <input type="text" class="form-control timepicker" name="leaveTime" id="leaveTime">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputNote" class="col-sm-2 control-label">{{trans('trans.notes')}}</label>

                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="leavenote" id="inputNote"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">{{trans('trans.submit')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

{{--                            Start part of absent --}}


                            {{--<div class="tab-pane" id="absent">--}}
                                {{--<p class="text-center text-danger text-bold">{{trans('trans.absent')}}</p>--}}
                                {{--<form action="{{route('store.absent')}}" class="form-horizontal" role="form" method="post">--}}
                                    {{--@csrf--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="inputName" class="col-sm-2 control-label">{{trans('trans.name')}}</label>--}}
                                        {{--<div class="col-sm-10">--}}
                                            {{--<select name="empId" class="form-control">--}}
                                                {{--@foreach($employees as $employee)--}}
                                                    {{--<option value="{{$employee->id}}">{{$employee->name}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="inputDate" class="col-sm-2 control-label">{{trans('trans.date')}}</label>--}}
                                        {{--<div class="col-sm-10">--}}
                                            {{--<div class="input-group date">--}}
                                                {{--<div class="input-group-addon">--}}
                                                    {{--<i class="fa fa-calendar"></i>--}}
                                                {{--</div>--}}
                                                {{--<input type="text"  name="date" class="form-control pull-right datepicker">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="form-group">--}}
                                        {{--<div class="col-sm-offset-2 col-sm-10">--}}
                                            {{--<button type="submit" class="btn btn-danger">{{trans('trans.submit')}}</button>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <a href="{{route('all.AttendanceAndLeave')}}" role="button" class="btn btn-sm btn-default pull-right"><i class="fa fa-chevron-circle-left"> {{trans('trans.back')}}</i></a>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>

@endsection
@section('script')
    <script>
        $('.datepicker').datepicker({
            autoclose: true,
            rtl: true,
            format:'yyyy-mm-dd'
        }).datepicker('setDate','now');
    </script>
@endsection














