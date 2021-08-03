@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{trans('trans.products')}}  <small>{{trans('trans.preview')}}</small></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="2%">#</th>
                                    <th>{{trans('trans.name')}}</th>
                                    <th>{{trans('trans.qty')}}</th>
                                    <th>{{trans('trans.onestore')}}</th>
                                    <th>{{trans('trans.notes')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $index=>$product)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->qty}}</td>
                                        <td>{{$product->getStoreInfo()->name}}</td>
                                        <td>{{$product->note}}</td>
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
        $(document).ready(function(){
            window.print();
        })
    </script>

@endsection
