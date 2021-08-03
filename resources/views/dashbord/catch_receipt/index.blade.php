@extends('dashbord.master')
@section('content')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if(auth()->user()->hasPermission('create_supplier_paid'))
                <h1>
                    <a href="{{route('catchreceipt.create')}}" role="button" class="btn btn-primary"><i class="fa fa-plus"></i>{{trans('trans.addsupplier_paid')}}</a>
                </h1>
            @endif
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> {{trans('trans.Dashbord')}}</a></li>
                <li><a href="#">{{trans('trans.supplier_paid')}}</a></li>
            </ol>
        </section><br>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{trans('trans.supplier_paid')}}<small>{{trans('trans.preview')}}</small></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="2%">#</th>
                                    <th>{{trans('trans.name')}}</th>
                                    <th>{{trans('trans.date')}}</th>
                                    <th>{{trans('trans.receiver')}}</th>
                                    <th>{{trans('trans.value')}}</th>
                                    <th>{{trans('trans.notes')}}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($catchReceipts as $index=>$catchReceipt)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$catchReceipt->getName()->name}}</td>
                                        <td>{{date('l',strtotime($catchReceipt->date)).'| '.$catchReceipt->date}}</td>
                                        <td>{{$catchReceipt->receiver==null?$catchReceipt->getName()->name:$catchReceipt->receiver}}</td>
                                        <td>{{$catchReceipt->value}}</td>
                                        <td>{{$catchReceipt->note}}</td>
                                        <td>
                                            @if(auth()->user()->hasPermission('update_supplier_paid'))
                                                <a href="{{route('catchreceipt.edit',$catchReceipt->id)}}" role="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if(auth()->user()->hasPermission('delete_supplier_paid'))
                                                <button class="deleteRecord btn btn-danger btn-sm" data-id="{{ $catchReceipt->id }}" ><i class="fa fa-trash"></i></button>
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
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax(
                            {
                                url: "catchreceipt/" + id,
                                method: "DELETE",
                                data: {
                                    "_token": token,
                                },
                                success: function (data) {
                                    swal(`${data}`, {icon: "success"});
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
