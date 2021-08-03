@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{trans('trans.users')}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans('trans.Dashbord')}}</a></li>
                <li class="active">{{trans('trans.adduser')}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            @php
                $models = [
                            'employees','AttLeave','acountemployees','empproductable','employee_move_report',
                            'customers','customerdeal','cost_deal_customer','customerpaid','customerreport',
                            'suppliers','supplier_paid','supplierreport','salepurchase','buypurchase',
                            'store','products','product_order','product_addrequest','mony','product_report','monyreport','users'

                          ]
            @endphp

            {{--@include('dashbord.messageFlash.message')--}}

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <!-- form start -->
                        <form action="{{route('users.store')}}" method="post" role="form">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-xs-6">
                                        <label for="name">{{--@lang('site.name')--}}{{trans('trans.name')}}</label>
                                        <input type="text" name=name class="form-control" value="{{old('name')}}" id="name">
                                    </div>
                                    @if($errors->has('name'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('name')}}</strong>
                                        </h5>
                                    @endif
                                </div><br>


                                <div class="row">

                                    <div class="col-xs-4">
                                        <label for="email">{{trans('trans.email')}}</label>
                                        <input type="email" name="email"  class="form-control calc" id="email" value="">
                                    </div>
                                </div><br>

                                <div class="row">

                                    <div class="col-xs-4">
                                        <label for="password">{{-- @lang('site.telepthone')--}}{{trans('trans.password')}}</label>
                                        <input type="password" name="password"  class="form-control calc" id="password1" value="">
                                    </div>



                                    <div class="col-xs-4">
                                        <label for="role">{{trans('trans.role')}}</label>
                                        <select class="form-control" name="role" id="role">
                                            <option>---{{trans('trans.role')}}---</option>
                                            <option value="super_admin">{{trans('trans.super_admin')}}</option>
                                            <option value="admin">{{trans('trans.admin')}}</option>
                                        </select>
                                    </div>

                                </div><br>

                                <div>
                                    <input type="checkbox" id="isactive" name="isactive" value="1" checked>
                                    <label for="isactive"> {{trans('trans.isactive')}}</label>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box">
                                <div class="box-header bg-info text-center">
                                    <h3>{{trans('trans.permission')}}</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th class="bg-primary">{{trans('trans.add')}}</th>
                                            <th class="bg-yellow-active">{{trans('trans.generalupdate')}}</th>
                                            <th class="bg-red-gradient">{{trans('trans.delete')}}</th>
                                            <th class="bg-green">{{trans('trans.show')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($models as $model)
                                            <tr>
                                                <td>{{trans('trans.'.$model)}}</td>
                                                <td><input type="checkbox" name="permissions[]" value="create_{{$model}}"></td>
                                                <td><input type="checkbox" name="permissions[]" value="update_{{$model}}"></td>
                                                <td><input type="checkbox" name="permissions[]" value="delete_{{$model}}"></td>
                                                <td><input type="checkbox" name="permissions[]" value="read_{{$model}}"></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="col-md-7"><button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> {{trans('trans.submit')}}</button></div>
                                <div class="col-md-5"><a href="{{route('users.index')}}" role="button" class="btn btn-default "><i class="fa fa-step-backward"></i> {{trans('trans.back')}}</a></div>
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
    <script>
        $("#role").change(function () {
            $('#role').val()=='super_admin'? $(' input[type=checkbox]').prop('checked','checked'): $(' input[type=checkbox]').prop('checked',false);
        });
    </script>
@endsection

