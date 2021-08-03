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
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans('trans.products')}}</a></li>
                <li class="active">{{trans('trans.updateproduct')}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
{{--            @include('dashbord.messageFlash.message')--}}
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
                        <form method="post" action="{{route('product.update',$product->id)}}" role="form">
                            @csrf
                            @method('PUT')
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="value">{{trans('trans.name')}}</label>
                                    <input type="text" name="name" class="form-control" value="{{$product->name}}" placeholder="Product Name">
                                    @if($errors->has('name'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('name')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="value">{{trans('trans.qty')}}</label>
                                    <input type="number" min="1" name="qty" value="{{$product->qty}}" class="form-control" placeholder="Product Quantity">
                                    @if($errors->has('qty'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('qty')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="type">{{trans('trans.onestore')}}</label>
                                    <div>
                                        <select name="store" id="store" class="form-control">
                                                @foreach($stores as $store)
                                                    <option value="{{$store->id}}" {{$store->id==$product->store?'selected':''}}>{{$store->name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>


                                {{--<div class="form-group">--}}
                                    {{--<label for="type">{{trans('trans.onecategory')}}</label>--}}
                                    {{--<div>--}}
                                        {{--<select name="category" id="category" class="form-control">--}}
                                                {{--@foreach($categories as $category)--}}
                                                    {{--<option value="{{$category->id}}" {{$category->id==$product->category?'selected':''}}>{{$category->name}}</option>--}}
                                                {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                <div class="form-group">
                                    <label for="note">{{trans('trans.notes')}}</label>
                                    <div>
                                        <textarea class="form-control" name="note" id="note" placeholder="Your Notes....">{{$product->note}}</textarea>
                                    </div>
                                </div>

                                <div>
                                    <input type="checkbox" id="isactive" name="isactive" value="{{$product->isactive}}" {{$product->isactive==1?'checked':''}}>
                                    <label for="isactive"> {{trans('trans.isactive')}}</label>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">{{trans('trans.submit')}}</button>
                                <a href="{{route('product.index')}}" role="button" class="btn btn-default pull-right">{{trans('trans.back')}}</a>
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
