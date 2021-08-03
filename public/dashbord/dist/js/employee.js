$(document).ready(function () {

    $('#num_days,#num_hours,#salary').on('keyup',function (){
        CalculateSalaryPerDayAndHour();
    });

    function  CalculateSalaryPerDayAndHour() {
        var salary = $("#salary").val()==''?0:$("#salary").val(),
            num_days = $("#num_days").val()==''?0:$("#num_days").val(),
            num_hour = $("#num_hours").val()==''?0:$("#num_hours").val();

        var valOfDay = Math.round(salary / num_days),
            valOfHour = Math.round(valOfDay / num_hour);
        $('#S_perDay').val(valOfDay);
        $('#S_perHour').val(valOfHour);


    }

});
