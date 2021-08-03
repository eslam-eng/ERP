@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{trans('trans.products')}}
                <small>{{trans('trans.preview')}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans('trans.product_addrequest')}}</a></li>
                <li class="active">{{trans('trans.updateproduct')}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border bg-blue-gradient">
                            <i class="fa fa-cube"></i>
                            <h3 class="box-title">{{trans('trans.product')}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form method="post" action="{{route('productaddrequest.update',$product_addrequest->id)}}" role="form">
                            @csrf
                            @method('PUT')
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="value">{{trans('trans.name')}}</label>
                                    <select name="product_id" id="product_id" class="form-control">
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}" {{$product->id==$product_addrequest->product_id?'selected':''}}>{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('product_id'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('product_id')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="value">{{trans('trans.qty')}}</label>
                                    <input type="number" min="1" name="amount" value="{{$product_addrequest->amount}}" class="form-control">
                                    @if($errors->has('amount'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('amount')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="note">{{trans('trans.notes')}}</label>
                                    <div>
                                        <textarea class="form-control" name="note" id="note" placeholder="Your Notes....">{{$product_addrequest->note}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">{{trans('trans.update')}}</button>
                                <a href="{{route('productaddrequest.index')}}" role="button" class="btn btn-default pull-left">{{trans('trans.back')}}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
