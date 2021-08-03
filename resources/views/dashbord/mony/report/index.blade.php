@extends('dashbord.master')
@section('content')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <h4 class="text-center">
                            {{trans("trans.dailyexpense")}}
                            <small>{{trans("trans.report")}}</small>
                        </h4>
                        <form  action="{{route('mony.report')}}" class="form-horizontal" id="form" role="form" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="date" class="col-sm-2 control-label">{{trans("trans.date")}}</label>
                                <div class="col-sm-4">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="date" class="form-control pull-right datepicker" id="date">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    @if($errors->has('date'))
                                        <h5 class="text-danger pull-right">
                                            <strong>{{$errors->first('date')}}</strong>
                                        </h5>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-2">
                                    <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-search"></i> {{trans("trans.search")}}</button>
                                </div>
                            </div>
                            <br>
                        </form>

                    </div>
                    <!-- /.box -->
                </div>
                <!--/.col (left) -->
            </div>

        </section>
    </div>
@endsection
@section('script')
    <script>
        $('.datepicker').datepicker({
            autoclose: true,
            rtl: true,
            format:'yyyy-mm-dd'
        }).datepicker('setDate','now');
    </script>
@endsection

