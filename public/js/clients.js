$(function(){
    $(".client-details-container .client-details i").click(function(){
        $(this).parent().find("input").fadeIn(50).focus();
    });
});