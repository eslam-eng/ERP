@extends('dashbord.master')
@section('content')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if(auth()->user()->hasPermission('create_customers'))
                <h1>
                        <a href="{{route('customers.create')}}" role="button" class="btn btn-primary"><i class="fa fa-plus"></i> {{trans('trans.addcustomer')}}</a>
                </h1>
            @endif
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> {{trans('trans.home')}}</a></li>
                <li class="active"><a href="#">{{trans('trans.customers_data')}}</a></li>
            </ol>
        </section><br>

        <!-- Main content -->
        <section class="content">
            {{--@include('dashbord.messageFlash.message')--}}
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><small>{{trans('trans.preview')}}</small> {{trans('trans.customers_data')}} </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <td width="25%">{{trans('trans.name')}}</td>
                                    <td>{{trans('trans.tele')}}</td>
                                    <td width="25%">{{trans('trans.address')}}</td>
                                    <td>{{trans('trans.national_id')}}</td>
                                    <td>{{trans('trans.internal_money')}}</td>
                                    <td>{{trans('trans.notes')}}</td>
                                    <td>{{trans('trans.isactive')}}</td>
                                    <td width="10%"></td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>{{$customer->name}}</td>
                                        <td>{{$customer->mobile}}</td>
                                        <td>{{$customer->address}}</td>
                                        <td>{{$customer->nationalId}}</td>
                                        <td>{{$customer->dept}}</td>
                                        <td>{{$customer->note}}</td>
                                        <td><label class="label {{$customer->isactive==1?'label-success':'label-danger'}}">{{$customer->isactive==1?'Active':'Not Active'}}</label></td>
                                        <td>
                                            @if(auth()->user()->hasPermission('update_customers'))
                                                <a href="{{route('customers.edit',$customer->id)}}" role="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if(auth()->user()->hasPermission('delete_customers'))
                                                <button class="deleteRecord btn btn-danger btn-sm" data-id="{{ $customer->id }}" ><i class="fa fa-trash"></i></button>
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

{{-- end model --}}

@endsection

@section('script')
    <script>
        $(".deleteRecord").click(function() {
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
                                url: "customers/" + id,
                                method: "DELETE",
                                data: {
                                    "_token": token,
                                },
                                success: function (data) {
                                    swal(`${data['data']}`, {icon: "success"});
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 1000)

                                }
                            });
                    }
                });
        });
    </script>
@endsection
