<!DOCTYPE html>
<html>
<?php
$total_added = 0;
$total_out = 0;
?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ELMAHALLAWY</title>
        <link rel="stylesheet" href="{{asset('dashbord/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('dashbord/dist/css/rtl/bootstrap-rtl.min.css')}}"/>

        <style>
            @media print {
                .noprint {
                    visibility: hidden;
                }
            }
            button
            {
                width: 150px;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
            <div class="row">
                <div class="col-lg-12 col-md-6">
                   <h3> <button id="print" class="btn btn-primary noprint">print</button></h3>
                </div>
            </div>
            <!-- Main content -->
            <section class="content printthis">
                <div class="box">
                    <div class="box-header bg-info">
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <h5>
                                    <b class="padd">{{trans('trans.from')}}</b>
                                    {{$data['fromdate']}}
                                    <b class="padd">{{trans('trans.to')}}</b>
                                    {{$data['todate']}}
                                </h5>
                            </div>

                            <div class="col-md-7" style="padding: 12px">
                                <i class="fa fa-globe"></i> <strong>{{trans('trans.elmhlawy')}}</strong>
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <hr>
                    <div class="box-body">
                        <div class="col-md-4 bg-gray-light">
                            <div class="col-sm-4">
                                <h3>{{trans('trans.product')}}</h3>
                                <address>
                                    <h4>{{$products_data->name}}</h4>
                                    <h4>{{trans('trans.current_qty')}}:{{$products_data->qty}}</h4>
                                </address>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <td colspan="4">
                                    <h5 class="alert alert-info">{{trans('trans.all_qty_inorders')}}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td width="2%">#</td>
                                <td>{{trans('trans.date')}}</td>
                                <td>{{trans('trans.qty_inorders')}}</td>
                                {{--<td>{{trans('trans.product_allqty')}}</td>--}}
                                <td>{{trans('trans.notes')}}</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products_data->productorder as $index=>$product)

                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$product->date}}</td>
                                    <td>{{$product->amount}}</td>
                                    <td>{{$product->note}}</td>
                                </tr>
                                <?php
                                    $total_out += $product->amount;
                                ?>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">{{trans('trans.total_qty_out')}}</td>
                                    <td class="bg-warning" colspan="2"><?php echo $total_out ?></td>
                                </tr>
                            </tfoot>
                        </table>



                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <td colspan="4">
                                    <h5 class="alert alert-info">{{trans('trans.all_qty_product_Added')}}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td width="2%">#</td>
                                <td>{{trans('trans.date')}}</td>
                                <td>{{trans('trans.qty_added')}}</td>
                                {{--<td>{{trans('trans.product_allqty')}}</td>--}}
                                <td>{{trans('trans.notes')}}</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products_data->productAdded as $index=>$product_added)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$product_added->date}}</td>
                                    <td>{{$product_added->amount}}</td>
                                    <td>{{$product_added->note}}</td>
                                </tr>
                                <?php
                                $total_added += $product_added->amount;
                                ?>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="2">{{trans('trans.total_qty_product_Added')}}</td>
                                <td class="bg-warning" colspan="2"><?php echo $total_added ?></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="clearfix"></div>
            </section>
            <!-- /.content -->
        </div>
    </div>

    <!-- jQuery 3 -->
    <script src="{{asset('dashbord/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('dashbord/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('dashbord/dist/js/printThis.js')}}"></script>
    <script>
        $(document).ready(function(){
                window.print()

            $("#print").click(function () {
                $('.printthis').printThis({
                    importCSS: true,
                    debug: false,
                    // header: $('.hidden-print-header-content'),
                    // footer: $('.hidden-print-header-content')
                });
            });

        })
    </script>
    </body>
</html>
