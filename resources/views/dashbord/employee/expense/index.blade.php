@extends('dashbord.master')
@section('content')

    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="box-header">
                @if(auth()->user()->hasPermission('create_acountemployees'))
                    <h2 class="box-title"><a href="{{route('expense.create')}}" role="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i> {{trans('trans.addexpenses')}} </a></h2>
                @endif
            </div>

            <ol class="breadcrumb">
                <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> {{trans('trans.home')}}</a></li>
                <li><a href="#">{{trans('trans.employees')}}</a></li>
                <li class="active">{{trans('trans.expenses')}}</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
{{--         @include('dashbord.messageFlash.message')--}}

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
                                    <th width="20%">{{trans('trans.name')}}</th>
{{--                                    <th>{{trans('trans.value')}}</th>--}}
{{--                                    <th>{{trans('trans.extratime')}}</th>--}}
                                    <th>{{trans('trans.borrows')}}</th>
                                    <th>{{trans('trans.reward')}}</th>
                                    <th>{{trans('trans.discount')}}</th>

                                    <th>{{trans('trans.notes')}}</th>
                                    <th width="10%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($expenses as $index=>$expens)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{date('l',strtotime($expens->date))."|".$expens->date}}</td>
                                        <td>
                                            {{$expens->employee->name}}
                                        </td>
{{--                                        <td>{{$expens->extraTime==''?'':$expens->extraTime."H | ". $expens->extraTime*$expens->employee->S_perHour." L.E"}}</td>--}}
                                        <td>{{$expens->borrow }} </td>
                                        <td>{{$expens->reward }}</td>
                                        <td>{{$expens->S_deduct }}</td>

                                        <td>
                                          {{$expens->note==''?'':$expens->note}}
                                        </td>
                                        <td>
                                            @if(auth()->user()->hasPermission('update_acountemployees'))
                                                <a href="{{route('expense.edit',$expens->id)}}" role="button" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if(auth()->user()->hasPermission('delete_acountemployees'))
                                                <a role="button" data-id="{{$expens->id}}" class="btn btn-danger deleteExpense"><i class="fa fa-trash"></i></a>
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
        $('.deleteExpense').click(function () {
            var id = $(this).data('id');
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
                                url: "expense/"+id,
                                dataType:'json',
                                method:"DELETE",
                                data: {
                                    "_token": token,
                                },
                                success: function (data){
                                    swal(`${data.status}`, {icon: "success"});
                                    setTimeout(function () {
                                        window.location.reload();
                                    },700)
                                }
                            });
                    }
                });
        });
    </script>
@endsection
