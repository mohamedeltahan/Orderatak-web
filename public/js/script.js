 //login form script

 var $bool=true;
 function null_input(input) {
     $("."+input).each(function () {
         if($(this).is("select")){
             if($(this).find("option:selected").val()==0){
                 $(this).css("background-color","#fce4e4");
                 $bool=false;

             }
         }

         if($(this).val().length===0){
             $bool=false;
             var alert_message=$(this).attr("data-alertmessage");
             $(this).css("background-color","#fce4e4");
           //  $(this).attr("placeholder",alert_message);
             $(this).val("");


         }
     })

 }
 function wrong_length_input(input) {

     $("."+input).each(function () {
         var $length=$(this).attr("data-length");
         if($(this).val().length<$length){

             $bool=false;
             var alert_message=$(this).attr("data-alertmessage");

             $(this).css("background-color","#fce4e4");
           //  $(this).attr("placeholder",alert_message);
             $(this).val("");


         }
     })
 }
 function arabic_input() {

 }

 function validate(input_array,input_condition_array) {

     $bool=true;
     for(var i=0;i<input_array.length;i++){
         for(var j=0;j<input_condition_array[i].length;j++){

             if (input_condition_array[i][j]==="null_input"){null_input(input_array[i])}
             if (input_condition_array[i][j]==="wrong_length_input"){wrong_length_input(input_array[i])}
             if (input_condition_array[i][j]==="arabic_input"){arabic_input(input_array[i])}


         }



     }
     return $bool;


 }

 // validate(["phone","name"],[["null_input","wrong_length_input"],["null_input"]])



 $(function() {

    $('.loginbutton').click(function() {
        $('.choice').addClass('hidden');
        $('.form1').removeClass('hidden');
        $('.form1').addClass('bounceIn');
    });
    $('.signinbutton').click(function() {
        $('.choice').addClass('hidden');
        $('.form2').removeClass('hidden');
        $('.form2').addClass('bounceIn');
    });
    $('.signoutlink').click(function() {
        $('.form1').addClass('hidden');
        $('.form2').removeClass('hidden');
        $('.form2').addClass('bounceIn');
    });
    $('.signinlink').click(function() {
        $('.form2').addClass('hidden');
        $('.form1').removeClass('hidden');
        $('.form1').addClass('bounceIn');
    });
});
    //**************************************************** */
$(function() {
    $('.category').click(function() {
        $('.category').removeClass('categoryclick');
        $(this).addClass('categoryclick');
    });
});
$(function() {
    $('.foodcategories ul li').first().addClass('foodcategorieslistclick');
    $('.foodcategories ul li').click(function() {
        $('.foodcategories ul li').removeClass('foodcategorieslistclick');
        $(this).addClass('foodcategorieslistclick');
    });
});
/*====================================== */
/*nice scroll */
/*$("body").niceScroll({
    cursorborder: "none"
});
$(".orderscontainer").niceScroll({
    cursorborder: "none",
    cursorwidth: "2px"
});
$(".productcategories").niceScroll({
    cursorborder: "none"
});
/*========================================= */
function increas(inc_id) {
    var price=$("#" + inc_id).parent().parent().find(".price").find(".mainprice").text();
    var temp = parseInt($("#" + inc_id).parent().find('input').val(), 10);
    temp += 1;
    var $ordername = $("#" + inc_id).parent().parent().find(".name").text();
    var $product =inc_id.split("-")[1];
    var $item_in_main=$("#"+$product);
    if ( $item_in_main.find(".amount").text()!=0 ) {


        $("#" + inc_id).parent().find('input').attr("value",temp);

        $item_in_main.find(".amount").text(parseInt($($item_in_main).find(".amount").text(), 10) - parseInt(1, 10));
        $("#hiddenform").find("#order-" + $product).find(".quantity").attr("value", temp);

    }
    else {

        var $name = $item_in_main.find(".productinfo .productname").text();
        alert("عفوا لا يوجد كمية متوفرة " + $name);
    }

    
 

    /*============================================*/
    /*increas total of price reciept */
    $(function() {
        var $totalordersprice = '0';
        $("#ordercontainer .order").each(function() {
            var $orderprice = parseFloat($(this).find(".price span .mainprice").text()) * parseFloat($(this).find(".countity input").val());
            $totalordersprice = Number((parseFloat($totalordersprice) + parseFloat($orderprice)).toFixed(2));
        });
        var $value=$("#discount").val();
        if(!$value){$value=0;}
        var cost = $("#district").find('option:selected').attr("data-name");
        cost=0;

        $totalordersprice-=$value;
        $totalordersprice = Number((parseFloat($totalordersprice) + parseFloat(cost)).toFixed(2));

        $("#total_price_after_discount").text( $totalordersprice );
        $(".receipt").find(".receipttotalprice .span1 .recieptsprice").text($totalordersprice);

        /*set price */
        $(".ordersprice").text($totalordersprice);
    });
    /*calculate the number of orders*/
    $(function() {
        var $number = 0;
        $("#ordercontainer .order").each(function() {

            $number += parseInt($(this).find(".input_quantity").val());
        });


        $(".numberOfOrders").text($number);
    });
    /*==================================================================== */
};

function decreas(dec_id) {
    var price=$("#" + dec_id).parent().parent().find(".price").find(".mainprice").text();
    var temp = parseFloat($("#" + dec_id).parent().find('input').val());
    temp -= 1;
    var $product =dec_id.split("-")[1];
    var $item_in_main=$("#"+$product);
    if (temp > 0) {
        $("#" + dec_id).parent().find('input').attr("value",temp);
        var $ordername = $("#" + dec_id).parent().parent().find(".name").text();
        var $orderamount = $("#" + dec_id).parent().find("input").val();
        $("#" + dec_id).parent().find('input').attr("value",temp);
        $item_in_main.find(".amount").text(parseInt($($item_in_main).find(".amount").text(), 10) + parseInt(1, 10));
        /*============================================*/
        $("#hiddenform").find("#order-" + $product).find(".quantity").attr("value", temp);
        /*decreas total of price reciept */
        $(function() {
            var $totalordersprice = '0';
            $("#ordercontainer .order").each(function() {
                var $orderprice = parseFloat($(this).find(".price span .mainprice").text()) * parseFloat($(this).find(".countity input").val());
                $totalordersprice = Number((parseFloat($totalordersprice) + parseFloat($orderprice)).toFixed(2));
            });
            var $value=$("#discount").val();
            if(!$value){$value=0;}
            var cost = $("#district").find('option:selected').attr("data-name");
            cost=0;
            $totalordersprice-=$value;
            $totalordersprice = Number((parseFloat($totalordersprice) + parseFloat(cost)).toFixed(2));

            $(".receipt").find(".receipttotalprice .span1 .recieptsprice").text($totalordersprice);
            /*set price */
          //  $(".ordersprice").text($totalordersprice);
        });
        /*==================================================================== */
    }
    /*calculate the number of orders*/
    $(function() {
        var $number = 0;
        $("#ordercontainer .order").each(function() {
            $number += parseInt($(this).find(".input_quantity").val());
        });

        $(".numberOfOrders").text($number);
    });
}

$(document).on("change",".input_quantity",function(){
    var price=$(this).parent().parent().find(".price").find(".mainprice").text();
    var temp = parseInt($(this).val());
    var $product =$(this).parent().parent().attr("id");
    var $item_in_main=$("#"+$product);
    if (temp > 0) {

        if ( parseInt($item_in_main.find(".amount").text())>=temp ) {


            $(this).attr("value",temp);
    
            $item_in_main.find(".amount").text(parseInt($($item_in_main).find(".amount").text(), 10) - parseInt(1, 10));
    
        }
        else {
    
            var $name = $item_in_main.find(".productinfo .productname").text();
            alert("عفوا لا يوجد كمية كافية من هذا المنتج" + $name);
            return;
        }
        $(this).attr("value",temp);
        var $ordername = $(this).parent().parent().find(".name").text();
        var $orderamount = $(this).parent().find("input").val();
        $(this).parent().find('input').attr("value",temp);
        $item_in_main.find(".amount").text(parseInt($($item_in_main).find(".amount").text(), 10) + parseInt(1, 10));
        /*============================================*/
        $("#hiddenform").find("#order-" + $product).find(".quantity").attr("value", temp);
        /*decreas total of price reciept */
        $(function() {
            var $totalordersprice = '0';
            $("#ordercontainer .order").each(function() {
                var $orderprice = parseFloat($(this).find(".price span .mainprice").text()) * parseFloat($(this).find(".countity input").val());
                $totalordersprice = Number((parseFloat($totalordersprice) + parseFloat($orderprice)).toFixed(2));
            });
            var $value=$("#discount").val();
            if(!$value){$value=0;}
            var cost = $("#district").find('option:selected').attr("data-name");
            cost=0;
            $totalordersprice-=$value;
            $totalordersprice = Number((parseFloat($totalordersprice) + parseFloat(cost)).toFixed(2));

            $(".receipt").find(".receipttotalprice .span1 .recieptsprice").text($totalordersprice);
            /*set price */
          //  $(".ordersprice").text($totalordersprice);
        });
        /*==================================================================== */
    }

    
    /*calculate the number of orders*/
    $(function() {
        var $number = 0;
        $("#ordercontainer .order").each(function() {
            $number += parseInt($(this).find(".input_quantity").val());
        });

        $(".numberOfOrders").text($number);
    });
})
/*======================open & close popup ======================== */
$(function() {
    //additem popup close function
    $(".closepopup").click(function() {
        $(this).parent().fadeOut();
        $('.category').removeClass('categoryclick');
        $('#home').addClass('categoryclick');
    });
    //additem popup open function
    $("#additem").click(function() {
        $(".additempopupcontainer").fadeIn();
    });
    // ===========================================================
    //casher popup open function
    $("#casher").click(function() {
        $(".casherpopupcontainer").fadeIn();
    });
});
/*============================================================================ */

/*add order when i click on product */
var $number = 1;
var $i = 0;
var $increas = "inc-";
var $decreas = "dec-";
$(function() {
    var $id_num = 1;
    $(".iteem").click(function() {
        var $order = $("#temp-order").clone();
        var $name = $(this).find(".name").text();
        var $id = $(this).find(" .productname").attr("data-id");

        var $price = $(this).find(" .productprice .proprice .real_price").text();
        var $size = $(this).find(" .size").text();

        var $productid = $(this).attr("id");
        var $inputdiv = $("#hiddeninputs").clone();
        var $priceinput = $inputdiv.find(".orderprice");
        var $quantityinput = $inputdiv.find(".quantity");
        var $nameinput = $inputdiv.find(".name");
        $inputdiv.attr("id", "order-" + $productid);
        $nameinput.attr("value", $id);
        $quantityinput.attr("value", 1);
        $priceinput.attr("value", $price);
        //to take the amount of the product
        var $countity = parseInt($(this).find(" .amount").text(), 10);
        if($countity===0){
            alert("هذا المنتج غير متوفر ");
        }
        //to take the counter of the product
        var $clickcounter = parseInt($(this).find(" .ordercounter").text(), 10);
         if ($clickcounter != 0) {

            // decress one in each click
            $countity -= 1;
            $clickcounter -= 1;
            parseInt($(this).find(".ordercounter").text($clickcounter), 10);
            //to take the amount of the product after update and update it in html
            parseInt($(this).find(".overlay .amount").text($countity), 10);
            $($order).find(".order").find(".number").text($size);
            $($order).find(".order").attr("id", $productid);
            $($order).find(".order").find(".name").text($name).css({ "text-transform": "capitalize" });
            $($order).find(".order").find(".price span .mainprice").text($price);
            $($order).find(".delete").attr("id", "delete-"+$productid);
            $($order).find(".decress").attr("id", $decreas + $productid);
            $($order).find(".incress").attr("id", $increas + $productid);
            $("#ordercontainer").append($order);
            $("#ordercontainer .order").removeClass("hide");
            $("#hiddenform").append($inputdiv);
            /*==================================================================== */
            /*calculate the number of orders*/
            $(function() {
                var $number = 0;
                $("#ordercontainer .order").each(function() {
                    $number += parseInt($(this).find(".input_quantity").val());
                });

                $(".numberOfOrders").text($number);
            });
        }
        /*============================================*/
        /*calculate total of price reciept */
        $(function() {
            var $totalordersprice = '0';
            $("#ordercontainer .order").each(function() {
                var $orderprice = parseFloat($(this).find(".price span .mainprice").text()) * parseFloat($(this).find(".countity input").val());
                $totalordersprice = Number((parseFloat($totalordersprice) + parseFloat($orderprice)).toFixed(2));
            });
            var cost = $("#district").find('option:selected').attr("data-name");
            cost=0;
            var $value=$("#discount").val();
            if(!$value){$value=0;}
            $totalordersprice-=$value;
            $totalordersprice = Number((parseFloat($totalordersprice) + parseFloat(cost)).toFixed(2));

            $("#total_price_after_discount").text( $totalordersprice );

            /*set total price*/

            /*set price */
            $(".ordersprice").text($totalordersprice);
        });
    });
    
});
//remove order function
function deleteorder(temp_class) {
    var $ordername = $("#" + temp_class).parent().find(".name").text();
    var $orderamount = $("#" + temp_class).parent().find("input").val();
    var $orderprice = $("#" + temp_class).parent().find(".price .mainprice").text();
    var $id = "order-" + $("#" + temp_class).parent().attr("id");

    $("#hiddenform").find("#" + $id).remove();
    var $product =temp_class.split("-")[1];
    var $item_in_main=$("#"+$product);
    $item_in_main.find(".amount").text(parseInt($($item_in_main).find(".amount").text(), 10) + parseInt(1, 10));


    //to check the product of the order and make changes
               alert("تم حذف المنتج من الفاتورة");
            //  $item_in_main.find(".amount").text(parseInt($item_in_main.find(".amount").text(), 10) + parseInt($orderamount, 10));
    $item_in_main.find(".ordercounter").text(parseInt($item_in_main.find(".ordercounter").text(), 10) + parseInt(1, 10));

    /*calculate the number of orders*/
    $(function() {
        var $number = $(".numberOfOrders").text();
        $(".numberOfOrders").text($number - 1);
    });
    /*============================================================================ */
    /*calculate the total of price*/
    var $recieptstotalprice = '0';
    var $totalorderprice = parseFloat($orderprice, 10) * parseInt($orderamount);
    $recieptstotalprice = Number((parseFloat($(".receipt").find(".receipttotalprice .span1 .recieptsprice").text()) - parseFloat($totalorderprice)).toFixed(2));


    /*price */
    $(".receipt").find(".receipttotalprice .span2 .ordersprice").text($recieptstotalprice);
    /*total price */
    $(".receipt").find(".receipttotalprice .span1 .recieptsprice").text($recieptstotalprice);
    /*============================================================================ */
    /*remove product */
    $("#" + temp_class).parent().remove();
    $number--;
    return false;
}
/*==================================================================== */
/*==================================================================== */
/*==================================================================== */
/*filtering the products*/
    /*==================================================================== */
    /*==================================================================== */
    /*==================================================================== */
    /*expected list when foucs on inputs on receipt*/
    //search with number
/*const expectedlist = document.querySelector("#expectedlist");
const expectedlistUl = document.querySelector("#expectedlist ul");
const searchinputnumber = document.forms["receiptclientinfoform"].querySelector("#clientnumber");
searchinputnumber.addEventListener("keyup", function(e) {

    expectedlist.classList.add("showlist");
    const term = e.target.value;
    e2a_numbers(term,"clientnumber");

    const numbers = expectedlistUl.getElementsByClassName("clientnumber");
    let counter = 0;
    Array.from(numbers).forEach(function(number) {
        const clinetnumber = number.textContent;
        if (clinetnumber.indexOf(term) != -1) {
            number.style.display = 'block';
        } else {
            number.style.display = 'none';
            counter++;
            // if the number of client isn't found remove the expected list
            if (counter == expectedlistUl.children.length) {
                expectedlist.classList.remove("showlist");
            }
        }
    });
});
 const expectedlist2 = document.querySelector("#expectedlist2");
 const expectedlistUl2 = document.querySelector("#expectedlist2 ul");
 const searchinputnumber2 = document.forms["receiptclientinfoform"].querySelector("#client_address");
 searchinputnumber2.addEventListener("keyup", function(e) {

     expectedlist2.classList.add("showlist");
     const term = e.target.value;


     const numbers = expectedlistUl2.getElementsByTagName("li");
     let counter = 0;
     Array.from(numbers).forEach(function(number) {
         const clinetnumber = number.textContent;
         if (clinetnumber.indexOf(term) != -1) {
             number.style.display = 'block';
         } else {
             number.style.display = 'none';
             counter++;
             // if the number of client isn't found remove the expected list
             if (counter == expectedlistU2l.children.length) {
                 expectedlist2.classList.remove("showlist");
             }
         }
     });
 });
/*expected list when foucs on inputs on receipt*/
//search with name
 /*
const searchinputname = document.forms["receiptclientinfoform"].querySelector("input[name ='clientname']");
searchinputname.addEventListener("keyup", function(e) {
    expectedlist.classList.add("showlist");
    const term = e.target.value;
    const names = expectedlistUl.getElementsByTagName("li");
    let counter = 0;
    Array.from(names).forEach(function(name) {

        const clinetname = name.children[0].textContent;

        if (clinetname.indexOf(term) != -1) {
            name.style.display = 'block';
            console.log(name.getElementsByClassName("clientname ")[0]);
        } else {
            console.log("aaa")
            name.style.display = 'none';
            counter++;
            // if the name of client isn't found remove the expected list
            /*if (counter == expectedlistUl.children.length) {
                expectedlist.classList.remove("showlist");
            }
        }
    });
});*/
$("#clientname").keyup(function () {
    $(".target_item").css("display","none");
    var value=$(this).val();
    if (value.length<0){

        return;
    }
    if(value.length>=2) {

        $("#expectedlist ul li ").each(function () {
            var name = $(this).find("span:first").text();
            if (name.indexOf(value) !== -1) {

                $(this).css("display", "");

                $("#expectedlist").addClass("showlist");


            } /*else {
                //console.log(name);

                $(this).css("display", "none");
                $("#expectedlist").removeClass("showlist");
            }*/
        })
    }

});

$("#clientnumber").keyup(function () {
    $(".target_item").css("display","none");
    var value=$(this).val();
    if (value.length<0){

        return;
    }
    if(value.length>3) {

        $("#expectedlist ul li ").each(function () {
            var name = $(this).find("span:eq(1)").text();
            if (name.indexOf(value) !== -1) {

                $(this).css("display", "");

                $("#expectedlist").addClass("showlist");


            } /*else {
                //console.log(name);

                $(this).css("display", "none");
                $("#expectedlist").removeClass("showlist");
            }*/
        })
    }

});
$("#client_address").keyup(function () {
    $("#expectedlist2").addClass("showlist");


});


//set the number in the input value
$("#expectedlist ul li").click(function() {
     $("#clientnumber").val("0" + parseInt($(this).find(".clientnumber").text(), 10));
     $("#clientname").val($(this).find(".clientname").text());
     $("#client_address").val($(this).find(".clientaddress").text());
     $("#customer_id").val($(this).find(".clientname").attr("id"));
    $("#governorate").val($(this).find(".gover").text());
    $("#customer_link").val($(this).find(".customer_link").text());

    $(this).parent().parent().removeClass("showlist");
     var temp=$(this).find(".all_addresses").clone();
     temp.attr("id","address_ul");
     temp.attr("class","");

     $("#expectedlist2").html(temp);
 });
 $(document).on("click","#expectedlist2 ul li",function() {

     $("#client_address").val($(this).find("span").text());
     $(this).parent().parent().removeClass("showlist");
 });
 /*function y($id) {
     $("#client_address").val($("#"+$id).find("span").text());
     $("#"+$id).parent().parent().removeClass("showlist");
 };*/
/*show expected list when i focus on input => number*/
var $expectedlist = $("#expectedlist");
$(document).mouseup(function(e) {
    if (!$expectedlist.is(e.target) // if the target of the click isn't the container...
        &&
        $expectedlist.has(e.target).length === 0) // ... nor a descendant of the container
    {
        $expectedlist.removeClass('showlist');
    }
});
 var $expectedlist2 = $("#expectedlist2");
 $(document).mouseup(function(e) {
     if (!$expectedlist2.is(e.target) // if the target of the click isn't the container...
         &&
         $expectedlist2.has(e.target).length === 0) // ... nor a descendant of the container
     {
         $expectedlist2.removeClass('showlist');
     }
 });
/*=========================================================== */
/*=========================================================== */
/*=========================================================== */
/*=========================================================== */
/*=========================================================== */
/*  submit hidden form when click on buttonsubmit on reciepts */
document.getElementById("sumbitreciepts").onclick = function() {

    var $total_price=$("#total_price_after_discount").text();
    var  $discount=$("#discount").val();
    var  $client_id=$("#clientnumber")
    var $date=$("#receiving_date").val();
    $("#hiddenform").find(".discount").val($discount);
    $("#hiddenform").find(".total_price_after_discount").val($total_price);
    $("#hiddenform").find(".receiving_date").val($date);
    $("#hiddenform").find(".client_address").val($("#client_address").val());
    $("#hiddenform").find(".client_name").val($("#clientname").val());
    $("#hiddenform").find(".client_phone").val($("#clientnumber").val());
    $("#hiddenform").find(".client_link").val($("#customer_link").val());
      $("#hiddenform").find(".customer_platform").val($("#customer_platform").val());

    $("#hiddenform").find(".client_governorate").val($("#governorate").val());
    $("#hiddenform").find(".received").val($("#received").find("option:selected").val());
    $("#hiddenform").find(".district_id").val($("#district").val());

    $("#hiddenform").find(".restored_quantity").val($("#restored_quantity").val());
    $("#hiddenform").find(".details").val($(".note").val());

    if( validate(["all"],[["null_input","wrong_length_input"]])){
        if($("#hiddenform").find(".inputdiv").length==0){
            alert("من فضلك اضف منتجات الي الاوردر");
        }
        else{
            document.getElementById("submithiddenform").click();

        }
   }
   else{
       alert("من فضلك راجع الخانات باللون الاحمر");
   }

    }
    /*====================================*/
    /*filltering the prouduct*/
$(".foodcategories ul li").click(function() {
    var $categoryname = $(this).text();
    $("#productcontainer .product").addClass("hide");
    $("#productcontainer .product").each(function() {
        if ($(this).hasClass($categoryname)) {
            $(this).removeClass("hide");
        }
    });
});
$(function() {
    $(".foodcategories ul .foodcategorieslistclick").each(function() {
        var $categoryname = $(this).text();
        $("#productcontainer .product").addClass("hide");
        $("#productcontainer .product").each(function() {
            if ($(this).hasClass($categoryname)) {
                $(this).removeClass("hide");
            }
        });
    });
});

$("#discount").keyup(function () {
    var $value=$(this).val();
    if(!$value){$value=0;}

        var $totalordersprice = '0';
        $("#ordercontainer .order").each(function() {
            var $orderprice = parseFloat($(this).find(".price span .mainprice").text()) * parseFloat($(this).find(".countity input").val());
            $totalordersprice = Number((parseFloat($totalordersprice) + parseFloat($orderprice)).toFixed(2));
        });
      //  $(".receipt").find(".receipttotalprice .span1 .recieptsprice").text($totalordersprice);
        /*set price */
    var cost = $("#district").find('option:selected').attr("data-name");
    cost=0;

    $("#discount_val").text("اجمالي الخصم  :"+ parseFloat($value)+ $("#currency").val() );
    $totalordersprice-=$value;
    $totalordersprice = Number((parseFloat($totalordersprice) + parseFloat(cost)).toFixed(2));

    $("#total_price_after_discount").text( $totalordersprice );




})

$("#district").on("change",function () {
    var $value=$("#discount").val();
    if(!$value){
        $value=0;}

    var value = $(this).find('option:selected').val();
    var value = 0;
    var cost = $(this).find('option:selected').attr("data-name");
    cost=0;
    $(".district_price").text(cost);

    var $totalordersprice = '0';
    $("#ordercontainer .order").each(function() {
        var $orderprice = parseFloat($(this).find(".price span .mainprice").text()) * parseFloat($(this).find(".countity input").val());
        $totalordersprice = Number((parseFloat($totalordersprice) + parseFloat($orderprice)).toFixed(2));
    });
    //  $(".receipt").find(".receipttotalprice .span1 .recieptsprice").text($totalordersprice);
    /*set price */
    $totalordersprice-=$value;
    $("#discount_val").text("اجمالي الخصم  :"+ parseFloat($value)+ $("#currency").val() );

    $totalordersprice = Number((parseFloat($totalordersprice) + parseFloat(cost)).toFixed(2));

    $("#total_price_after_discount").text( $totalordersprice );

  $(".district_id").val(value);

})
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



 $(function(){
     //open add exporter popup when the user cliecked on "add exporter button"
     $(".note").focus(function(){
         $("#textarea").val($(".note").val());
         $("#alert_modal_button").click();
     });
     //close add exporter popup when the user cliecked on " x button"
     $(".close-popup").click(function(){
         $(this).parent().removeClass("open-popup");
     });
     $(".close-pop").click(function(){
         $(".add-popup-container").removeClass("open-popup");
     });
     $(".confirm").click(function () {
         $(".note").val($("#textarea").val());
         $(".close_alert_modal").click();

     })
 });

 $("#restored_quantity").keyup(function () {
     if($(this).val()>$(this).attr("data-quantity")){
         alert("الكمية المسترجعة غير صحيحة");
         $("#sumbitreciepts").attr("disabled",true);
     }
     else
     {        $("#sumbitreciepts").attr("disabled",false);
     }
 })

