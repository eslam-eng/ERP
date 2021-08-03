@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row no-print">
                <div class="col-xs-12">
                    <button class="print btn btn-default"><i class="fa fa-print"></i> {{trans('trans.print')}}</button>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Main content -->
            <section class="invoice printthis">
                <!-- title row -->
                <div class="row">
                    <div class="col-md-7">
                        <i class="fa fa-globe"></i><strong>{{trans('trans.elmhlawy')}}</strong>
                    </div>
                    <div class="col-md-5">
                        <strong>{{trans("trans.date")}}: {{$variabls['date']['fromdate']}} {{trans("trans.to")}} {{$variabls['date']['todate']}}</strong>
                    </div>
                    <div class="col-xs-12">
                        <h2 class="page-header">
                        </h2>
                    </div>
                    <!-- /.col -->
                </div>
{{--                <!-- info row -->--}}


                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <strong>
                            <address>
                                {{trans("trans.name")}} : <strong class="text text-bold">{{$employee->name}}</strong><br>
                                {{trans('trans.salary')." : ".$employee->salary}}<br>
                                {{trans('trans.tele')." : ".$employee->mobile}}<br>
                                {{trans('trans.address')." : ".$employee->address}}<br>
                                {{trans('trans.job')." : ".$employee->job}}<br>
                            </address>
                        </strong>
                    </div>

                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                           <strong>
                               <span>{{trans('trans.balance')." : ".$employee->balance}}</span><br>
                               {{trans('trans.total_salary_deduct')." : ".$variabls['sum_salary_deduct']}}<br>
                               {{trans('trans.sum_borrow')." : ".$variabls['sum_borrow']}}<br>
                               {{trans('trans.sumreward')." : ".$variabls['sum_reward']}}<br>
                           </strong>
                        <div class="bg-primary">
                            {{trans('trans.pure_emp_balance')." : "}} {{$employee->balance+($variabls['sum_work_hour']*$employee->S_perHour)}}
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <br>

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-striped table-bordered text-center">
                            <thead>
                            <tr>
                                <td>{{trans('trans.date')}}</td>
                                <td>{{trans('trans.attendance')}}</td>
                                <td>{{trans('trans.leave')}}</td>
                                <td>{{trans('trans.noteattendance')}}</td>
                                <td>{{trans('trans.noteleave')}}</td>
                                <td>{{trans('trans.reward')}}</td>
                                <td>{{trans('trans.borrows')}}</td>
                                <td>{{trans('trans.discount')}}</td>
                                <td>{{trans('trans.notes')}}</td>
                                <td>{{trans('trans.pure_day')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employee->employeeMove as $expense)
                                <tr>
                                    <td>{{date('l',strtotime($expense->date))}} | {{$expense->date}}</td>
                                    <td>{{$expense->attendanceTime}}</td>
                                    <td>{{$expense->leaveTime}}</td>
                                    <td>{{$expense->attnote}}</td>
                                    <td>{{$expense->leavenote}}</td>
                                    <td>{{$expense->reward}}</td>
                                    <td>{{$expense->borrow}}</td>
                                    <td>{{$expense->S_deduct}}</td>
                                    <td class="text-sm">{{$expense->note}}</td>
                                    <td>{{($expense->work_hour*$employee->S_perHour)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-xs-12">
                        <button class="print btn btn-default"><i class="fa fa-print"></i> {{trans('trans.print')}}</button>
                    </div>
                </div>
            </section>
            <!-- /.content -->
            <div class="clearfix"></div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
