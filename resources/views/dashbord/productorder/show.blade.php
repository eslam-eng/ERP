@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
           @foreach($orders as $index=>$order)
                    <div class="col-md-4">
                        <!-- About Me Box -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{trans("trans.date")}} : {{date('Y-m-d',strtotime($index))}} </h3>
                                {{--<button class="btn btn-primary pull-left"><i class="fa fa-print"></i>{{trans('trans.print')}}</button>--}}
                            </div>
                            <!-- /.box-header -->

                                <div class="box-body" data-id="{{date('Y-m-d',strtotime($index))}}">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{trans("trans.product")}}</th>
                                                <th>{{trans("trans.qty")}}</th>
                                                <th>{{trans("trans.notes")}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order as $index=>$spaceficorder)
                                                {{--{{($spaceficorder->productInfo()->name)}}--}}
                                                 <tr>
                                                    <td>{{$spaceficorder->productInfo()->name}}</td>
                                                    <td>{{$spaceficorder->amount}}</td>
                                                    <td>{{$spaceficorder->note}}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>

                                    </table>
                                </div>


                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
           @endforeach
        </section>
        <!-- /.content -->
    </div>

@endsection
