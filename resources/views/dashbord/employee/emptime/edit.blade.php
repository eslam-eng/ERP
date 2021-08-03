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
            <h5>
                {{trans('trans.generalupdate').trans('trans.AttLeave')}}
            </h5>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans('trans.employee')}}</a></li>
                <li><a href="#">{{trans('trans.AttLeave')}}</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            {{--@include('dashbord.messageFlash.message')--}}
            <div class="row">
                <!-- /.col -->
                <div class="col-md-11">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab">{{trans('trans.AttLeave')}}</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <form action="{{route('update.AttendanceLeave',$timedata->id)}}" class="form-horizontal" role="form" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{trans('trans.name')}}</label>
                                        <div class="col-sm-10">
                                            <select name="empId" class="form-control select2">
                                                @foreach($employees as $employee)
                                                    <option value="{{$employee->id}}" {{$timedata->empId==$employee->id?'selected':''}}>{{$employee->name}}</option>
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
                                                <input type="text" name="date" class="form-control pull-right datepicker" id="datepicker" value="{{$timedata->date}}">
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
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                                <input type="text" name="attendanceTime" class="form-control timepicker" value="{{$timedata->attendanceTime}}" id="attTime">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{trans('trans.leave')}}</label>

                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                                <input type="text" class="form-control timepicker" name="leaveTime" value="{{$timedata->leaveTime}}" id="leaveTime">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-5">
                                            @if($errors->has('attendanceTime'))
                                                <h5 class="text-danger pull-right">
                                                    <strong>{{$errors->first('attendanceTime')}}</strong>
                                                </h5>
                                            @endif
                                        </div>
                                        <div class="col-md-5">
                                            @if($errors->has('leaveTime'))
                                                <h5 class="text-danger pull-right">
                                                    <strong>{{$errors->first('leaveTime')}}</strong>
                                                </h5>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputNote" class="col-sm-2 control-label">{{trans('trans.noteattendance')}}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="attnote" id="inputNote" placeholder="Your Notes....">{{$timedata->attnote}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputNote" class="col-sm-2 control-label">{{trans('trans.noteleave')}}</label>

                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="leavenote" id="inputNote" placeholder="Your Notes....">{{$timedata->leavenote}}</textarea>
                                        </div>
                                    </div>


                                    <div class="row box-footer">
                                        <div class="col-md-8">
                                            <button type="submit" class="btn btn-success col-sm-offset-2">{{trans(trans('trans.update'))}}</button>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{route('all.AttendanceAndLeave')}}" role="button" class="btn btn-sm btn-default pull-right"><i class="fa fa-backward"> Back</i></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{--------------------------Start Section of Add Leaves --------------------------------}}

                            {{--<div class="tab-pane" id="settings">--}}
                                {{--<p class="text-center text-danger text-bold">Add Leave</p>--}}
                                {{--<form action="{{route('store.Leave')}}" class="form-horizontal" role="form" method="post">--}}
                                    {{--@csrf--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="inputName" class="col-sm-2 control-label">Name</label>--}}
                                        {{--<div class="col-sm-10">--}}
                                            {{--<select name="empId" class="form-control">--}}
                                                {{--@foreach($employees as $employee)--}}
                                                    {{--<option value="{{$employee->id}}">{{$employee->name}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="inputDate" class="col-sm-2 control-label">Date</label>--}}
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
                                        {{--<label class="col-sm-2 control-label">Leave Time</label>--}}

                                        {{--<div class="col-sm-10">--}}
                                            {{--<div class="input-group">--}}
                                                {{--<div class="input-group-addon">--}}
                                                    {{--<i class="fa fa-clock-o"></i>--}}
                                                {{--</div>--}}
                                                {{--<input type="text" class="form-control timepicker" name="leaveTime" id="leaveTime">--}}

                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="form-group">--}}
                                        {{--<label for="inputNote" class="col-sm-2 control-label">Note</label>--}}

                                        {{--<div class="col-sm-10">--}}
                                            {{--<textarea class="form-control" name="leavenote" id="inputNote" placeholder="Your Notes...."></textarea>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="form-group">--}}
                                        {{--<div class="col-sm-offset-2 col-sm-10">--}}
                                            {{--<button type="submit" class="btn btn-danger">Submit</button>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                            {{--<!-- /.tab-pane -->--}}
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
@endsection