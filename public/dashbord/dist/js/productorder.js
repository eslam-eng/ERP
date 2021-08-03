
////////////////////////////////////////////
// bill functions
////////////////////////////////////////////
// add row to table
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
        if (productQty<qty)
        {
            // increase amount by one
            var amount = 0;

            p.find(".amount").each(function () {
                this.value = parseInt(this.value) + 1;
                amount = this.value;
            });
        }else {
            swal("خطأ !", "حطأ الكميه المطلوبه اكبر من الكميه المتاحه", "error");
        }

    }
    else {
        $("#products tbody").append(getRowView(product));
    }
}

function checkQty(element) {
    var id = element.getAttribute("data-id");
    var qty = element.getAttribute("data-qty");
    var productQty=0;
    if ($(".product-row[data-id='" + id + "']").length > 0) {
        var p = $(".product-row[data-id='" + id + "']");
        p.find(".amount").each(function () {
            (this.value!='')?productQty = parseInt(this.value):swal("خطأ !", "حطأ الكميه المطلوبه اكبر من الكميه المتاحه", "error");;this.value=qty;
        });
        if (productQty>qty)
        {
            swal("خطأ !", "حطأ الكميه المطلوبه اكبر من الكميه المتاحه", "error");
            p.find('.amount').each(function () {
                this.value=qty;
            })
        }

    }
}

function getRowView(product) {
    var rowNode = document.createElement("tr");
    var row = "";
    var amount = (product.amount != undefined)? product.amount : 1;
    row +=
        '<input type="hidden" name="product_id[]" class="form-control item" value="' + product.id + '" readonly >' +
        '<td><p>'+product.item+'</p></td> ' +
        '<td><input type="number"  onkeyup="checkQty(this)" data-id="'+product.id+'" data-qty="'+product.qty+'" name="amount[]" min="1" class="form-control amount" value='+ amount +'></td>' +
        '<td><input type="text" name="note[]" class="form-control" placeholder="سبب خروج المنتج من المخزن"></td>' +
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
        url:"product",
        data:data,
        success:function (response){

            if (response.status==true){
                $('.remove').hide();
                $('.box-footer').hide();
                swal({
                    title: "Order Saved Successfully",
                    text: "Do You Want to Print It ?",
                    icon: "success",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $("#print").printThis(
                                {
                                    debug: false,               // show the iframe for debugging
                                    importCSS: true,            // import parent page css
                                    importStyle: false,         // import style tags
                                    printContainer: true,
                                }
                            );
                            window.location.reload();
                        } else {
                            location.reload();
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
