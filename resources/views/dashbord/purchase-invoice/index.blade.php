@extends('dashbord.master')
@section('content')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if(auth()->user()->hasPermission('create_buypurchase'))
                <h1>
                    <a href="{{route('purchaseInvoice.create')}}" role="button" class="btn btn-primary"><i class="fa fa-plus"></i> {{trans("trans.buypurchase")}}</a>
                </h1>
            @endif
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> {{trans("trans.Dashbord")}}</a></li>
                <li class="active"><a href="#">{{trans("trans.purchases_data")}}</a></li>
            </ol>
        </section><br>

        <!-- Main content -->
        <section class="content">

{{--            @include('dashbord.messageFlash.message')--}}

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="example" class="table table-bordered table-striped table-responsive">
                                <thead>
                                <tr>
                                    <th width="2%">{{trans("trans.purchase_num")}}</th>
                                    <th width="15%">{{trans("trans.company")}}</th>
                                    <th>{{trans("trans.date")}}</th>
                                    <th>{{trans("trans.receiver")}}</th>
                                    <th>{{trans("trans.paytype")}}</th>
                                    <th>{{trans("trans.finaltotal")}}</th>
                                    <th>{{trans("trans.tax")}}</th>
                                    <th>{{trans("trans.discount")}}</th>
                                    <th>{{trans("trans.finaltotal")}}</th>
                                    <th width="13%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($purchase_invoices as $purchase_invoice)
                                    <tr>
                                        <td>{{$purchase_invoice->id}}</td>
                                        <td>{{$purchase_invoice->supplier->name}}</td>
                                        <td>{{date('l',strtotime($purchase_invoice->date))}} | {{$purchase_invoice->date}}</td>
                                        <td>{{$purchase_invoice->employee->name}}</td>
                                        <td>
                                            @if($purchase_invoice->paytype==0)
                                                <label class="label label-success">{{trans("trans.cash")}}</label>
                                            @elseif($purchase_invoice->paytype==-1)
                                                <label class="label label-danger">{{trans("trans.pendding")}}</label>
                                            @else
                                                <label class="text-bold label label-warning">{{trans('trans.somemony')}} ></label> {{$purchase_invoice->payvalue}}
                                            @endif
                                        </td>
                                        <td>{{$purchase_invoice->total}}</td>
                                        <td>{{$purchase_invoice->discount}}</td>
                                        <td>{{$purchase_invoice->tax}}</td>
                                        <td>{{$purchase_invoice->finaltotal}}</td>
                                        <td>
                                            <a href="{{route('purchaseInvoice.show',$purchase_invoice->id)}}" role="button" class="btn btn-primary btn-sm" title="Show details bill"><i class="fa fa-eye"></i></a>
                                            @if(auth()->user()->hasPermission('update_sellpurchase'))
                                                <a href="{{route('purchaseInvoice.edit',$purchase_invoice->id)}}" role="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if(auth()->user()->hasPermission('delete_sellpurchase'))
                                                <button class="deleteRecord btn btn-danger btn-sm" data-id="{{ $purchase_invoice->id }}" ><i class="fa fa-trash"></i></button>
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
{{--            </div>--}}
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
                                url: "purchaseInvoice/"+id,
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
