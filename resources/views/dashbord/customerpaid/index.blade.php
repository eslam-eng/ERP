@extends('dashbord.master')
@section('content')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if(auth()->user()->hasPermission('create_customerpaid'))
                <h1>
                    <a href="{{route('customer-paid.create')}}" role="button" class="btn btn-primary"><i class="fa fa-plus"></i> {{trans("trans.addcustomerpaid")}}</a>
                </h1>
            @endif
            <ol class="breadcrumb">
                <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> {{trans("trans.Dashbord")}}</a></li>
                <li><a href="#">{{trans("trans.customerpaid")}}</a></li>
            </ol>
        </section><br>

        <!-- Main content -->
        <section class="content">
            {{--@include('dashbord.messageFlash.message')--}}
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{trans("trans.customerpaid")}} <small>{{trans("trans.preview")}}</small></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="2%">#</th>
                                    <th>{{trans('trans.date')}}</th>
                                    <th>{{trans("trans.name")}}</th>
                                    <th>{{trans("trans.desc_deal")}}</th>
                                    <th>{{trans("trans.receiver")}}</th>
                                    <th>{{trans("trans.value")}}</th>
                                    <th>{{trans("trans.notes")}}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($customerpaids as $index=>$customerpaid)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{date('l',strtotime($customerpaid->date)).'| '.$customerpaid->date}}</td>
                                        <td>{{$customerpaid->customer->name}}</td>
                                        <td>{{$customerpaid->deal->descdeal}}</td>
                                        <td>{{$customerpaid->receiver}}</td>
                                        <td>{{$customerpaid->value}}</td>
                                        <td>{{$customerpaid->note}}</td>
                                        <td>
                                            @if(auth()->user()->hasPermission('update_customerpaid'))
                                                <a href="{{route('customer-paid.edit',$customerpaid->id)}}" role="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if(auth()->user()->hasPermission('delete_customerpaid'))
                                                <button class="deleteRecord btn btn-danger btn-sm" data-id="{{ $customerpaid->id }}" ><i class="fa fa-trash"></i></button>
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
                                url: "customer-paid/" + id,
                                method: "DELETE",
                                data: {
                                    "_token": token,
                                },
                                success: function (data) {
                                    // console.log(data.data)
                                    swal(`${data.data}`, {icon: "success"});
                                    setTimeout(function () {
                                        window.location.reload(true);
                                    }, 900)

                                }
                            });
                    }
                });
        });

    </script>
@endsection
