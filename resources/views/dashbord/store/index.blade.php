@extends('dashbord.master')
@section('content')

    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if(auth()->user()->hasPermission('create_store'))
            <h1>
                <a href="{{route('stock.create')}}" role="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i> {{trans('trans.addstore')}}</a>
            </h1>
            @endif
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> {{trans('trans.home')}}</a></li>
                <li class="active"> {{trans('trans.storedata')}}</li>
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
                                    <th>{{trans('trans.name')}}</th>
                                    <th>{{trans('trans.descriotion')}}</th>
                                    <th>{{trans('trans.isactive')}}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($stocks as $index=>$stock)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$stock->name}}</td>
                                        <td>{{$stock->desc}}</td>
                                        <td>
                                            <label class="label {{$stock->isactive==1?'label-success':'label-danger'}}">{{$stock->isactive==1?'Active':'Not Active'}}</label>
                                        </td>
                                        <td>
                                            <a href="{{route('stock.show',$stock->id)}}" role="button" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                            @if(auth()->user()->hasPermission('update_store'))
                                            <a href="{{route('stock.edit',$stock->id)}}" role="button" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if(auth()->user()->hasPermission('delete_store'))
                                                <a role="button" data-id="{{$stock->id}}" class="btn btn-danger deleteStore"><i class="fa fa-trash"></i></a>
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
        $(".deleteStore").click(function(){
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            swal({
                title: "{{trans('trans.question')}}",
                text: "{{trans('trans.info_store')}}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax(
                            {
                                url: "stock/"+id,
                                method:"DELETE",
                                data: {
                                    "_token": token,
                                },
                                success: function (data){
                                    swal(`${data.data}`, {icon: "success"});
                                    setTimeout(function () {
                                        window.location.reload();
                                    },800)
                                }
                            });
                    }
                });
        });
    </script>
@endsection
