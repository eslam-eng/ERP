@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                            @foreach($products as $product)
                                <div class="col-lg-3 col-xs-6">
                                    <!-- small box -->
                                    <div class="small-box {{$product->qty==0?'bg-red':'bg-green'}}">
                                        <div class="inner">
                                            <h3>{{$product->qty}}</h3>

                                            <p>{{$product->name}}</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-cube"></i>
                                        </div>
                                        {{--<p class="small-box-footer bg-green"><i class="fa fa-dot-circle-o"></i></p>--}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

@endsection
