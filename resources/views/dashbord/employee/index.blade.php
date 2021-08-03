@extends('dashbord.master')
@section('content')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @if(auth()->user()->hasPermission('create_employees'))
                    <a href="{{route('employee.create')}}" role="button" class="btn btn-primary"><i class="fa fa-plus"></i> {{trans('trans.Add_employee')}}</a>
                @endif
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> {{trans('trans.home')}}</a></li>
                <li class="active"><a href="#">{{trans('trans.employees_data')}}</a></li>
            </ol>
        </section><br>

        <!-- Main content -->
        <section class="content">

{{--            @include('dashbord.messageFlash.message')--}}

            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{trans('trans.employees_data')}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example" class="table table-bordered table-striped mytable">
                                <thead>
                                <tr>
                                    <th width="2%">#</th>
                                    <th width="5%"></th>
                                    <th>{{trans('trans.name')}}</th>
                                    <th>{{trans('trans.salary')}}</th>
                                    <th>{{trans('trans.tele')}}</th>
                                    <th>{{trans('trans.job')}}</th>
                                    <th width="2%">{{trans('trans.isactive')}}</th>
                                    <th width="12%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $index=>$employee)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>
                                            <img src="{{asset('upload/'.$employee->avatar)}}" alt="No Image" class="img-rounded" width="70" height="50">
                                        </td>
                                        <td>{{$employee->name}}</td>
                                        <td>{{$employee->salary}}</td>
                                        <td>{{$employee->mobile}}</td>
                                        <td>{{$employee->job}}</td>
                                        <td><label class="label {{$employee->isactive==1?'label-success':'label-danger'}}">{{$employee->isactive==1?'Active':'notActive'}}</label></td>
                                        <td>
                                            <button role="button" data-toggle="modal" data-target="#exampleModal" data-id="{{$employee->id}}" class="btn btn-primary btn-sm showemployee"><i class="fa fa-eye"></i></button>
                                            @if(auth()->user()->hasPermission('update_employees'))
                                                <a href="{{route('employee.edit',$employee->id)}}" role="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if(auth()->user()->hasPermission('delete_employees'))
                                                <button class="deleteRecord btn btn-danger btn-sm" data-id="{{ $employee->id }}" ><i class="fa fa-trash"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    {{--_____Start Model For Show all information of spacefic employee ___________________________--}}

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-lg">
                <div class="modal-header row">
                    <div class="col-md-9">
                        <p>{{trans('trans.personalInfo')}}</p>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>

                </div>
                <div class="modal-body printthis">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="image">
                                <img src="" class="img-rounded img-responsive" width="140" height="150" alt="User Image" id="empImg">
                            </div>
                        </div>
                    </div><br>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="name">{{--@lang('site.name')--}}{{trans('trans.name')}}</label>
                                <input type="text" name='name' class="form-control inputmodal" id="name" placeholder="name..">
                            </div>

                            <div class="col-xs-2">
                                <label for="salary">{{trans('trans.salary')}}</label>
                                <input type="number" name="salary" id="salary" class="form-control inputmodal">
                            </div>
                        </div><br>
                        {{--start part of salary--}}
                        <div class="row">
                            <div class="col-xs-3">
                                <label for="num_days">{{trans('trans.num_days')}}</label>
                                <input type="number" name="numDays" id="num_days" value="0" class="form-control inputmodal">
                            </div>
                            <div class="col-xs-2">
                                <label for="num_hours">{{trans('trans.num_hours')}}</label>
                                <input type="number" name="numHours" id="num_hours" value="0" class="form-control inputmodal">
                            </div>

                            <div class="col-xs-2">
                                <label for="valuOfDay">{{trans('trans.v_day')}}</label>
                                <input type="number" name="S_perDay" id="S_perDay" value="0" class="form-control" readonly>
                            </div>
                            <div class="col-xs-2">
                                <label for="valuOfHour">{{trans('trans.v_hour')}}</label>
                                <input type="number" name="S_perHour" id="S_perHour" value="0" class="form-control inputmodal" readonly>
                            </div>
                        </div><br>

                        {{--end part of salary-------------------------------------------}}

                        <div class="row">
                            <div class="col-xs-4">
                                <label for="tele">{{-- @lang('site.telepthone')--}}{{trans('trans.tele')}}</label>
                                <input type="tel" name="mobile"  class="form-control inputmodal" id="mobile"  placeholder="Your Mobile Number">
                            </div>

                            <div class="col-xs-4">
                                <label for="tele">{{trans('trans.balance')}}</label>
                                <input type="text" name="balance"  class="form-control inputmodal" id="balance">
                            </div>
                        </div><br>

                        <div class="row">

                            <div class="col-xs-4">
                                <label for="status">{{trans('trans.status')}}{{--@lang('site.Social_status')--}}</label>
                                <select class="form-control myselect" name="status" id="status">
                                    <option value="0">{{trans('trans.student')}}</option>
                                    <option value="1">{{trans('trans.single')}}</option>
                                    <option value="2">{{trans('trans.married')}}</option>
                                </select>
                            </div>

                            <div class="col-xs-4">
                                <label for="qualification">{{trans('trans.qualification')}}</label>
                                <select class="form-control myselect" name="qualification" id="qualification">
                                    <option value="2">{{trans('trans.high')}}</option>
                                    <option value="1">{{trans('trans.midiate')}}</option>
                                    <option value="0">{{trans('trans.low')}}</option>
                                </select>
                            </div>

                            <div class="col-xs-4">
                                <label for="socialnumber">{{trans('trans.national_id')}}</label>
                                <input type="text" name="nationalId" class="form-control inputmodal" id="nationalId">
                            </div>
                        </div><br>

                        <div class="row">

                            <div class="col-xs-4">
                                <label for="job">{{trans('trans.job')}}</label>
                                <input type="text" name="job" class="form-control inputmodal" id="job" placeholder="{{trans('trans.job')}}....">
                            </div>

                            <div class="form-group col-xs-8">
                                <label for="address">{{trans('trans.address')}}</label>
                                <input type="text" name="address" class="form-control inputmodal" id="address" placeholder="{{trans('trans.address')}}">
                            </div>

                        </div>

                        <div class="form-group">
                            <label>{{trans('trans.notes')}}</label>
                            <textarea class="form-control" name="note" rows="1" id="note"  placeholder="{{trans('trans.notes')}}..."></textarea>
                        </div>

                        <div>
                            <input type="checkbox" id="isactive" name="isactive" class="inputmodal">
                            <label for="isactive"> {{trans('trans.isactive')}}</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="print btn btn-primary"><i class="fa fa-print"></i> {{trans('trans.print')}}</button>
                </div>
            </div>
        </div>
    </div>

    {{--____________________________________________________________________________________________--}}
@endsection
@section('script')
    <script>
        $(".deleteRecord").click(function(){
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            swal({
                title: "{{trans('trans.question')}}",
                text: "{{trans('trans.info')}}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax(
                            {
                                url: "employee/"+id,
                                method:"DELETE",
                                data: {
                                    "_token": token,
                                },
                                success: function (data){
                                    swal(`${data.status}`, {icon: "success"});
                                    setTimeout(function () {
                                        window.location.reload(true);
                                    },1500)
                                }
                            });
                    }
                });
        });

        $(".showemployee").click(function () {
            $('.inputmodal').attr('readonly','readonly');
            $(".myselect").attr('disabled','disabled');
            var id = $(this).data('id');
            $.ajax({
                method:"GET",
                url:"employee/"+id,
                success:function (employee) {
                    // console.log(employee.isactive);
                    $("#name").val(employee.name);
                    $("#salary").val(employee.salary);
                    $("#num_days").val(employee.numDays);
                    $("#num_hours").val(employee.numHours);
                    $("#S_perDay").val(employee.S_perDay);
                    $("#S_perHour").val(employee.S_perHour);
                    $("#mobile").val(employee.mobile);
                    $("#balance").val(employee.balance);
                    $("#status").val(employee.status);
                    $("#qualification").val(employee.qualification);
                    $("#nationalId").val(employee.nationalId);
                    $("#job").val(employee.job);
                    $("#address").val(employee.address);
                    $("#note").val(employee.note);
                    $("#empImg").attr('src','{{asset('upload/')}}/'+employee.avatar);
                    $("#isactive").prop('checked',employee.isactive==1?'checked':'').prop('disabled','disabled')

                }
            });

        });
    </script>
@endsection
