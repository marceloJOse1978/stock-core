$("#payment").change(function (e) { 
    e.preventDefault();
    if ($('#payment').is(':checked')) {
        $("#payment_input").css("display","none");
    }else{
        $("#payment_input").css("display","block");
    }
});
if ($('#payment').is(':checked')) {
    $("#payment_input").css("display","none");
}else{
    $("#payment_input").css("display","block");
}