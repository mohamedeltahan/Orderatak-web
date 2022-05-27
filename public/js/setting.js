// Material Select Initialization

$(document).ready( function () {
    $('#myTable').DataTable();

    var table = $('#example2').DataTable();
    var table = $('#example3').DataTable();

});

$(function(){
    $(".toggle-menu").click(function(){
        $(".body-content-container").toggleClass("body-toggle");
        $(".menu-side-container").toggleClass("menu-side-toggle");
    });

    $(".add-data").click(function(){
        $(".data-form-container").toggleClass("slide-data");
    });
    $(".add-user").click(function(){
        if( $(".user-form-container").hasClass("slide-data")){
            $(".user-form-container").css("overflow","hidden");
        }
        else{
            $(".user-form-container").css("overflow","visible");

        }
        $(".user-form-container").toggleClass("slide-data");



    });
    $(".add-terms").click(function(){

        if( $(".terms-form-container").hasClass("slide-data")){
            $(".terms-form-container").css("overflow","hidden");
        }
        else{
            $(".terms-form-container").css("overflow","visible");

        }
        $(".terms-form-container").toggleClass("slide-data");
    });
    $(".city-data").click(function(){
        $(".cities-form-container").toggleClass("slide-terms");
    });
});
$(function () {
    $('.myselect').selectpicker();
});
var perm=[];
$("#select1").on('change',function() {
    $("#perm option:selected").removeAttr("selected");




    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if ($.ajax({
        async: false,
        url: $("#get_perm").val() + "/" + $(this).find('option:selected').val(),
        dataType: "json",
        method: "get",
        //request data
        success: function (result) {

            perm = result;

        },
        error: function (data) {
            alert('Error on updating, please try again later!');
            return false;
        }
    })) ;
    $("#perm option").each(function () {
        for (var k = 0; k < perm.length; k++) {


            if ($(this).val() == perm[k].id) {

                $(this).attr("selected","selected");
            }
        }


    });
    $('.myselect').selectpicker('refresh');
});
$(function(){
    $(".delete").click(function(){
        var temp=$(this);

        var expo = $(this).parent().parent();
        $(".alert-popup-container").addClass("show");
        $(".cancel").click(function(){
            $(".alert-popup-container").removeClass("show");
        });
        $(".confirm").click(function(){
            $(".alert-popup-container").removeClass("show");
            temp.parent().find(".delete_button").click();
        });

    })});
$(function(){

    $(".toggle-menu").click(function(){
        $(".body-content-container").toggleClass("body-toggle");
        $(".menu-side-container").toggleClass("menu-side-toggle");
    });

});
$("li").click(function () {
    $(".transactions-container").css("display","none");
    $("."+$(this).attr("id")).css("display","");
});
$(".edit").click(function(){
    var parent=$(this).parent().parent();

    $("#district_id").val(parent.find(".district_id").text());
    $("#delivery").val(parent.find(".delivery").text());

    $("#form").attr("action",parent.attr("data-attr"));
    $(".details-popup-container").fadeIn();
});
$(".done").click(function () {

    var object={};

    object["cost"]=$("#delivery").val();
    object["name"]=$("#district_id").val();
    object["_method"]="PUT";



    var url=$("#form").attr("action");
    var result=null;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if ($.ajax({
        url: url,
        type: "post",
        async: false,
        //request data
        data: object,
        success: function (r) {
            result = r;
            console.log(result)
            var temp=$("#"+result.id);
            temp.find(".delivery").text(result.cost);
            temp.find(".district_id").text(result.name);

            alert("تم التعديل");
            $(".close-popup").click();

        },
        error: function (data) {
            //alert('عفوا هذه الفاتورة غير متوفرة هنا');
            return false;
        }
    })){

    }

});
