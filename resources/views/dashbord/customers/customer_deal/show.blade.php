@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{trans('trans.attachments')}} </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-header">
                                <h3 class="box-title">{{trans('trans.preview_images')}} </h3>
                            </div>
                            {{-- customer images --}}
                                @if(!empty($customerimages))
                                    @foreach($customerimages as $image)
                                        <img class="img img-thumbnail" width="220" height="220" src="{{asset('upload/')."/".$image->file_name.".".$image->extention}}">
                                    @endforeach
                                @endif
                            <br>
                        </div>


                        <div class="box-body">
                            <div class="box-header">
                                <h3 class="box-title">{{trans('trans.preview_files')}} </h3>
                            </div>
                            {{-- customer images --}}
                            @if(!empty($customerfiles))
                                @foreach($customerfiles as $file)
                                    <i class="fa fa-file fa-3x"></i> <a href="{{asset('upload/')."/".$file->file_name.".".$file->extention}}" download>{{$file->file_name.".".$file->extention}}</a>
                                @endforeach
                            @endif

                            <br>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    {{--    end model --}}

@endsection
