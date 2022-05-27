/*calculate total price of the day*/
import {ajaxFunction} from "./ajax.js";

$(function(){
    });
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
        $(this).find(".totalmonth span").text("اجمالي الشهر : " + $totalofmonth + $("#currency").val() );
    //    $(this).find(".totalmonth span").text("اجمالي الشهر : " + $totalofmonth + "جنيه" +"/"+ "5545"+"قطعة");
    });
});
/*======================== */
$(function() {
    
    $(".dateheader").click(function(){
        $(".orderdetails").removeClass("hidden_order");
    if( $(this).parent().hasClass("orderchange")){
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

      if(!$(this).parent().hasClass("filled")) {
          var result = null;
          var temp = $(this);
          var date = $(this).find("span").text();
          var url = $(".url").val();
          var object = {};
          object["date"] = date;

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

              },
              error: function (data) {
                  alert('Error on updating, please try again later!');
                  return false;
              }
          }))
              var table = $("<table></table>");
          for (var i = 0; i < result.length; i++) {


              var tr = $("#temp").clone();
              tr.detach();
              tr.attr("id",result[i].id);
              var shippers=result[i].shippers;
              tr.find(".shippers").html("");
              tr.find(".shippers").append(new Option("اختر مندوب", ""));

              $.each(shippers,function(index,value){
                  tr.find(".shippers").append(new Option(value.name, value.id));
              });
              
              var companies=result[i].companies;
              tr.find(".companies").html("");
              tr.find(".companies").append(new Option("اختر شركة شحن", ""));

              $.each(companies,function(index,value){
                  tr.find(".companies").append(new Option(value.name, value.id));
              });
              

              tr.find(".id").text(result[i].id);
           //   tr.find(".username").text(result[i].username);
              tr.find(".state").parent().attr('data-id',result[i].id);
              tr.find(".shippers").parent().attr('data-id',result[i].id);
              tr.find(".companies").parent().attr('data-id',result[i].id);

             tr.find(".state option[value='"+result[i].state+"']").attr('selected','selected');
             tr.find(".order_user option[value='"+result[i].user_id+"']").attr('selected','selected');
             //tr.find(".person option[value='"+result[i].user_id+"']").attr('selected','selected');

            // tr.find(".state").val("تم التاكيد");
              tr.find(".count").text(result[i].no_of_items);

              tr.find(".hour").text(result[i].hour);
              tr.find(".delivery").text(result[i].delivery);

              tr.find(".receiving_address").text(result[i].receiving_address);
              tr.find(".customer_name").text(result[i].customer_name);
              tr.find(".shippers option[value='"+result[i].ship_id+"']").attr('selected','selected');
              tr.find(".companies option[value='"+result[i].ship_id+"']").attr('selected','selected');

              tr.find(".policy_id a").text(result[i].policy_id);
              tr.find(".policy_id a").attr("href",tr.find(".policy_id a").attr("href")+"/"+result[i].id);
              tr.find(".link").text(result[i].id);
              tr.find(".edit_form").attr("action",result[i].edit_link);

              tr.find(".link").attr("href",result[i].link);
              tr.find(".destroy_form").attr("action",result[i].destroy_link);
              tr.find(".total_price_after_discount").text(result[i].total_price_after_discount);
              table.append(tr);


            //     temp.parent().find("table").append("<tr><td>"+result[i].id+"</td><td>"+result[i].username+"</td><td>dsadasd</td><td>"+result[i].no_of_items+"</td><td>"+result[i].hour+"</td><td>"+result[i].delivery+"</td><td>"+result[i].customer_name+"</td><td>dsadasd</td></tr>");
          }
          temp.parent().addClass("filled");
          temp.parent().find("table").append(table.html());
      }

        $(".orderdetails").removeClass("hidden_order");

        $(".month").toggleClass("widthbro");
        $(this).parent().removeClass("widthbro");
        $(this).parent().toggleClass("changemonth");
        $(this).parent().find(".orderstable").toggleClass("toggeltable");
    });
});
$(function() {
    //casher popup close function
    $("body").on("click",".closepopup",function() {
        $(this).parent().fadeOut();
        $('.category').removeClass('categoryclick');
        $("#exportpage").addClass('categoryclick');
    });
    // ===========================================================
    //casher popup open function
    $("body").on("click","#casher",function() {
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
    $("body").on("click",".restore",function(){
        $("#form").attr("action",$(this).attr("data-route"));
        $("#restored_quantity").attr("data-quantity",parseInt($(this).parent().find(".max_restored_quantity").text()));
        $(".TotalItemsInOrderPopupContainer").css("z-index",0);
        $("#modal_button").click();
    });
    //close add exporter popup when the user cliecked on " x button"
    $(".close-popup").click(function(){
        $(this).parent().removeClass("open-popup");
        $(".filled_dynamically").remove();
    });
    $(".close-pop").click(function(){
        $(".restore-container").removeClass("open-popup");
    });
});
/*edit-container */
$(function(){
    //open add exporter popup when the user cliecked on "add exporter button"
    $("body").on("click",".edit",function(){
        $(this).parent().find(".edit_button").click();
    });
    //close add exporter popup when the user cliecked on " x button"
    $(".close-popup").click(function(){
        $(this).parent().removeClass("open-popup");
        $(".filled_dynamically").remove();
    });
    $(".close-pop").click(function(){
        $(".edit-container").removeClass("open-popup");
    });
});
/*=========================================================== */
/*items popup */
$("body").on("click",".itemsinorder",function() {
    if(!$(this).parent().find(".TotalItemsInOrderPopup table").hasClass("filled")){
        var result = null;
        var id = $(this).parent().attr("id");
      
        var temp=$(this);

        var url = $(".url2").val()+"/"+id;



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if ($.ajax({
            url: url,
            type: "get",
            async: false,

            success: function (r) {
                result = r;


            },
            error: function (data) {
                alert('Error on updating, please try again later!');
                return false;
            }
        }))
            var table = $("<table></table>");
       for (var i = 0; i < result.length; i++) {
           console.log(result[i]);





            var tr = $("#last").clone();
            tr.detach();

            tr.find(".name").text(result[i].name.name);
            tr.find(".code").text(result[i].name.code);

            tr.find(".size").text(result[i].size);
           tr.find(".restore").attr("data-route",$(".restore_link").val()+"/"+result[i].id);

            tr.find(".price").text(result[i].selling_price);
           tr.find(".replace_link").attr("href",tr.find(".replace_link").attr("href").replace("X",result[i].id));


            tr.find(".max_restored_quantity").text(result[i].quantity);
         /*   tr.find(".customer_name").text(result[i].customer_name);
            tr.find(".ship option[value='"+result[i].ship_id+"']").attr('selected','selected');
            tr.find(".policy_id").text(result[i].policy_id);
            tr.find(".link").text(result[i].id);
            tr.find(".link").attr("href",result[i].link);

            tr.find(".total_price_after_discount").text(result[i].total_price_after_discount);*/
            table.append(tr.children());


            //     temp.parent().find("table").append("<tr><td>"+result[i].id+"</td><td>"+result[i].username+"</td><td>dsadasd</td><td>"+result[i].no_of_items+"</td><td>"+result[i].hour+"</td><td>"+result[i].delivery+"</td><td>"+result[i].customer_name+"</td><td>dsadasd</td></tr>");
        }
       // temp.parent().addClass("filled");
        temp.parent().find(".TotalItemsInOrderPopup table").addClass("filled");

        temp.parent().find(".TotalItemsInOrderPopup table").append(table.html());
    }

    
    $(this).parent().find(".TotalItemsInOrderPopupContainer").fadeIn();
});


/*delete export from exports table */
$("body").on("click",".delete",function(){
    var temp=$(this);
    $("#alert_modal_button").click();


    $(".confirm").click(function(){

        temp.parent().find(".delete_button").click();

    });

});
/*transaction popup */
$(".payed-details").click(function() {
    $("#paytransaction").fadeIn();
});
$('body').on('change', '.state', function() {
    var value=$(this).find('option:selected').text();
    var $id=$(this).parent().attr("data-id");
    var obj={};
    var parent=$(this).parent();
    obj["state"]=value;
    obj["_method"]="PUT";
    var bool=0;
    var $url=$("#orders_update").val()+"/"+$id;
    if(value!="مرتجع"){
    bool= ajaxFunction(obj,$url,"post");
    parent.css("background",$(this).find('option:selected').css("background"));

    }
    else{
        $("#restore_order_modal_button").click();
        $("#restore_order_submit_button").click(function(){
            obj["new_cost"]=$("#new_cost").val();
            obj["reason"]=$("#reason").val();
            obj["received"]=$("#received").val();
            obj["store_id"]=$("#store_id").val();
            
            bool= ajaxFunction(obj,$url,"post");
            $(".close_restore_order_modal").click();

           


        });

    }

    if (bool!==0){
        alert("تم تغير حالة الطلب");
    }

});
$(document).on("click","#confirm_update",function(){
    var obj={};
    var bool=0;
    var $url=$("#update_form").attr("action");
        $("#update_form").find("input").each(function(){

              if(!$(this).prop("disabled")){
                  obj[$(this).attr("name")]=$(this).val();



              }


        });
        
        $("#update_form").find("select").each(function(){

            if(!$(this).prop("disabled")){
                obj[$(this).attr("name")]=$(this).val();



            }


      });
        obj["details"]=$("#details").val();
        bool= ajaxFunction(obj,$url,"post");
        if (bool!==0){
            $(".close_update_modal").click();
        }

      



   })
$('body').on('change', '.order_user', function() {
    var value=$(this).find('option:selected').text();
    var $id=$(this).parent().attr("data-id");
    
    var obj={};
    obj["user_id"]=value;
    obj["_method"]="PUT";
    var bool=0;
    var $url=$("#orders_update").val()+"/"+$id;
    bool= ajaxFunction(obj,$url,"post");

    if (bool!==0){
        alert("تم تغير حالة الطلب");
    }

});


$("#example_filter #search").keyup(function (e) {
    if(e.key=="Backspace"){$(".order").removeClass("hidden_order")}
})
$(".search_button").click(function () {
    $(".order").removeClass("orderchange");
    $(".month").removeClass("changemonth");
    $("orderstable").addClass("toggeltable");
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
            

        },
        error: function (data) {
            alert('عفوا حدث خطأ');
         
        }
    })) { 
        if(result!=="false"){
        $("."+result).parent().click();}
      else{
        alert('هذه الفاتورة غير موجودة');

      }
    }
    if(object["type"]=="policy_id" && result!=="false"){
      
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
    else if(object["type"]=="order_id" && result!=="false"){
      

        $(".number").each(function () {
            if($(this).find(".link").text()===value){
                $(".order").addClass("hidden_order");
                $(this).parent().parent().parent().parent().parent().parent().parent().find(".dateheader").click();
                $(this).parent().parent().parent().parent().parent().find(".ordersdate").click();
                $(this).parent().parent().parent().parent().parent().find(".ordersdate").parent().parent().parent().removeClass("hidden_order");

                $(".orderdetails").addClass("hidden_order");
                $(this).parent().removeClass("hidden_order");
                return false;

            }});

    }

    /*if(found===false) {
        if ($.ajax({
            url: url,
            type: "post",
            async: false,
            //request data
            data: object,
            success: function (r) {
                result = r;

            },
            error: function (data) {
                alert('Error on updating, please try again later!');
                return false;
            }
        })) {
            var temp = $("." + result.date).parent();
            var table = $("<table></table>");


            var tr = $("#temp").clone();

            tr.detach();
            tr.attr("id", result.id);

            tr.find(".id").text(result.id);
            tr.find(".username").text(result.username);
            tr.find(".state").parent().attr('data-id', result.id);
            tr.find(".ship").parent().attr('data-id', result.id);

            tr.find(".state option[value='" + result.state + "']").attr('selected', 'selected');
            // tr.find(".state").val("تم التاكيد");
            tr.find(".count").text(result.no_of_items);

            tr.find(".hour").text(result.hour);
            tr.find(".delivery").text(result.delivery);

            tr.find(".receiving_address").text(result.receiving_address);
            tr.find(".customer_name").text(result.customer_name);
            tr.find(".ship option[value='" + result.ship_id + "']").attr('selected', 'selected');
            tr.find(".policy_id").text(result.policy_id);
            tr.find(".link").text(result.id);
            tr.find(".link").attr("href", result.link);
            tr.find(".destroy_form").attr("action", result.destroy_link);
            tr.find(".total_price_after_discount").text(result.total_price_after_discount);
            table.append(tr);


            //     temp.parent().find("table").append("<tr><td>"+result[i].id+"</td><td>"+result[i].username+"</td><td>dsadasd</td><td>"+result[i].no_of_items+"</td><td>"+result[i].hour+"</td><td>"+result[i].delivery+"</td><td>"+result[i].customer_name+"</td><td>dsadasd</td></tr>");
        }

        temp.parent().find("table").append(table.html());
        $(".policy_id").each(function () {
            if($(this).text()==value){
                $(this).parent().parent().parent().parent().parent().parent().parent().find(".dateheader").click();
                $(this).parent().parent().parent().parent().parent().find(".ordersdate").click();
                $(".orderdetails").addClass("hidden_order");
                $(this).parent().removeClass("hidden_order");
                return false;
            }});


    }

           /*$(".number").each(function () {
               if($(this).find("a").text()===val){
                   $(this).parent().parent().parent().parent().parent().parent().parent().find(".dateheader").click();
                   $(this).parent().parent().parent().parent().parent().find(".ordersdate").click();
                   $(".orderdetails").addClass("hidden_order");
                   $(this).parent().removeClass("hidden_order");
                   /*    $(".month").toggleClass("widthbro");
                       $(this).parent().removeClass("widthbro");
                       $(this).parent().toggleClass("changemonth");
                       $(this).parent().find(".orderstable").toggleClass("toggeltable");*/
         /*   $(".month").removeClass("changemonth");
            $(".month").removeClass("widthbro");
            $(".order").removeClass("orderchange");

            var obj=$(this).parent().parent().parent().parent().parent();
            //  $(obj).parent().find(".dateheader").toggleClass("orderchange");

            $(obj).parent().parent().toggleClass("orderchange");
            $(".month").find(".orderstable").addClass("toggeltable");

            $(".month").toggleClass("widthbro");
            $(obj).removeClass("widthbro");
            $(obj).toggleClass("changemonth");
            $(obj).find(".orderstable").toggleClass("toggeltable");


        }
    })*/
});
/*$(document).mouseup(function (e) {
    var temp= $(".exportscontainer");
    if (temp.is(e.target)){
        $(".order").removeClass("orderchange");
    }
});*/
$("#restored_quantity").keyup(function () {

    if(parseInt($(this).val())>$(this).attr("data-quantity")){
        alert("الكمية المسترجعة غير صحيحة");
        $("#submit_button").attr("disabled",true);
    }
    else
    {        $("#submit_button").attr("disabled",false);
    }
});
$("body").on('change', '.shippers', function() {
    var value=$(this).find('option:selected').val();
    var $id=$(this).parent().attr("data-id");
    var obj={};
    obj["ship_id"]=value;
    if(value!=0){obj["state"]="تم الشحن";}
    else{
        obj["state"]="تم التاكيد";
    }

    obj["_method"]="PUT";
    var bool=0;

    var $url=$("#orders_update").val()+"/"+$id;
    bool= ajaxFunction(obj,$url,"post");

    if (bool!==0){
        
        $(".companies").val("");
        alert("تم تغير مندوب الشحن");
      if(obj["state"]=="تم التاكيد") {$(this).parent().parent().find('.state').val("تم التاكيد");}
      else{$(this).parent().parent().find('.state').val("تم الشحن");}

    }

});


$("body").on('change', '.companies', function() {

    var value=$(this).find('option:selected').val();
    var $id=$(this).parent().attr("data-id");
    var obj={};
    obj["ship_id"]=value;
    if(value!=0){obj["state"]="تم الشحن";}
    else{
        obj["state"]="تم التاكيد";
    }

    obj["_method"]="PUT";
    var bool=0;

    var $url=$("#orders_update").val()+"/"+$id;
    bool= ajaxFunction(obj,$url,"post");

    if (bool!==0){
        $(".shippers").val("");
        alert("تم تغير شركة الشحن");
      if(obj["state"]=="تم التاكيد") {$(this).parent().parent().find('.state').val("تم التاكيد");}
      else{$(this).parent().parent().find('.state').val("تم الشحن");}

    }

});
