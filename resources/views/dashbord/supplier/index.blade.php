@extends('dashbord.master')
@section('content')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if(auth()->user()->hasPermission('create_suppliers'))
                <h1>
                    <a href="{{route('supplier.create')}}" role="button" class="btn btn-primary"><i class="fa fa-plus"></i> {{trans('trans.addsuppliers')}} </a>
                </h1>
            @endif
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> {{trans('trans.home')}} </a></li>
                <li>{{trans('trans.suppliers_data')}} </li>
            </ol>
        </section><br>

        <!-- Main content -->
        <section class="content">
{{--            @include('dashbord.messageFlash.message')--}}
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{trans('trans.suppliers_data')}}  <small>{{trans('trans.preview')}} </small></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example" class="table table-responsive table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="2%">#</th>
                                    <th>{{trans('trans.company')}}</th>
                                    <th>{{trans('trans.responsible')}}</th>
                                    <th>{{trans('trans.tele')}}</th>
                                    <th>{{trans('trans.email')}}</th>
                                    <th>{{trans('trans.address')}}</th>
                                    <th>{{trans('trans.balance')}}</th>
                                    <th>{{trans('trans.isactive')}}</th>
                                    <th width="10%"></th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach($suppliers as $index=>$supplier)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$supplier->name}}</td>
                                            <td>{{$supplier->responsible}}</td>
                                            <td>{{$supplier->mobile}}</td>
                                            <td>{{$supplier->email}}</td>
                                            <td>{{$supplier->address}}</td>
                                            <td>{{$supplier->balance}}</td>
                                            <td><label class="label {{$supplier->isactive==1?'label-success':'label-danger'}}">{{$supplier->isactive==1?'Active':'Not Active'}}</label></td>
                                            <td>
                                                @if(auth()->user()->hasPermission('update_suppliers'))
                                                    <a href="{{route('supplier.edit',$supplier->id)}}" role="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                @endif
                                               @if(auth()->user()->hasPermission('delete_suppliers'))
                                                    <button class="deleteRecord btn btn-danger btn-sm" data-id="{{ $supplier->id }}" ><i class="fa fa-trash"></i></button>
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
                                url: "supplier/"+id,
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
    </script>
@endsection
