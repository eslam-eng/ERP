@extends('dashbord.master')
@section('content')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            @if(auth()->user()->hasPermission('create_users'))
            <h1>
                <a href="{{route('users.create')}}" role="button" class="btn btn-primary"><i class="fa fa-plus"></i> {{trans('trans.adduser')}}</a>
            </h1>
            @endif
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> {{trans('trans.Dashbord')}}</a></li>
                <li><a href="#">{{trans('trans.users')}}</a></li>
            </ol>
        </section><br>

        <!-- Main content -->
        <section class="content">
{{--            @include('dashbord.messageFlash.message')--}}
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{trans('trans.users')}} <small>{{trans('trans.preview')}}</small></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="2%">#</th>
                                    <th>{{trans('trans.name')}}</th>
                                    <th>{{trans('trans.email')}}</th>
                                    <th>{{trans('trans.status')}}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($users as $index=>$user)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td><label class="label {{$user->isactive==1?'label-success':'label-danger'}}">{{$user->isactive==1? trans('trans.active'): trans('trans.not_active')}}</label></td>
                                        <td>
                                            @if(auth()->user()->hasPermission('update_users'))
                                                <a href="{{route('users.edit',$user->id)}}" role="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if(auth()->user()->hasPermission('delete_users'))
                                                <button class="deleteRecord btn btn-danger btn-sm" data-id="{{ $user->id }}" ><i class="fa fa-trash"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
                                url: "users/"+id,
                                method:"DELETE",
                                data: {
                                    "_token": token,
                                },
                                success: function (data){
                                    swal(`${data}`, {icon: "success"});
                                    setTimeout(function () {
                                        window.location.reload();
                                    },1200)
                                }
                            });
                    }
                });
        });
    </script>
@endsection
