@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{trans('trans.employees_data')}}
                <small>{{trans('trans.preview')}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans('trans.employees')}}</a></li>
                <li class="active">{{trans('trans.emp_update')}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            @include('dashbord.messageFlash.message')

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <!-- form start -->
                        <form action="{{route('employee.update',$employee->id)}}" method="post" role="form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-xs-6">
                                        <label for="name">{{trans('trans.name')}}</label>
                                        <input type="text" name=name class="form-control" value="{{$employee->name}}" id="name">
                                    </div>
                                    @if($errors->has('name'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('name')}}</strong>
                                        </h5>
                                    @endif
                                </div><br>
                                {{--start part of salary--}}
                                <div class="row">
                                    <div class="col-xs-2">
                                        <label for="salary">{{trans('trans.salary')}}</label>
                                        <input type="number" name="salary" id="salary" class="form-control" value="{{$employee->salary}}">
                                    </div>

                                    <div class="col-xs-2">
                                        <label for="num_days">{{trans('trans.num_days')}}</label>
                                        <input type="number" name="numDays" id="num_days" value="{{$employee->numDays}}" class="form-control">
                                    </div>
                                    <div class="col-xs-2">
                                        <label for="num_hours">{{trans('trans.num_hours')}}</label>
                                        <input type="number" name="numHours" id="num_hours" value="{{$employee->numHours}}" class="form-control">
                                    </div>

                                    <div class="col-xs-2">
                                        <label for="valuOfDay">{{trans('trans.v_day')}}</label>
                                        <input type="number" name="S_perDay" id="S_perDay" value="{{$employee->S_perDay}}" class="form-control" readonly>
                                    </div>
                                    <div class="col-xs-2">
                                        <label for="valuOfHour">{{trans('trans.v_hour')}}</label>
                                        <input type="number" name="S_perHour" id="S_perHour" value="{{$employee->S_perHour}}" class="form-control" readonly>
                                    </div>

                                    <div class="col-xs-3">
                                        <label for="balance">{{trans('trans.balance')}}</label>
                                        <input type="number" name="balance" value="{{$employee->balance}}" id="balance"  class="form-control">
                                    </div>
                                </div><br>

                                <div class="row">

                                    @if($errors->has('numDays'))
                                        <h5 class="text-danger col-xs-4">
                                            <strong>{{$errors->first('numDays')}}</strong>
                                        </h5>
                                    @endif

                                    @if($errors->has('numHours'))
                                        <h5 class="text-danger col-xs-4">
                                            <strong>{{$errors->first('numHours')}}</strong>
                                        </h5>
                                    @endif

                                    @if($errors->has('balance'))
                                        <h5 class="text-danger col-xs-4">
                                            <strong>{{$errors->first('balance')}}</strong>
                                        </h5>
                                    @endif

                                </div>

                                {{--end part of salary-------------------------------------------}}

                                <div class="row">

                                    <div class="col-xs-4">
                                        <label for="tele">{{trans('trans.tele')}}</label>
                                        <input type="text" name="mobile"  class="form-control calc" id="tele" value="{{$employee->mobile}}" placeholder="Your Mobile Number">
                                    </div>


                                </div><br>

                                <div class="row">

                                    <div class="col-xs-4">
                                        <label for="socialstatus">{{trans('trans.status')}}</label>
                                        <select class="form-control calc" name="status" id="socialstatus">
                                            <option value="0" {{$employee->status==0?'selected':''}}}>{{trans('trans.student')}}</option>
                                            <option value="1" {{$employee->status==1?'selected':''}}>{{trans('trans.single')}}</option>
                                            <option value="2" {{$employee->status==2?'selected':''}}>{{trans('trans.married')}}</option>
                                        </select>
                                    </div>

                                    <div class="col-xs-4">
                                        <label for="education">{{trans('trans.qualification')}}</label>
                                        <select class="form-control calc" name="qualification" id="education">
                                            <option value="2" {{$employee->qualification==2?'selected':''}}>{{trans('trans.high')}}</option>
                                            <option value="1" {{$employee->qualification==1?'selected':''}}>{{trans('trans.midiate')}}</option>
                                            <option value="0" {{$employee->qualification==0?'selected':''}}>{{trans('trans.low')}}</option>
                                        </select>
                                    </div>

                                    <div class="col-xs-4">
                                        <label for="socialnumber">{{trans('trans.national_id')}}</label>
                                        <input type="text" name="nationalId" class="form-control calc" value="{{$employee->nationalId}}" id="socialnumber" placeholder="Social Number">
                                    </div>
                                    @if($errors->has('nationalId'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('nationalId')}}</strong>
                                        </h5>
                                    @endif

                                </div><br>

                                <div class="row">

                                    <div class="col-xs-4">
                                        <label for="job">{{trans('trans.job')}}</label>
                                        <input type="text" name="job" class="form-control" id="job" value="{{$employee->job}}" placeholder="your job....">
                                    </div>

                                    <div class="form-group col-xs-8">
                                        <label for="address">{{trans('trans.address')}}</label>
                                        <input type="text" name="address" class="form-control calc" id="address" value="{{$employee->address}}" placeholder="adress">
                                    </div>

                                </div>
                                <div class="row">
                                    @if($errors->has('job'))
                                        <h5 class="text-danger col-xs-4">
                                            <strong>{{$errors->first('job')}}</strong>
                                        </h5>
                                    @endif
                                    @if($errors->has('address'))
                                        <h5 class="text-danger col-xs-4">
                                            <strong>{{$errors->first('address')}}</strong>
                                        </h5>
                                    @endif

                                </div>


                                <div class="form-group">
                                    <label>{{trans('trans.notes')}}</label>
                                    <textarea class="form-control" name="note" rows="1"  placeholder="your Notes...">{{$employee->note}}</textarea>
                                </div>
                                @if ($errors->has('note'))
                                    <span class="text-danger" role="alert">
                                      <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif

                                <div class="form-group">
                                    <label for="file">{{trans('trans.image')}}</label>
                                    <input type="file" id="file" name="avatar">
                                    <p class="help-block">(jpeg-png-jpg){{trans('trans.image_question')}}</p>
                                </div>
                                @if ($errors->has('avatar'))
                                    <span class="text-danger" role="alert">
                                      <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                                <div>
                                    <input type="checkbox" id="isactive" name="isactive" {{$employee->isactive==1?'checked':''}}>
                                    <label for="isactive"> {{trans('trans.isactive')}}</label>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-md-7"><button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> {{trans('trans.submit')}}</button></div>
                                    <div class="col-md-5"><a href="{{route('employee.index')}}" role="button" class="btn btn-default btn-sm pull-right"><i class="fa fa-backward"></i> {{trans('trans.back')}}</a></div>
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
    <script src="{{asset('dashbord/dist/js/employee.js')}}"></script>
@endsection