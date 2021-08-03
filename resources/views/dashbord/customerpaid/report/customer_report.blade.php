@extends('dashbord.master')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <button class="print btn btn-primary"><i class="fa fa-print"></i> {{trans('trans.print')}}</button>
            <div class="box printthis">
                <div class="box-header">
                    <div class="row">
                        <div class="col-md-5">
                            <small>
                                <b class="padd">{{trans('trans.from')}}</b>
                                {{$data['fromdate']}}
                                <b class="padd">{{trans('trans.to')}}</b>
                                {{$data['todate']}}
                            </small>
                        </div>

                        <div class="col-md-7">
                            <i class="fa fa-globe"></i> <strong>{{trans('trans.elmhlawy')}}</strong>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <hr><br>
                <div class="box-body">
                    <div class="row invoice-info">
                        @if($data['customer']!=0)
                            <div class="col-sm-4 invoice-col">
                                <strong>{{trans('trans.customer_data')}}</strong>
                                <address>
                                    <strong class="padd">{{trans('trans.name')}}</strong> : {{$customer->name}}<br>
                                    <span style="margin-left: 10px"> <strong class="padd">{{trans('trans.tele')}}</strong> : {{$customer->mobile}}</span> <br>
                                </address>
                            </div>
                            <div class="col-sm-8">
                                <strong>{{trans('trans.deal_data')}}</strong>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <td>{{trans('trans.desc_deal')}}</td>
                                            <td>{{trans('trans.finaltotal')}}</td>
                                            <td>{{trans('trans.somemony')}}</td>
                                            <td>{{trans('trans.remain')}}</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($deals as $deal)
                                        <tr>
                                            <td>{{$deal->descdeal}}</td>
                                            <td>{{$deal->dealtotal}}</td>
                                            <td>{{$deal->somepaid}}</td>
                                            <td>{{$deal->dealtotal - $deal->somepaid - $deal->get_sumpaid_spacefic_deals()}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped table-responsive">
                                <thead>
                                <tr>
                                    <td>{{trans('trans.date')}}</td>
                                    <td>{{trans('trans.desc_deal')}}</td>
                                    <td>{{trans('trans.receiver')}}</td>
                                    <td>{{trans('trans.value')}}</td>
                                    <td colspan="2">{{trans('trans.notes')}}</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customer_paid as $paid)
                                    <tr>
                                        <td>{{$paid->date}}</td>
                                        <td>{{$paid->deal->descdeal}}</td>
                                        <td>{{$paid->receiver}}</td>
                                        <td>{{$paid->value}}</td>
                                        <td colspan="2">{{$paid->note}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                        @else
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped table-responsive">
                                    <thead>
                                    <tr>
                                        <td>{{trans('trans.name')}}</td>
                                        <td>{{trans('trans.total_paid')}}</td>
                                        <td>{{trans('trans.total_dept')}}</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customers_paid as $paid)
                                        <tr>
                                            <td>{{$paid->customer->name}}</td>
                                            <td>{{$paid->sum_paid}}</td>
                                            <td>{{$paid->customer->dept}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </section>
        <!-- /.content -->
    </div>
@endsection

