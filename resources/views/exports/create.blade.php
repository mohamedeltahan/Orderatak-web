
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("fontawesome-free-5.11.2-web/css/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">

    <link rel="stylesheet" href="{{asset("css/semantic.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/dataTables.semanticui.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/bootstrap.css")}}">
    <style>
        body{
            background: #f7f7f7;
            font-size: 17px;



        }
        .added_row{
            margin: 3px;
            margin-bottom: 15px;
        }
        .btn{
            font-size: 16px;
            font-weight: bold;
        }
        .button_row{
            padding: 10px;
        }
        .input-group-text{
            width: 100%;
            padding-left: 14%;
            direction: ltr;
            font-size: 16px;
        }
        tr:hover {
            background-color: #ffff99;
        }
        a{
            text-align: center;
        }
        .side_bar_icons{
            float: left;
        }
        .col-auto{
            width: 30%;
            margin: 10px;
        }
        input{
            background-color: aliceblue;
        }

        .input-group-text{
            font-weight: 700;
        }
        /*span{
            margin-left: 7px;
        }
        .dropdown-toggle::after{
            margin-right: 10px;
        }*/
        .form-row{
            margin-right: 0%;
        }
        input{
            text-align: right;
            direction: rtl;
        }
        .form-control{
            font-size: 17px;
            font-weight: 500;
        }

    </style>


    <title>فاتورة شراء</title>
</head>

<body>
<input style="display: none" value="{{route("unpaid_transactions","")}}" id="unpaid_transactions">
<div class="wrapper d-flex align-items-stretch" dir="rtl">
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--start side menu component-->

    @include("sidebars.sidebar")
<!--End side menu component-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--start body container-->

    <div style="width: 82%" id="main_div">

    <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--start navbar component-->
        @section('content')
            <li class="breadcrumb-item" ><a href="{{route("home")}}"> الصفحة الرئيسية </a></li>
            <li class="breadcrumb-item" ><a href="{{route("exports.index")}}"> فواتير شراء </a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route("exports.create")}}"> انشاء فاتورة شراء </a></li>
    @endsection
    @include("sidebars.navbar")

    <!--End navbar component-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--add exports popup-->
        <div style="height: 82px; width: 80%; background-color: white; margin-right: 10%; border-radius: 1.24rem;di">
            <div style="position: relative;top:34%;margin-left: 34%"><i style="color: darkgreen;" class="fas fa-money-check-alt fa-2x"> تسجيل فاتورة شراء </i>
            </div>

        </div>
        <div style="background-color: white; margin: 20px;">
            <form id="form"  method="post" action="{{route("exports.store")}}" style="background-color: #f9f7f7">
                @csrf
                <div class="form-row align-items-center" style="">
                    <div class="col-auto">
                        <label class="sr-only" for="inlineFormInputGroup">اسم المورد</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">اسم المورد</div>
                            </div>
                            <select name="exporter_id" type="text" class="form-control all" id="inlineFormInputGroup" placeholder="Username">
                                <option value="0">اختر مورد</option>
                                @foreach($exporters as $exporter)
                                    <option value="{{$exporter->id}}"> {{$exporter->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <label class="sr-only" for="inlineFormInputGroup">Username</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">رقم الفاتورة</div>
                            </div>
                            <input name="receipt_id" type="text" class="form-control all" id="inlineFormInputGroup" placeholder="ادخل رقم الفاتورة">
                        </div>
                    </div>
                    <div class="col-auto">
                        <label class="sr-only" for="inlineFormInputGroup">Username</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text" >التاريخ</div>
                            </div>
                            <input name="receiving_dates" type="date" style="text-align: right" class="form-control all" id="inlineFormInputGroup" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <label class="sr-only" for="inlineFormInputGroup">Username</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">مبلغ الفاتورة</div>
                            </div>
                            <input name="total_price_after_discount" type="text" class="form-control all" id="inlineFormInputGroup" placeholder="ادخل مبلغ الفاتورة">
                        </div>
                    </div>
                    <div class="col-auto">
                        <label class="sr-only" for="inlineFormInputGroup">Username</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">قيمة الخصم</div>
                            </div>
                            <input name="discount" type="text" class="form-control all" id="inlineFormInputGroup" placeholder="ادخل قيمة الخصم">
                        </div>
                    </div>
                    <div class="col-auto">
                        <label class="sr-only" for="inlineFormInputGroup">Username</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">المبلغ المدفوع</div>
                            </div>
                            <input name="paid" type="text" class="form-control all" id="inlineFormInputGroup" placeholder="ادخل المبلغ المدفوع">
                        </div>
                    </div>
                </div>

                <div style="background-color: transparent;" class="button_row">
                    <input style="display: none;" type="submit" id="confirm_submit">
                    <button type="button" id="button" class="btn btn-primary" style="float: right ;width: 100px;height: 45px;">اضافة صنف</button>
                    <button type="button" id="submit" class="btn btn-success" style="margin-left: 1%;width: 100px;height: 45px;">تاكيد</button>
                </div>







            </form>

        </div>
    </div>
    <!--End body container-->
</div>
<div id="x" class="form-row align-items-center added_row" style="border-radius: 15px; background-color: #3377bc; display: none;">
    <div class="col-auto" style="width: 26%">
        <label class="sr-only" for="inlineFormInputGroup">Username</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend" style="width: 22%;">
                <div class="input-group-text">صنف</div>
            </div>
            <select name="items_id[]"  style="width: 70%;" class="form-control">
                <option value="0">اختر صنف</option>

                @foreach($names as $name)
                    <option value="{{$name->id}}">{{$name->name.":".$name->code.":".$name->color}}</option>

                @endforeach
            </select>
            <!input style="width: 59%" type="text" class="form-control" id="inlineFormInputGroup" placeholder="">
        </div>
    </div>
    <div class="col-auto" style="width: 12%;">
        <label class="sr-only" for="inlineFormInputGroup">Username</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend" style="width: 43%;">
                <div class="input-group-text">مقاس</div>
            </div>
            <input name="items_size[]" style="width: 57%" type="text" class="form-control" id="inlineFormInputGroup" placeholder="">
        </div>
    </div>
    <div class="col-auto" style="width: 12%;">
        <label class="sr-only" for="inlineFormInputGroup">Username</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend" style="width: 36%;">
                <div class="input-group-text">كمية</div>
            </div>
            <input name="items_quantity[]"  style="width: 57%;" type="text" class="form-control" id="inlineFormInputGroup" placeholder="">
        </div>
    </div>

    <div class="col-auto" style="width: 14%">
        <label class="sr-only" for="inlineFormInputGroup">Username</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend" style="width: 52%;">
                <div class="input-group-text">سعر شراء</div>
            </div>
            <input name="items_buying_price[]" style="width: 47%;" type="text" class="form-control" id="inlineFormInputGroup" placeholder="">
        </div>
    </div>
    <div class="col-auto" style="width: 13%">
        <label class="sr-only" for="inlineFormInputGroup">Username</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend" style="width: 44%;">
                <div class="input-group-text">سعر بيع</div>
            </div>
            <input name="items_selling_price[]" style="width: 48%" type="text" class="form-control" id="inlineFormInputGroup" placeholder="">
        </div>
    </div>
    <div class="col-auto" style="width: 9%">
        <label class="sr-only" for="inlineFormInputGroup">Username</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend" style="width: 50%;">
                <div class="input-group-text">خصم</div>
            </div>
            <input name="items_discount[]" style="width: 0%; border-radius: 4px;" type="text" class="form-control" id="inlineFormInputGroup" placeholder="  ">
        </div>
    </div>
    <div class="col-auto" style="width: 0%">
        <div class="input-group mb-2">
            <div class="input-group-prepend" style="width: -1%;">
                <button type="button" class="input-group-text"><i class="fas fa-trash-alt delete"></i></button>
            </div>
        </div>
    </div>

</div>

</body>

<!-- hidden modal -->

<script  src="{{asset("js/jquery-3.4.1.min.js")}}"></script>
<script src="{{asset("js/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("js/dataTables.semanticui.min.js")}}"></script>
<script src="{{asset("js/semantic.min.js")}}"></script>




<script >

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
                $(this).attr("placeholder",alert_message);
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
                $(this).attr("placeholder",alert_message);
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
    $(document).ready(function() {

        $('#example').DataTable({
            "paging":   false,

            aaSorting: [],
            "language": {
                "lengthMenu":  "",
                "zeroRecords": "لا يوجد نتيجة بحث مطابقة",
                "info":  "",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from _MAX_ total records)",

            }

        });
        var temp=$(".grid .row:last");
        var x=$("<button  style='position: absolute;right: 50%;background: cadetblue;border: none;border-radius: 1.24rem;' class='btn btn-primary'>عرض المزيد</button>");

        temp.html(x);
        $("#example_wrapper").css("padding","43px");
        $("#example_wrapper").attr("dir","ltr");

        $("#example_filter").attr("dir","rtl");

        /* x=$("<button id='modal_button' data-target='#exampleModalCenter' data-toggle='modal' class='btn btn-primary' style='border: none; background: cadetblue;border-radius: 1.24rem;'><i class='fas fa-user-plus fa-2x' ><span style='padding: 14px;font-size: 17px'>اضافة عميل</span></i></button>");
         $(".ui .row:first .eight:first ").html(x);*/
    } );
    $(document).on("click",".fa-user-edit",function () {
        //get the table tr which contain customer data
        var table=$(this).parent().parent();
        //get the customer attributes and set them in modal
        $("#name").val(table.find(".name").text());
        $("#address").val(table.find(".address").text());
        $("#governorate").val(table.find(".governorate").text());
        $("#facebook_link").val(table.find(".facebook").text());

        table.find(".phone select option").each(function () {

            var temp=$("#hidden_phone").clone();
            temp.css("display","");
            temp.attr("id","");
            temp.find("input").val($(this).text());
            // $("#phone").val($(this).text());
            $(".modal-body form .last ").before(temp);

        })
        $("#phone").parent().parent().css("display","none");
        $('#exampleModalCenter').modal('show');
    });
    $('#exampleModalCenter').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $(this).find(".hidden_phone").remove();
        $("#phone").parent().parent().css("display","");
    })

    /* var row="<tr role='row' class='odd'> <td class='sorting_1'>a</td><td>b</td><td>c</td><td>d</td><td>e</td><td>f</td></tr>";
     $("#example tbody").append(row);*/
    $('#sidebarCollapse').on('click', function () {

        if ($(this).hasClass("hidden")) {

            $(this).removeClass("hidden");
            $("#sidebar").delay(50).fadeIn('slow', function () {
                $("#main_div").css("width", "82%");

            })
        }
        else {
            $("#main_div").css("width", "100%");

            $('#sidebar').delay(50).fadeOut('slow', function () {

                $("#sidebarCollapse").addClass("hidden")
            });

        }
    });
    $("#add_item_button").click(function () {
        if(!$("#add_item_div").hasClass("visible")) {
            $("#add_item_div").delay(300).slideDown('slow', function () {
                $(this).addClass("visible");
            })
        }
        else{
            $("#add_item_div").removeClass("visible");
            $("#add_item_div").slideUp('slow', function () {

            })
        }
    })
    $("#button").click(function () {
        if($("#form .added_row").length%2!==0){
            var temp=$("#x").clone();
            temp.find("select").addClass("all");;
            temp.find("input").addClass("all");
            temp.removeAttr("id");

            temp.css("display","");
            temp.css("background-color","rgb(122, 169, 216)");
            $(".button_row").after(temp);

        }
        else{
            var temp=$("#x").clone();
            temp.find("input").addClass("all");
            temp.find("select").addClass("all");;
            temp.removeAttr("id");
            temp.css("display","");
            temp.css("background-color"," #3169a1");
            $(".button_row").after(temp);
        }
       // $("html, body").animate({ scrollTop: $(document).height() },0);
    })





$("#submit").click(function () {
    if(validate(["all"],[["null_input"]])){
        if($(".added_row").length<2){
           alert(" لا يوجد اصناف بالفاتورة");
           return ; 
        }


        $("#confirm_submit").click();
    }
    else{
        
        alert("من فضلك راجع الخانات باللون الاحمر");
    }
})


$(document).on("click",".delete",function () {
   $(this).parent().parent().parent().parent().parent().remove();
})

$(document).on("change","input",function () {
    $(this).css("background-color","");
 })
 $(document).on("change","select",function () {
    $(this).css("background-color","");
 })

</script>
<script src="{{asset("js/popper.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>


</html>
