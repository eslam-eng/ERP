@extends('dashbord.master')
@section('content')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if(auth()->user()->hasPermission('create_products'))
                <h1>
                    <a href="{{route('product.create')}}" role="button" class="btn btn-primary"><i class="fa fa-plus"></i> {{trans('trans.addproduct')}}</a>
                </h1>
            @endif
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> {{trans('trans.home')}}</a></li>
                <li class="active">{{trans('trans.products_data')}}</li>
            </ol>
        </section><br>

        <!-- Main content -->
        <section class="content">

{{--            @include('dashbord.messageFlash.message')--}}
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <a href="{{route('product.show','1')}}" class="btn btn-default pull-left" role="button"><i class="fa fa-print"></i>{{trans('trans.print')." ".trans('trans.allproducts')}}</a>
                            <h3 class="box-title">{{trans('trans.products')}}  <small>{{trans('trans.preview')}}</small></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="2%">#</th>
                                    <th>{{trans('trans.date')}}</th>
                                    <th>{{trans('trans.name')}}</th>
                                    <th>{{trans('trans.qty')}}</th>
                                    <th>{{trans('trans.onestore')}}</th>
                                    {{--<th>{{trans('trans.onestore')}}</th>--}}
                                    <th>{{trans('trans.notes')}}</th>
                                    <th width="10%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $index=>$product)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$product->date}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->qty}}</td>
                                        <td>{{$product->getStoreInfo()->name}}</td>
                                        {{--<td>{{$product->getCategoryInfo()->name}}</td>--}}
                                        <td>{{$product->note}}</td>
                                        <td>
                                            @if(auth()->user()->hasPermission('update_products'))
                                                <a href="{{route('product.edit',$product->id)}}" role="button" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if(auth()->user()->hasPermission('delete_products'))
                                                <button class="deleteRecord btn btn-danger" data-id="{{ $product->id }}" ><i class="fa fa-trash"></i></button>
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
            url: "product/" + id,
            method: "DELETE",
            data: {
            "_token": token,
            },
            success: function (data) {
                swal(`${data.data}`, {icon: "success"});
            setTimeout(function () {
            window.location.reload();
            }, 800)

            }
        });
    }
    });
    });

</script>
@endsection
