@extends('dashbord.master')
@section('content')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if(auth()->user()->hasPermission('create_cost_deal_customer'))
                <h1>
                    <a href="{{route('customer-Deal-order.create')}}" role="button" class="btn btn-primary"><i class="fa fa-plus"></i> {{trans("trans.add_deal_order")}}</a>
                </h1>
            @endif
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> {{trans("trans.Dashbord")}}</a></li>
                <li class="active"><a href="#">{{trans("trans.deal_customer_data")}}</a></li>
            </ol>
        </section><br><br>

        <!-- Main content -->
        <section class="content">

{{--            @include('dashbord.messageFlash.message')--}}

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="2%">#</th>
                                    <th>{{trans("trans.date")}}</th>
                                    <th>{{trans("trans.deal_num")}}</th>
                                    <th>{{trans("trans.finaltotal")}}</th>
                                    <th>{{trans("trans.tax")}}</th>
                                    <th>{{trans("trans.discount")}}</th>
                                    <th>{{trans("trans.finaltotal")}}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($deal_orders as $index=>$deal_order)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{date('l',strtotime($deal_order->date))}} | {{$deal_order->date}}</td>
                                        <td>{{$deal_order->deal_id." | ".$deal_order->deal->descdeal}}</td>
                                        <td>{{$deal_order->total}}</td>
                                        <td>{{$deal_order->tax}}</td>
                                        <td>{{$deal_order->discount}}</td>
                                        <td>{{$deal_order->total/100*$deal_order->tax+$deal_order->total-$deal_order->discount}}</td>
                                        <td>
                                            {{--                                            <a href="{{route('purchaseInvoice.show',$purchase_invoice->id)}}" role="button" class="btn btn-primary btn-sm" title="Show details bill"><i class="fa fa-eye"></i></a>--}}
                                            <a href="{{route('customer-Deal-order.show',$deal_order->id)}}" role="button" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                            @if(auth()->user()->hasPermission('update_cost_deal_customer'))
                                                <a href="{{route('customer-Deal-order.edit',$deal_order->id)}}" role="button" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if(auth()->user()->hasPermission('delete_cost_deal_customer'))
                                                <button class="deleteRecord btn btn-danger" data-id="{{ $deal_order->id }}" ><i class="fa fa-trash"></i></button>
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
                                url: "customer-Deal-order/" + id,
                                method: "DELETE",
                                data: {
                                    "_token": token,
                                },
                                success: function (data) {
                                    swal(`${data['data']}`, {icon: "success"});
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 900)

                                }
                            });
                    }
                });
        });
    </script>
@endsection
