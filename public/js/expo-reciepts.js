/*calculate total price of the day*/
import  {validate} from "./form-validation.js";

$(function() {
    $(".month").each(function() {
        var $totalorderprice = 0;
        $(this).find(".orderprice").each(function() {
            $totalorderprice = parseInt($totalorderprice, 10) + parseInt($(this).text(), 10);
        });
        $(this).find(".monthfooter span .num").text($totalorderprice);
    });
});
/*calculate total price of the month*/
$(function() {
    $(".order").each(function() {
        var $totalofmonth = 0;
        $(this).find(".monthfooter span .num").each(function() {
            $totalofmonth = parseInt($totalofmonth, 10) + parseInt($(this).text(), 10);
        });
        $(this).find(".totalmonth span").text("اجمالي الشهر : " + $totalofmonth + $("#currency").val());
    });
});
/*======================== */
$(function() {
    $(".dateheader").click(function() {
        $(".orderdetails").removeClass("hidden_order");

        if(  $(this).parent().hasClass("orderchange")){
            $(".order").removeClass("orderchange");
            return;
        }
        $(".order").removeClass("orderchange");

        $(this).parent().toggleClass("orderchange");
        $(".month").removeClass("changemonth");
        $(".month").removeClass("widthbro");
        $(".month").find(".orderstable").addClass("toggeltable");

    });
    $(".ordersdate").click(function() {
        $(".orderdetails").removeClass("hidden_order");

        $(".month").toggleClass("widthbro");
        $(this).parent().removeClass("widthbro");
        $(this).parent().toggleClass("changemonth");
        $(this).parent().find(".orderstable").toggleClass("toggeltable");
    });
});
$(function() {
    //casher popup close function
    $(".closepopup").click(function() {
        $(this).parent().fadeOut();
        $('.category').removeClass('categoryclick');
        $("#exportpage").addClass('categoryclick');
    });
    // ===========================================================
    //casher popup open function
    $("#casher").click(function() {
        $(".casherpopupcontainer").fadeIn();
        $(this).addClass('categoryclick');
    });
    //open exports popup
    $("#addexports").click(function() {
        $(".add-exports-pop-up-container").fadeIn();
    });
});

$(function(){
    //open add exporter popup when the user cliecked on "add exporter button"
 /*   $(".payed-details").click(function(){
        var $val=$(this).find(".unpaid").text();
        $(".unpaid_val").text($val)
        $("#export_id").val($(this).attr("data-id"));
        $(".add-popup-container").addClass("open-popup");
    });
    //close add exporter popup when the user cliecked on " x button"
    $(".close-popup").click(function(){
        $(this).parent().removeClass("open-popup");
        $(".filled_dynamically").remove();
    });
    $(".close-pop").click(function(){
        $(".add-popup-container").removeClass("open-popup");
    });*/
});
/*=========================================================== */
/*items popup */
$(".itemsinorder").click(function() {
    $(this).parent().find(".TotalItemsInOrderPopupContainer").fadeIn();
});
/*delete export from exports table */
$(".delete").click(function(){
    var temp=$(this);
    $("#alert_modal_button").click();

    $(".confirm_delete").click(function(){

        temp.parent().find(".delete_button").click();
    });

});
$(".delete_item").click(function(){
    var temp=$(this);
    $("#alert_modal_button").click();
    $(".TotalItemsInOrderPopupContainer").css("z-index",1);

    $(".confirm_delete").click(function(){

        temp.find(".delete_button").click();
    });

});
/*transaction popup */
$(".payed-details").click(function() {
    $("#paytransaction").fadeIn();
});
$("#button").click(function () {
    if( validate(["all"],[["null_input"]])){
        $("#submit").click();

    }

});
$(".search_button").click(function () {

    if($("#example_filter #search_option").find("option:selected").val()==="none"){
        alert("اختر وسيلة البحث");
        return;
    }
    var value=$("#example_filter #search").val();
    if(value.length===0){return;}
    var found=false;
    var object={};
    object["id"]=value;
    if($("#example_filter #search_option").find("option:selected").val()==="order_id"){
        object["type"]="order_id";
    }
    else{
        object["type"]="policy_id";

    }

    var url=$("#search_url").val();
    var result=null;

    if($(this).attr("id")==="search_button_with_policy"){
        $(".policy_id").each(function () {
            if($(this).text()===value){
                $(".order").addClass("hidden_order");
                $(this).parent().parent().parent().parent().parent().parent().parent().find(".dateheader").click();
                $(this).parent().parent().parent().parent().parent().find(".ordersdate").click();
                $(this).parent().parent().parent().parent().parent().find(".ordersdate").parent().parent().parent().removeClass("hidden_order");

                $(".orderdetails").addClass("hidden_order");
                $(this).parent().removeClass("hidden_order");
                return false;
            }});}
    else{
        $(".number").each(function () {
            if($(this).text()===value){
                $(".order").addClass("hidden_order");
                $(this).parent().parent().parent().parent().parent().parent().parent().find(".dateheader").click();
                $(this).parent().parent().parent().parent().parent().find(".ordersdate").click();
                $(this).parent().parent().parent().parent().parent().find(".ordersdate").parent().parent().parent().removeClass("hidden_order");

                $(".orderdetails").addClass("hidden_order");
                $(this).parent().removeClass("hidden_order");
                return false;

            }});


    }

    
});
function e2a_numbers(input,$id) {
    for(var i=0;i<input.length;i++){
        switch (input[i]) {
            case "٠":
                input = input.replace("٠",0);

                break;
            case "١":
                input = input.replace("١",1);

                break;
            case "٢":
                input = input.replace("٢",2);

                break;
            case "٣":
                input = input.replace("٣",3);

                break;
            case "٤":
                input = input.replace("٤",4);

                break;
            case "٥":
                input = input.replace("٥",5);
                break;
            case "٦":
                input = input.replace("٦",6);

                break;
            case "٧":
                input = input.replace("٧",7);

                break;
            case "٨":
                input = input.replace("٨",8);
                break;
            case "٩":

                input = input.replace("٩",9);
                break



        }
    }
    $("#"+$id).val(input);
}

$(".paste").keyup(function(){

    e2a_numbers($(this).val(),$(this).attr("id"));
});
/*
$(document).mouseup(function (e) {
   var temp= $(".exportscontainer");
    if (temp.is(e.target)){
        $(".order").removeClass("orderchange");
    }
});
*/
