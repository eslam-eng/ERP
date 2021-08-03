@extends('dashbord.master')
@section('content')
    <meta name="csrf-token" content="{{csrf_token()}}">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if(auth()->user()->hasPermission('create_mony'))
                <h1>
                    <a href="{{route('Monymove.create')}}" role="button" class="btn btn-primary"><i class="fa fa-plus"></i>{{trans("trans.addmony")}}</a>
                </h1>
            @endif
            <div class="breadcrumb">
                <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal">
                    {{trans("trans.sendingmony")}}
                </button>
{{--                <button role="button" class="endmony btn btn-warning">{{trans("trans.sendingmony")}}</button>--}}
            </div>
        </section><br>

        <!-- Main content -->
        <section class="content">
            {{--@include('dashbord.messageFlash.message')--}}
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{trans("trans.mony_data")}} <small>{{trans("trans.preview")}}</small></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="2%">#</th>
                                    <th>{{trans("trans.nummony")}}</th>
                                    <th>{{trans("trans.date")}}</th>
                                    <th>{{trans("trans.from")}}</th>
                                    <th>{{trans("trans.to")}}</th>
                                    <th>{{trans("trans.value")}}</th>
                                    <th>{{trans("trans.notes")}}</th>
                                    <th width="10%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($charges as $index=>$charge)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$charge->id}}</td>
                                        <td> {{date('Y-m-d h:i A',strtotime($charge->date))}}</td>
                                        <td>{{$charge->from}}</td>
                                        <td>{{$charge->to}}</td>
                                        <td>{{$charge->value}}</td>
                                        <td>{{$charge->note}}</td>
                                        <td>
                                            @if(auth()->user()->hasPermission('update_mony'))
                                                <a href="{{route('Monymove.edit',$charge->id)}}" role="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if(auth()->user()->hasPermission('delete_mony'))
                                                <button class="deleteRecord btn btn-danger btn-sm" data-id="{{ $charge->id }}" ><i class="fa fa-trash"></i></button>
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

{{-- start model for sending mony   --}}




    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-blue-active">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{trans("trans.info_sending_mony")}}</h4>
                </div>
                <form action="{{route('endMony')}}" id="formdata" method="post" role="form">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">{{trans('trans.password')}}</label>
                            <input type="password" name="password" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{trans('trans.date')}}</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="date" class="form-control pull-right datepicker" id="datepicker">
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
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans("trans.close")}}</button>
                    <button type="submit" id="submit" class="btn btn-warning btn-flat">{{trans("trans.sendingmony")}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{--  ------------------------------------------------  --}}

@endsection
@section('script')
{{--    <script src="{{asset('dashbord/dist/js/mony.js')}}"></script>--}}
    <script>
        $('.datepicker').datepicker({
            autoclose: true,
            rtl: true,
            format:'yyyy-mm-dd'
        }).datepicker('setDate','now');
      $("#submit").click(function (e) {
          e.preventDefault();
          // var token = $("meta[name='csrf-token']").attr("content"),
          var  data = $("#formdata").serialize();
          $.ajax(
              {
                  url:"{{route('endMony')}}",
                  method:"POST",
                  data:data,
                  success: function (data){
                      swal(`${data.msg}`, {icon: `${data.icon}`});

                      window.location.reload();
                  }
              });

      });

      $(".deleteRecord").click(function(){
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
                              url: "Monymove/"+id,
                              method:"DELETE",
                              data: {
                                  "_token": token,
                              },
                              success: function (data){
                                  swal(`${data.status}`, {icon: "success"});
                                  setTimeout(function () {
                                      window.location.reload();
                                  },800)

                              }
                          });
                  }
              });
      });

    </script>
@endsection
