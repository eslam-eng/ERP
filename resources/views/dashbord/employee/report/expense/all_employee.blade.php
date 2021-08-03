@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row no-print">
                <div class="col-xs-12">
                    <button class="print btn btn-default"><i class="fa fa-print"></i> {{trans('trans.print')}}</button>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content printthis">

            <!-- Main content -->
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-md-4"><small>{{trans('trans.date')}}: {{$variabls['date']['fromdate']}} {{trans('trans.to')}} {{$variabls['date']['todate']}}</small></div>
                    <div class="col-md-8"><i class="fa fa-globe text-red"></i> <strong>{{trans('trans.elmhlawy')}}</strong></div>
                </div>
                <hr><br>

                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <strong>{{trans('trans.sumreward')." : ".$variabls['sum_reward']}}</strong><br>
                        <strong>{{trans('trans.sum_borrow'). " : ". $variabls['sum_borrow'] }} </strong><br>
                        <strong>{{trans('trans.total_salary_deduct')." : ".$variabls['sum_salary_deduct']}}</strong><br>

                    </div>

                    {{--<div class="col-sm-4 invoice-col">--}}
                        {{--<strong>{{trans('trans.num_hours')." : ".$variabls['sum_work_hour']}}</strong><br>--}}
                    {{--</div>--}}
                </div>
                <!-- /.row -->
            <div class="box">
                <div class="box-body">

                    <!-- Table row -->
                    <div class="row">
                            <table class="table table-striped table-bordered table-responsive text-center">
                                <thead>
                                <tr>
                                    <td>#</td>
                                    <th width="20%">{{trans('trans.name')}}</td>
                                    {{--<td>{{trans('trans.balance')}}</td>--}}
                                    <td>{{trans('trans.main')}}</td>
                                    <td>{{trans('trans.reward')}}</td>
                                    <td>{{trans('trans.borrows')}}</td>
                                    <td>{{trans('trans.salary_deduct')}}</td>
                                    <td>{{trans('trans.pure_emp_balance')}}</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees_move as $index=>$empmove)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$empmove->employee->name}}</td>
                                        {{--<td>{{$empmove->employee->balance}}</td>--}}
                                        <td>{{$empmove->sum_work_hour*$empmove->employee->S_perHour}}L.E</td>
                                        <td>{{$empmove->sum_reward}}</td>
                                        <td>{{$empmove->sum_borrow}}</td>
                                        <td>{{$empmove->sum_S_deduct}}</td>
                                        <td>{{($empmove->sum_work_hour*$empmove->employee->S_perHour)+$empmove->employee->balance}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-xs-12">
                        <button class="print btn btn-primary"><i class="fa fa-print"></i> {{trans('trans.print')}}</button>
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

