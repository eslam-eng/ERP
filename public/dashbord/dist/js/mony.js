$(".endmony").click(function() {
    var token = $("meta[name='csrf-token']").attr("content");
    swal({
        title: "الرجاء كتابه الباسورد الخاص بك لترحيل العهده",
        content: {
            element: "input",
            attributes: {
                placeholder: "Type your password",
                type: "password",

            },
        },
    })
        .then((value) => {
            if (value) {
                $.ajax(
                    {
                        url: "http://localhost/projects/NazeehSystem/public/dashboard/Mony/end",
                        method:"POST",
                        data: {
                            "_token":token,
                            "password":value,
                        },
                        success: function (data){
                            // console.log(data);
                            swal(`${data.msg}`, {icon: `${data.icon}`});
                            setTimeout(function () {
                                window.location.reload();
                            },1000)

                        }
                    });
            } else {
                swal("Your imaginary file is safe!");
            }
        });
});
