@extends('dashbord.master')
@section('content')
    <style>
        #paymentvalue{
            display: none;
        }
    </style>
    <div class="content-wrapper">
        <section class="content-header">
            <a href="{{route('employeeproductable.index')}}" class="btn btn-default" role="button">{{trans('trans.back')}}</a>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans('trans.empproductable')}}</a></li>
                <li class="active">{{trans('trans.add')}}</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->

            <div class="row">
                <div class="col-md-4"><strong class="pull-right" style="display: inline-block">{{trans('trans.date')}}: {{date('Y-m-d')}}</strong></div>
                <div class="col-md-8 pull-right"><i class="fa fa-globe"></i>{{trans('trans.elmhlawy')}}</div>
                <!-- /.col -->
                <!-- /.col -->
            </div><hr><br>

            {{--start Form -----------------------------------------------------------------}}
            <form action="{{route('employeeproductable.store')}}" method="post" role="form">
            @csrf
            <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <label for="recevier"><strong>{{trans('trans.employee')}}</strong></label>
                        <select class="form-control select2" name="empId" id="recevier" style="width: 100%">
                            @foreach($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-4 invoice-col">
                        <label for="desc_work"><strong>{{trans("trans.desc_work")}}</strong></label>
                        <input type="text" name="desc_work"  class="form-control">
                    </div>

                </div>
                <br><br>
                <!-- /.row -->

                <!-- Table row -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-responsive" id="bill">
                        <thead>
                        <tr>
                            <th>{{trans('trans.product')}}</th>
                            <th>{{trans('trans.qty')}}</th>
                            <th>{{trans('trans.price')}}</th>
                            <th>{{trans('trans.finaltotal')}}</th>
                            <th>{{trans('trans.notes')}}</th>
                            <th width="3%"><button class="btn-sm btn-success no-border" id="addrow"><i class="fa fa-plus"></i></button></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="text" class="form-control name" name="product[]"></td>
                            <td><input type="text" value="1" class="form-control qty" name="qty[]" autocomplete="off"></td>
                            <td><input type="number" class="form-control price" name="unitprice[]" autocomplete="off"></td>
                            <td><input type="number" class="form-control subtotal" name="subtotal[]" readonly></td>
                            <td><input type="text" class="form-control notes" name="note[]"></td>
                            <td></td>
                        </tr>

                        </tbody>

                    </table>
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-6 pull-right">
                        <div class="table-responsive">
                            <table class="table" id="tfooter">
                                <tr>
                                    <td><input type="text" name="finaltotal" id="finaltotal" class="form-control" readonly></td>
                                    <th>{{trans('trans.finaltotal')}}</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-xs-6 pull-left">

                        <h4 class="alert-danger">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </h4>

                    </div>
                    <!-- /.col -->
                </div>
                <br><br>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-xs-12">
                        <button type="submit" id="submit" class="btn btn-primary">{{trans('trans.submit')}}</button>
                    </div>
                </div>
            </form>

        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
@endsection

@section('script')
    <script src="{{asset('dashbord/dist/js/purchase_invoice.js')}}"></script>
    {{--<script>--}}
        {{--$("#submit").click(function (e) {--}}
            {{--e.preventDefault();--}}
            {{--var data = $("#formdata").serialize();--}}
            {{--$.ajax({--}}
                {{--method:'post',--}}
                {{--url:"{{route('employeeproductable.store')}}",--}}
                {{--data:data,--}}
                {{--success:function (response) {--}}

                    {{--console.log(response.status)--}}

                    {{--// if (response.status==true){--}}
                    {{--//     swal({--}}
                    {{--//         title: "Purchase Saved Successfully",--}}
                    {{--//         text: "Do You Want to Print It ?",--}}
                    {{--//         icon: "success",--}}
                    {{--//         buttons: true,--}}
                    {{--//         dangerMode: true,--}}
                    {{--//     })--}}
                    {{--//         .then((willDelete) => {--}}
                    {{--//             if (willDelete) {--}}
                    {{--//                 alert('Print Function');--}}
                    {{--//                 window.location.reload();--}}
                    {{--//             } else {--}}
                    {{--//                 window.location.reload();--}}
                    {{--//             }--}}
                    {{--//         });--}}
                    {{--// }--}}
                {{--},error:function (data_error,exception) {--}}
                    {{--if (exception=='error'){--}}
                        {{--var error_list='';--}}
                        {{--$.each(data_error.responseJSON.errors,function (key,value) {--}}
                            {{--error_list+='<li>'+value+'</li>';--}}
                        {{--});--}}
                        {{--$(".alert-error ").html("<ul>"+error_list+"</ul>");--}}
                    {{--}--}}
                {{--}--}}
            {{--})--}}
        {{--});--}}
    {{--</script>--}}
@endsection
{{-------------------------------------------------------}}
