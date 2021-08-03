@extends('dashbord.master')
@section('content')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @if(auth()->user()->hasPermission('create_AttLeave'))
                    <a href="{{route('create.AttendanceLeave')}}" role="button" class="btn btn-primary"><i class="fa fa-plus"></i> {{trans('trans.addAttLeave')}}</a>
                @endif
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> {{trans('trans.home')}}</a></li>
                <li class="active"><a href="#">{{trans('trans.AttLeave')}}</a></li>
            </ol>
        </section><br>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{trans('trans.employees_data')}} <small>{{trans('trans.AttLeave')}}</small></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example" class="table table-striped table-responsive">
                                <thead>
                                <tr>
                                    <th>{{trans('trans.name')}}</th>
                                    <th>{{trans('trans.date')}}</th>
                                    <th>{{trans('trans.attendance')}}</th>
                                    <th>{{trans('trans.leave')}}</th>
                                    <th>{{trans('trans.noteattendance')}}</th>
                                    <th>{{trans('trans.noteleave')}}</th>
                                    <th>{{trans('trans.absentnote')}}</th>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($times as $index=>$time)
                                        <tr class="{{$time->absentnote==''?'':'bg-red-gradient'}}">
                                            <td>{{$time->employee->name}}</td>
                                            <td>{{date('l',strtotime($time->date))}} | {{$time->date}}</td>
                                            <td>{{$time->attendanceTime}}</td>
                                            <td>{{$time->leaveTime}}</td>
                                            <td>{{$time->attnote}}</td>
                                            <td>{{$time->leavenote}}</td>
                                            <td>{{$time->absentnote}}</td>
                                            <td>
                                                @if(auth()->user()->hasPermission('update_AttLeave'))
                                                    <a href="{{route('edit.AttendanceLeave',$time->id)}}" role="button" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                @endif
                                                @if(auth()->user()->hasPermission('delete_AttLeave'))
                                                    <button class="deleteRecord btn btn-danger" data-id="{{ $time->id }}" ><i class="fa fa-trash"></i></button>
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
                                url: "delete/attendance&leave/"+id,
                                method:"DELETE",
                                data: {
                                    "_token": token,
                                },
                                success: function (data){
                                    swal(`${data.status}`, {icon: "success"});
                                    setTimeout(function () {
                                        window.location.reload();
                                    },800)

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
                    $("#balance").val(employee.balance);
                    $("#mobile").val(employee.mobile);
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
