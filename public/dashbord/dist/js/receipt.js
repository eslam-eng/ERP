$(document).ready(function () {
    $("#name option[class=suppliers]").hide();
     $("#receiver").hide();
     $("#type").change(function () {
        $("#name option[class=choose]").prop('selected',true);
        if ($("#type").val()==1){
            $("#receiver").hide();
            $("#name option[class=suppliers]").hide();
            $("#name option[class=employees]").show();

        }else {
            $("#receiver").show();
            $("#name option[class=suppliers]").show();
            $("#name option[class=employees]").hide();

        }
    });
});