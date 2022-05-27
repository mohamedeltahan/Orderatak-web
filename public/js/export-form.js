$(function(){
    var counter = 0;
    $("#add-item-form").click(function(){
        const prise_inp = document.getElementById("prise");
        /*var p_name = $(".reciept-form form .product-name").val();
        var color_code = $(".reciept-form form .color-code").val();
        var p_quantity = $(".reciept-form form .product-quantity").val();
        var p_prise = $(".reciept-form form .product-prise").val();*/


        $("#hidden-form .item .item-no span").text(++counter);
        /*$("#hidden-form .item .item-name input").val(p_name);
        $("#hidden-form .item .item-code input").val(color_code);
        $("#hidden-form .item .item-quantity input").val(p_quantity);
        $("#hidden-form .item .item-prise input").val(p_prise);*/

        var item_form = $("#hidden-form .item").clone();
        $(".items-form").append(item_form);
        //remove item when the user click on the remove btn and handling the number of item
        $(".item .item-remove").click(function(){
            $(this).parent().remove();
            counter = 0 ;
            $(".items-form .item .item-no span").each(function(){
                $(this).text(++counter);
            });
        });
    });
    /*show expected list when i focus on input => number*/
    var $inp = $(".expectedlist");
    $(document).mouseup(function(e) {
        if (!$inp.is(e.target) // if the target of the click isn't the container...
            &&
            $inp.has(e.target).length === 0) // ... nor a descendant of the container
        {
            $inp.css({"display":"none"});
        }
    });
    document.getElementById("submit-reciepts").onclick = function(){
        //document.getElementById("main-submit-reciepts").click();
        $("#exporter_id").attr("value", $("#trader-name").attr("data-id"));
        $("#receipt_id").attr("value",$(".reciept-no").val());

        $("#total_price_after_discount").attr("value",$("#prise").val());
        $("#paid").attr("value",$(".payed-price").val());

        $("#discount").attr("value",$(".discount-amount").val());
        $("#receiving_dates").attr("value",$(".dates").val());



        document.getElementById("main-submit-items").click();
    }
});
//search in the expected list
//search("trader-expectedlist" , "searchbox" , "list" , "span" , "trader" , "trader-name");
//set v alue of the list in the input when the user click on the name in expected list
$(function(){
    $(".trader .list").click(function(){
        var data = $(this).find(".tradername").text();
        var id = $(this).find(".traderid").text();

        $("#trader-name").val(data);
        $("#trader-name").attr("data-id",id);

        $(this).parent().parent().css({"display":"none"});
    });
});

//==========================================================
$(function(){
    $(".item .item-remove i").click(function(){
        $(this).parent().remove();
    });
})

/*
========================================
========================================
========================================
========================================
*/
//===============================================
/*functions*/
//===============================================
//search function
/*
function search ($container_id , $form_id , $elements_class , $tag_name , $name , $input_id){
    const table = document.querySelector("#" + $container_id);
    const searchbox = document.forms[$form_id].querySelector("."+$input_id);
    searchbox.addEventListener("keyup", function(e) {
    $("."+$name).css({"display":"block"});
    const term = e.target.value.toLowerCase();
    const tablerows = table.getElementsByClassName($elements_class);
        Array.from(tablerows).forEach(function(tablerow) {
            const clientname = tablerow.querySelector($tag_name).textContent;
            if (clientname.toLowerCase().indexOf(term) != -1) {
                tablerow.style.display = 'block';
            } else {
                tablerow.style.display = 'none';
            }
        })
    })
}
/*
validation function
*/
function valid($key , $value){
    var $inp = document.getElementById($key);
    $inp.onkeyup = function(){
        if($value <= 0){

        }
    }
}
$(".exporter_name").on("change",function () {

    var value = $(this).find('option:selected').val();
    var cost = $("#exporter_id").val(value);
})
