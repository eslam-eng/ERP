@extends('dashbord.master')
@section('content')
    <style>
        .scroll{
            overflow-y: auto;
            height: 600px;
        }
        .productItem:hover{
            cursor: pointer;
        }
    </style>
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        {{--</div>--}}
                        <div class="box-body">
                            <!-- Main row -->
                            <div class="row">
                                <!-- Left col -->
                                <section class="col-lg-8 connectedSortable printthis">
                                    <!-- Chat box -->
                                    <div class="box box-success">
                                        <div class="row box-header">
                                            <div class="col-md-7">
                                                <strong>{{trans('trans.elmhlawy')}}</strong>
                                            </div>
                                            <div class="col-md-5">
                                                <small class="pull-right" style="display: inline-block">{{trans('trans.date')}}: {{Carbon\Carbon::now('Africa/Cairo')->format('y-m-d h:i A')}}</small>
                                            </div>
                                        </div>
                                        <hr>
                                        @foreach($errors->all() as $error)
                                            <li class="text-danger">{{$error}}</li>
                                        @endforeach
                                        <div class="box-body">
                                            {{--start Form -----------------------------------------------------------------}}
                                            <form  method="post" role="form" id="formdata">
                                                @csrf
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered" id="products">
                                                        <thead>
                                                        <tr>
                                                            <td>{{trans("trans.product")}}</td>
                                                            <td>{{trans("trans.qty")}}</td>
                                                            <td>{{trans("trans.notes")}}</td>
                                                            <td class="remove"></td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>{{trans('trans.trustee')}}</th>
                                                            <th>{{trans('trans.Storekeeper')}}</th>
                                                            <th>{{trans('trans.receiver')}}</th>
                                                        </tr>
                                                        </tfoot>

                                                    </table>
                                                </div>
                                                <div class="box-footer">
                                                    <div class="col-xs-12">
                                                        <button type="submit" class="btn btn-primary" id="submit" style="margin-left: 10px">{{trans("trans.submit")}}</button>
                                                    </div>
                                                </div>
                                                <!-- /.row -->
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.box (chat box) -->
                                </section>
                                <!-- /.Left col -->
                                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                                <section class="col-lg-4 connectedSortable scroll">
                                    <!-- Map box -->
                                    <div class="box box-solid">
                                        <div class="box-header bg-gray-light">
                                            <i class="fa fa-cubes"></i>

                                            <h3 class="box-title">
                                                <input type="text" class="form-control" placeholder="{{trans('trans.search')}}" id="search">
                                            </h3>
                                        </div>
                                        <div class="box-body">
                                            @foreach($products as $product)
                                                <div class="productItem">
                                                    <!-- small box -->
                                                    <div class="small-box" style="background-color:{{$product->randomColor()}}" id="content_product">
                                                        <div class="inner">
                                                            <li class="productitem" onclick="addRow(this)" data-id="{{$product->id}}" data-name="{{$product->name}}"data-qty="{{$product->qty}}" data-store="{{$product->store}}" style="list-style: none">
                                                                <h3>{{$product->name}}</h3>
                                                                <p>{{trans('trans.store').": ".$product->getStoreInfo()->name}} | {{trans('trans.qty')}}: {{$product->qty}}</p>
                                                                <div class="icon">
                                                                    <i class="ion ion-bag"></i>
                                                                </div>
                                                            </li>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- /.box-body-->
                                    </div>
                                    <!-- /Map box -->
                                </section>
                                <!-- right col -->
                            </div>
                            <!-- /.row (main row) -->
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
        function addRow(element) {
            var item = element.getAttribute("data-name");
            var id = element.getAttribute("data-id");
            var store = element.getAttribute("data-store");
            var qty = element.getAttribute("data-qty");
            var product = {};
            product.id = id;
            product.item = item;
            product.store = store;
            product.qty = qty;
            var productQty=0;
            if ($(".product-row[data-id='" + id + "']").length > 0) {

                var p = $(".product-row[data-id='" + id + "']");
                p.find(".amount").each(function () {
                    productQty = parseInt(this.value)
                });

                    // increase amount by one
                var amount = 0;

                p.find(".amount").each(function () {
                    this.value = parseInt(this.value) + 1;
                    amount = this.value;
                });

            }
            else {
                $("#products tbody").append(getRowView(product));
            }
        }


        function getRowView(product) {
            var rowNode = document.createElement("tr");
            var row = "";
            var amount = (product.amount != undefined)? product.amount : 1;
            row +=
                '<input type="hidden" name="product_id[]" class="form-control item" value="' + product.id + '" readonly >' +
                '<td><p>'+product.item+'</p></td> ' +
                '<td><input type="number"  data-id="'+product.id+'" data-qty="'+product.qty+'" name="amount[]" min="1" class="form-control amount" value='+ amount +'></td>' +
                '<td><input type="text" name="note[]" class="form-control"></td>' +
                '<td class="remove"><button class="btn btn-danger btn-sm removeRow">X</button></td>';
            rowNode.innerHTML = row;
            rowNode.className = "product-row";
            rowNode.setAttribute("data-id", product.id);
            return rowNode;
        }
        $("#products tbody").on('click','.removeRow',function () {
            $(this).parent().parent().remove();
        });
        $("#submit").click(function (e) {
            e.preventDefault();
            var data = $("#formdata").serialize();
            $.ajax({
                method:'post',
                url:"{{route('productaddrequest.store')}}",
                data:data,
                success:function (response){

                    if (response.status==true){
                        $('.remove').hide();
                        $('.box-footer').hide();
                        swal({
                            title:"{{trans('trans.done')}}",
                            text: "{{trans('trans.print_question')}} ?",
                            icon: "success",
                            buttons: true,
                            dangerMode: true,
                        })
                            .then((willDelete) => {
                                if (willDelete) {
                                    $(".printthis").printThis(
                                        {
                                            debug: false,               // show the iframe for debugging
                                            importCSS: true,            // import parent page css
                                            importStyle: false,         // import style tags
                                            printContainer: true,
                                        }
                                    );
                                } else {
                                    window.location.replace('{{route('productaddrequest.index')}}')
                                }
                            });
                    }
                },error:function (data_error,exception) {
                    if (exception=='error'){
                        var error_list='';
                        $.each(data_error.responseJSON.errors,function (key,value) {
                            error_list+='<li>'+value+'</li>';
                        });
                        $(".alert-error ").html("<ul>"+error_list+"</ul>");
                    }
                }
            })
        });

        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#content_product .inner").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

    </script>
@endsection
