$(document).ready(function () {

    // $("#paymentvalue").hide();
    if ($("#paytype").val()==1)
        $("#paymentvalue").show();

    if ($("#paytype").val()==2)
        $("#checkbank").show();

    $("#paytype").change(function () {
        if ($("#paytype").val()==0||$("#paytype").val()==-1)
        {
            $("#paymentvalue").hide();
            $("#checkbank").hide();
        }
        else if ($("#paytype").val()==1)
        {
            $("#paymentvalue").show();
            $("#checkbank").hide();
        }else
        {
            $("#checkbank").show();
            $("#paymentvalue").show();
        }


    });
    $("#addrow").click(function (e) {
        e.preventDefault();
        addRow();
    });

    function addRow() {
        var  tr =' <tr>\n' +
            '                            <td><input type="text" class="form-control name" name="product[]"></td>\n' +
            '                            <td><input type="text"  value="1" class="form-control qty" name="qty[]" autocomplete="off"></td>\n' +
            '                            <td><input type="number" class="form-control price" name="unitprice[]" autocomplete="off"></td>\n' +
            '                            <td><input type="number" class="form-control subtotal" name="subtotal[]" readonly></td>\n' +
            '                            <td><input type="text" class="form-control notes" name="note[]"></td>\n' +
            '                            <td><button class="btn-sm btn-danger no-border hideRow"><i class="fa fa-close"></i></button></td>\n' +
            '                        </tr>';
        $('#bill tbody').append(tr);
    }

    $(document).on('click','.hideRow',function () {
        $(this).parent().parent().remove();
        total();
    });

    $(document).delegate('.qty,.price','keyup',function () {
        var tr = $(this).parent().parent(),
            qty = tr.find('.qty').val(),
            price = tr.find('.price').val(),
            subtotal = (qty*price);

        tr.find('.subtotal').val(subtotal);
        total();
    });

    function total() {
        var total =0;
        $('.subtotal').each(function (i,e) {
            var subtotal = $(this).val()-0;

            total+=subtotal;

        });
        $("#tfooter #billsubtotal").val(total);
        $("#finaltotal").val(total);
    }


    $("#tax,#discount,#payvalue").on('keyup',function () {
        var payvalue = $("#payvalue").val()==''?0:$("#payvalue").val();
        if ($("#billsubtotal").val()!=''){
            var billsubtotal = $("#billsubtotal").val(),
                tax = $("#tax").val()==''?0:$("#tax").val(),
                discount = $("#discount").val()==''?0:$("#discount").val();
            var finaltotal = (parseInt(billsubtotal)/100*parseInt(tax)+parseInt(billsubtotal))-(parseInt(discount)+parseInt(payvalue));

            $("#finaltotal").val(parseInt(finaltotal));
        }
    });
//---------------TO FUNCTION FOR PAYMENT TYPE (SHOW AND HIDE)-------------------
    $("#customer_deals option[value!='0']").hide();
    $('#customer').change(function() {
            $('.remove').hide();
            $('.d' + $(this).val()).show();
        });


});
