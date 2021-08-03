@extends('dashbord.master')
@section('content')

    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <a href="{{route('DailyExpense.create')}}" role="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i> {{trans('trans.addexpenses')}}</a>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> {{trans('trans.home')}}</a></li>
                <li class="active"> {{trans('trans.expenses')}}</li>
            </ol>
        </section>

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
                                    <th>{{trans("trans.unknow_expenses")}}</th>
                                    <th>{{trans("trans.maker")}}</th>
                                    <th>{{trans("trans.value")}}</th>
                                    <th>{{trans("trans.notes")}}</th>
                                    <th width="12%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($expenses as $index=>$expens)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$expens->genralexpense}}</td>
                                        <td>{{$expens->maker}}</td>
                                        <td>{{$expens->value}}</td>
                                        <td>{{$expens->note}}</td>
                                        <td>
                                            {{--<a href="{{route('DailyExpense.show',$expens->id)}}" role="button" class="btn btn-primary"><i class="fa fa-eye"></i></a>--}}
                                            <a href="{{route('DailyExpense.edit',$expens->id)}}" role="button" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            <a role="button" data-id="{{$expens->id}}" class="btn btn-danger delete_expense"><i class="fa fa-trash"></i></a>
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
        $(".delete_expense").click(function(){
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            swal({
                title: "{{trans('trans.question')}}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax(
                            {
                                url: "DailyExpense/"+id,
                                method:"DELETE",
                                data: {
                                    "_token": token,
                                },
                                success: function (data){
                                    swal(`${data}`, {icon: "success"});
                                    setTimeout(function () {
                                        window.location.reload();
                                    },1000)
                                }
                            });
                    }
                });
        });
    </script>
@endsection

