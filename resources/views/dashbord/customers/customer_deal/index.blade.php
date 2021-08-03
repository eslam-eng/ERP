@extends('dashbord.master')
@section('content')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if(auth()->user()->hasPermission('create_customerdeal'))
                <h1>
                    <a href="{{route('customer-Deal.create')}}" role="button" class="btn btn-primary"><i class="fa fa-plus"></i> {{trans('trans.addcustomerdeal')}}</a>
                </h1>
            @endif
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> {{trans('trans.home')}}</a></li>
                <li class="active"><a href="#">{{trans('trans.customers_data')}}</a></li>
            </ol>
        </section><br><br>

        <!-- Main content -->
        <section class="content">
{{--            @include('dashbord.messageFlash.message')--}}
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
                                    <th width="2%">#</th>
                                    <th>{{trans('trans.name')}}</th>
                                    <th>{{trans('trans.date')}}</th>
                                    <th>{{trans('trans.desc_deal')}}</th>
                                    <th>{{trans('trans.customerdealtotal')}}</th>
                                    <th>{{trans('trans.paytype')}}</th>
                                    <th>{{trans('trans.pay_value')}}</th>
                                    <th>{{trans('trans.notes')}}</th>
                                    <th width="12%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $index=>$customer)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$customer->customer->name}}</td>
                                        <td>{{date('l',strtotime($customer->date))}} | {{$customer->date}}</td>
                                        <td>{{$customer->descdeal}}</td>
                                        <td>{{$customer->dealtotal}}</td>
                                        <td>
                                            @if($customer->pay_type==0)
                                                <label class="label label-success">{{trans("trans.cash")}}</label>
                                            @elseif($customer->pay_type==-1)
                                                <label class="label label-danger">{{trans("trans.pendding")}}</label>
                                            @else
                                                <label class="text-bold label label-warning">{{trans('trans.somemony')}}</label>
                                            @endif
                                        </td>
                                        <td>{{$customer->somepaid}}</td>
                                        <td>{{$customer->note}}</td>
                                        <td>
                                            <a href="{{route('customer-Deal.show',$customer->id)}}" role="button" class="btn btn-primary btn-sm"><i class="fa fa-eye" title="{{trans('trans.attachments')}}"></i></a>
                                            @if(auth()->user()->hasPermission('update_customerdeal'))
                                                <a href="{{route('customer-Deal.edit',$customer->id)}}" role="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                            @endif
                                             @if(auth()->user()->hasPermission('delete_customerdeal'))
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

    {{--    end model --}}

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
                                url: "customer-Deal/"+id,
                                method:"DELETE",
                                data: {
                                    "_token": token,
                                },
                                success: function (data){
                                    swal(`${data.data}`, {icon: "success"});
                                    setTimeout(function () {
                                        window.location.reload(true);
                                    },1000)
                                }
                            });
                    }
                });
        });
    </script>
@endsection
