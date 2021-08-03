@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{trans('trans.customerdeal')}}
                <small>{{trans('trans.preview')}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> {{trans('trans.customer_data')}}</a></li>
                <li class="active">{{trans('trans.customerdeal')}}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            {{--@include('dashbord.messageFlash.message')--}}
            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border bg-blue-gradient">
                            <i class="fa fa-file"></i>
                            <h3 class="box-title">{{trans('trans.customerdeal')}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form method="post" action="{{route('customer-Deal.update',$customer_deal->id)}}" role="form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">{{trans('trans.name')}}</label>
                                    <div>
                                        <select name="customer_id" id="name" class="form-control">
                                            <option value="{{$customer_deal->customer_id}}">{{$customer_deal->customer->name}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="value">{{trans('trans.desc_deal')}}</label>
                                    <input type="text" name="descdeal" value="{{$customer_deal->descdeal}}" class="form-control">
                                    @if($errors->has('descdeal'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('descdeal')}}</strong>
                                        </h5>
                                    @endif
                                </div>



                                <div class="form-group">
                                    <label for="value">{{trans('trans.customerdealtotal')}}</label>
                                    <input type="number" name="dealtotal" value="{{$customer_deal->dealtotal}}" class="form-control">
                                    @if($errors->has('dealtotal'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('dealtotal')}}</strong>
                                        </h5>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label for="pay_type">{{trans('trans.paytype')}}</label>
                                    <div>
                                        <select name="pay_type" id="pay_type" class="form-control">
                                            <option value="0" {{$customer_deal->pay_type==0?'selected':''}}>{{trans("trans.cash")}}</option>
                                            <option value="-1" {{$customer_deal->pay_type==-1?'selected':''}}>{{trans("trans.pendding")}}</option>
                                            <option value="1" {{$customer_deal->pay_type==1?'selected':''}}>{{trans("trans.somemony")}}</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group" id="somepaid">
                                    <label for="value">{{trans('trans.pay_value')}}</label>
                                    <input type="number" name="somepaid" id="payvalue" value="{{$customer_deal->somepaid==''?0:$customer_deal->somepaid}}" class="form-control">
                                    @if($errors->has('somepaid'))
                                        <h5 class="text-danger">
                                            <strong>{{$errors->first('somepaid')}}</strong>
                                        </h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="box">
                                        <div class="box-header">
                                            <?php
                                            $img_extention = ['jpg', 'JPG', 'png' ,'PNG' ,'jpeg' ,'JPEG','gif']
                                            ?>
                                            @foreach($customer_deal->dealAttachments as $dealAttachment)
                                                @if(in_array($dealAttachment->extention,$img_extention))
                                                    <img src="{{asset('upload/')."/".$dealAttachment->file_name.".".$dealAttachment->extention}}" width="180" height="180">
                                                @else
                                                    <strong>
                                                        <i class="fa fa-file fa-3x"></i> <a href="{{asset('upload/')."/".$dealAttachment->file_name.".".$dealAttachment->extention}}">{{$dealAttachment->file_name.".".$dealAttachment->extention}}</a>
                                                    </strong>
                                                @endif
                                            @endforeach

                                        </div>
                                        <div class="box-footer">
                                            <h4 for="file">{{trans('trans.attachments')}} </h4>
                                            <input type="file" name="file[]" class="form-control" multiple="yes" id="file" value="{{old('file[]')}}">
                                            @if($errors->has('file'))
                                                <h5 class="text-danger">
                                                    <strong>{{$errors->first('file')}}</strong>
                                                </h5>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="note">{{trans('trans.notes')}}</label>
                                    <div>
                                        <textarea class="form-control" name="note" id="note" placeholder="Your Notes....">{{$customer_deal->note}}</textarea>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-md-8"><button type="submit" class="btn btn-primary">{{trans('trans.update')}}</button></div>
                                    <div class="col-md-4"><a href="{{route('customer-Deal.index')}}" role="button" class="btn btn-default pull-right">{{trans('trans.back')}}</a></div>
                                </div>

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
@section('script')
    <script>
        $("#pay_type").change(function () {
            if ($("#pay_type").val()==0||$("#pay_type").val()==-1) {$("#payvalue").val(0);}
            // $("#somepaid").hide();
            else {$("#somepaid").show();}


        });
    </script>
@endsection


