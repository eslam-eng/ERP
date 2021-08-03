@extends('dashbord.master')
@section('content')

    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @if(auth()->user()->hasPermission('create_empproductable'))
                    <a href="{{route('employeeproductable.create')}}" role="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i> اضافه</a>
                @endif
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> {{trans('trans.home')}}</a></li>
                <li class="active"> {{trans('trans.empproductable')}}</li>
            </ol>
        </section><br>

        <!-- Main content -->
        <section class="content">

            {{--@include('dashbord.messageFlash.message')--}}

            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="2%">#</th>
                                    <th>{{trans('trans.date')}}</th>
                                    <th>{{trans('trans.name')}}</th>
                                    <th>{{trans('trans.desc_work')}}</th>
                                    <th>{{trans('trans.finaltotal')}}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($emp_productable as $productable)
                                    <tr>
                                        <td>{{$productable->id}}</td>
                                        <td>{{$productable->date}}</td>
                                        <td>{{$productable->employee->name}}</td>
                                        <td>{{$productable->desc_work}}</td>
                                        <td>{{$productable->finaltotal}}</td>
                                        <td>
                                            @if(auth()->user()->hasPermission('read_empproductable'))
                                                <a href="{{route('employeeproductable.show',$productable->id)}}" role="button" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                            @endif

                                            @if(auth()->user()->hasPermission('read_empproductable'))
                                                    <a href="{{route('employeeproductable.edit',$productable->id)}}" role="button" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            @endif

                                            @if(auth()->user()->hasPermission('delete_empproductable'))
                                                <a role="button" data-id="{{$productable->id}}" class="btn btn-danger deleteRecord"><i class="fa fa-trash"></i></a>
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
                                url: "employeeproductable/"+id,
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
