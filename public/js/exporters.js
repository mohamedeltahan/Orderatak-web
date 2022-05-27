import {ajaxFunction} from "./ajax.js"
import  {validate} from "./form-validation.js";

//this function to remove the exporters when the user click on remove button
$(function(){
    $(".exporter .remove").click(function(){
        var temp=$(this);

        var expo = $(this).parent().parent();
        $(".alert-popup-container").addClass("show");
        $(".cancel").click(function(){
            $(".alert-popup-container").removeClass("show");
        });
        $(".confirm").click(function(){
            $(".alert-popup-container").removeClass("show");
            temp.parent().find(".delete").click();
        });

    });
    $(".add-number").click(function(){

        $(".add-cont").append(
            '<div class="input-group mb-3"><input type="number" name="phone[]" class="form-control" placeholder="أدخل رقم التليفون" aria-describedby="basic-addon1"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">رقـــم التليفون</span></div></div>'
        )
    });
});
//============================================================================
//============================================================================
$(function(){
    //open add exporter popup when the user cliecked on "add exporter button"
    $("#add-exporter-btn").click(function(){
        $(".add-popup-container").addClass("open-popup");
    });
    //close add exporter popup when the user cliecked on " x button"
    $(".close-popup").click(function(){
        $(this).parent().removeClass("open-popup");
        $(".filled_dynamically").remove();
    });
    $(".close-pop").click(function(){
        $(".add-popup-container").removeClass("open-popup");
    });
});
//============================================================================
//============================================================================
function search ($container_id , $form_id , $elements_class , $tag_name ){
    const table = document.querySelector("#" + $container_id);
    const searchbox = document.forms[$form_id].querySelector("input");
    searchbox.addEventListener("keyup", function(e) {
        const term = e.target.value.toLowerCase();
        const tablerows = table.getElementsByClassName($elements_class);
        Array.from(tablerows).forEach(function(tablerow) {
            const clientname = tablerow.querySelector($tag_name).children[0].textContent;
            if (clientname.toLowerCase().indexOf(term) != -1) {
                tablerow.style.display = 'block';
            } else {
                tablerow.style.display = 'none';
            }
        })
    })
}
search("exporters-container","searchbox","exporter","ul");
//=====================================
//=====================================
function fill_table_with_this_array($table_id,$arr){
    var sum=0;
    $.each( $arr, function( index, value ){
        sum+=value;
        if(value<0){ $('#'+$table_id+' > tbody:last-child').append('<tr class="filled_dynamically"><td >'+"دائن"+'</td><td dir="ltr">'+(-1*value)+'</td><td class="filled_dynamically">'+index+'</td></tr>');
        }
        else {
            $('#'+$table_id+' > tbody:last-child').append('<tr class="filled_dynamically"><td >'+"مدين"+'</td><td dir="ltr">'+(value)+'</td><td class="filled_dynamically">'+index+'</td></tr>');
        }
    });
    if(sum<0){
        $('#'+$table_id+' > tbody:last-child').append('<tr style="font-weight: bold; font-size: 18px;" class="filled_dynamically"> <td >'+"دائن"+'</td><td dir="ltr">'+(-1*sum)+'</td><td class="filled_dynamically">'+"اجمالي"+'</td></tr>');

    }
    else {
        $('#'+$table_id+' > tbody:last-child').append('<tr style="font-weight: bold; font-size: 18px;" class="filled_dynamically"> <td >'+"مدين"+'</td><td dir="ltr">'+sum+'</td><td class="filled_dynamically">'+"اجمالي"+'</td></tr>');
    }


}
$(function(){
    $(".exporter .status").click(function(){
        //get link of the route to get unpaid transactions
        var $link=$("#unpaid_transactions").val()+"/"+$(this).attr("data-id");
        var $result= ajaxFunction(null,$link,"get");
        var $table_id="transactions_table";
        //fill the transactions table in html with array response
        fill_table_with_this_array($table_id,$result);
        $(".status-popup-container").addClass("open-popup");
        $(window).scrollTop(0);
    });
});

$(function(){
    $(".pen").click(function(){
        var list_value = $(this).parent().find("span").text();
        var inp = $(this).parent().find("input");
        inp.css({"display":"block"});
        $(this).css({"display":"none"});
        $(this).parent().find(".checked").css({"display":"block"});
        inp.val(list_value);
    });

});

//***====================================***** */
//pay for madyonat
$(function(){
    $(".pay").click(function(){
        $(this).find("input").css({"display":"inline"});
        $(this).find(".checked").css({"display":"block"});
    });


});
$(".checked").click(function() {

    var $id = $(this).parent().parent().attr("id");
    var $edit = $(this).parent().find("input").val();
    if ($edit != "") {

        var obj={};
        obj[$(this).attr("data-attr")]=$edit;
        obj["_method"]="PUT";
        var bool=0;
        var $url=$("#exporters_update").val()+"/"+$id;
           bool= ajaxFunction(obj,$url,"post");


        if(bool!=false) {

            $(this).parent().find("input").css({"display": "none"});
            $(this).css({"display": "none"});
            $(this).parent().find(".pen").css({"display":"block"});
            $(this).parent().find("span").text($(this).parent().find("input").val());
        }
    }
});
$("#button").click(function () {
    if( validate(["name","address","phone"],[["null_input"],["null_input"],["wrong_length_input","null_input"]])){
        $("#submit").click();

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


