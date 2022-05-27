<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{csrf_token()}}">

    <link rel="stylesheet" href="{{asset("fontawesome-free-5.11.2-web/css/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" href="{{asset("css/semantic.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/dataTables.semanticui.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/bootstrap.css")}}">
    <title>شركات الشحن</title>
<style>
    body{
        background: #f7f7f7;
        font-size: 17px;


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
    /*span{
        margin-left: 7px;
    }
    .dropdown-toggle::after{
        margin-right: 10px;
    }*/
    input{
        text-align: right;
        direction: rtl;
    }
    button{
        direction: rtl;
    }


</style>
</head>
<body>
<button style="display: none" id="alert_modal_button" data-target='#alert_modal' data-toggle='modal'></button>

<input style="display: none" value="{{route("ships.update","")}}" id="ships_update">
<input style="display: none" value="{{route("ships.store")}}" id="ships_store">


<div class="wrapper d-flex align-items-stretch" dir="rtl">
    <div class="hidden_phone form-group row" style="width: 100%; display: none" id="hidden_phone">
        <label class="sr-only" >Username</label>
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text" style="font-weight: 700">رقم التليفون</div>
            </div>
            <input  name="phone" type="text" class="form-control" placeholder="ادخل رقم الشركة">
        </div>
    </div>
    <div class="hidden_address form-group row" style="width: 100%;display: none" id="hidden_address">
        <label class="sr-only" >Username</label>
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text" style="font-weight: 700">العنوان</div>
            </div>
            <input name="address[]" id="" type="text" class="form-control"  placeholder="ادخل عنوان العميل">
        </div>
    </div>
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
        <!---start of navbar !-->
        @section('content')
            <li class="breadcrumb-item" ><a href="{{route("home")}}"> الصفحة الرئيسية </a></li>
            <li class="breadcrumb-item active" aria-current="page" ><a href="{{route("ships.index")}}"> شركات الشحن </a></li>

    @endsection
    @include("sidebars.navbar")
    <!---end of navbar !-->

        <!---start of content !-->

        <div class="exports_cases d-none" style="width: 80%; display: inline-flex; margin-left: 10%" >
            <div class="cases first_case" style="width: 33%;">
                <div class="cards"  style="">

                    <div class="card-body" style="display: flex; padding: 0px;" >
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i style="color: yellowgreen;" class="fas fa-shipping-fast fa-4x"></i></div>


                        <a  style="width: 100%;height: 100%;padding: 12px 9px; display: inline-grid;"href="#" class="btn " >
                            <span style="font-weight: bold">1010</span>
                            <span style="font-weight: 900;font-size: 20px">فاتورة شراء</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="cases first_case" style="width: 33%;">
                <div class="cards" >

                    <div class="card-body" style="display: flex; padding: 0px">
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i  style="color: orchid;" class="fas fa-dolly-flatbed fa-4x"></i></div>

                        <a  style="width: 71%;height: 100%;padding: 12px 9px; display: inline-grid;"href="#" class="btn " >
                            <span style="font-weight: bold">925</span>
                            <span style="font-weight: 900;font-size: 20px">اجمالي مشتريات</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="cases first_case" style="width: 33%;">
                <div class="cards" >

                    <div class="card-body" style="display: flex; padding: 0px">
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i style="color: steelblue;" class="fas fa-user-tie fa-4x"></i></div>

                        <a  style="width: 71%;height: 100%;padding: 12px 9px; display: inline-grid; "href="#" class="btn " >
                            <span style="font-weight: bold">5</span>
                            <span style="font-weight: 900;font-size: 20px">اعدد الموردين</span>
                        </a>
                    </div>
                </div>
            </div>



        </div>
        <table id="example" class="ui celled table" style="text-align: center" dir="rtl"   >
            <thead >
            <tr >
                <th style="background: #5C71A3; color: white;" >الشركة</th>
                <th style="background: #5C71A3; color: white;">رقم التليفون</th>
                <th style="background: #5C71A3; color: white;">العنوان</th>

                <th style="background: #5C71A3; color: white;">التفاصيل</th>

                <th style="background: #5C71A3; color: white;">تعديل</th>
                <th style="background: #5C71A3; color: white;">حذف</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ships as $ship)

                <tr style="font-weight: 500" data-id="{{$ship->id}}">
                <td class="name">{{$ship->name}}</td>
                <td class="phone">{{$ship->phone}}</td>
                <td class="address">{{$ship->address}}</td>
                <td class=""><a target="_blank" href="{{route("ship_orders",$ship->id)}}">عرض</a> </td>


                <td><i class="fas fa-user-edit"></i></td>
                <td>
                    <i class="fas fa-trash-alt delete"></i>
                    <form style="display:none;" method="post" action="{{route("ships.destroy",$ship->id)}}">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="delete_button"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach

            </tbody>

        </table>


        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="    border: 4px solid gainsboro;  border-radius: 2.24rem;">
                    <div class="modal-header" dir="ltr">
                        <h5 class="modal-title" id="exampleModalLongTitle" style="margin-left: 32%;margin-top: 6%; direction:rtl"><i class="fas fa-shipping-fast fa-2x" style="padding-right: 10px"></i><span class="add_word">اضافة</span> شركة شحن  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 30px">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height: auto">
                        <form id="modal_form" action="{{route("ships.store")}}" method="post">
                            @csrf
                            <input id="type" name="type" value="company"  class="d-none"> 

                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">اسم الشركة</div>
                                    </div>
                                    <input name="name" id="name" type="text" class="form-control all"  placeholder="ادخل اسم الشركة">
                                </div>
                            </div>

                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">العنوان</div>
                                    </div>
                                    <input name="address" id="address" type="text" class="form-control all"  placeholder="ادخل عنوان الشركة">
                                </div>
                            </div>
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">رقم التليفون</div>
                                    </div>
                                    <input name="phone"  id="phone" type="text" class="form-control all" placeholder="ادخل رقم التليفون">
                                </div>
                            </div>

                            <div class="form-group row last d-none" style="width: 100%">
                                <button type="button" class="btn btn-success add_another_phone"><span>إضافة رقم اخر <i class="fas fa-plus"></i></span></button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
                                <button type="submit" class="btn btn-primary confirm_submit d-none" ></button>

                                <button type="button" class="btn btn-primary submit_button" ><span class="confirm_word">اضافة</span></button>
                           
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="alert_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="    border: 4px solid gainsboro;  border-radius: 2.24rem;">
                    <div class="modal-header" dir="ltr">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 30px">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height: auto;    font-weight: bold;text-align: center;padding: 38px;">
                        هل تريد حذف شركة الشحن ؟
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger close_alert_modal" data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
                        <button type="button" class="btn btn-primary confirm_delete" >تاكيد</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>


<script  src="{{asset("js/jquery-3.4.1.min.js")}}"></script>
<script src="{{asset("js/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("js/dataTables.semanticui.min.js")}}"></script>
<script src="{{asset("js/semantic.min.js")}}"></script>







<script >
    $(document).ready(function() {

        $('#example').DataTable({
            "paging":  true,

            aaSorting: [],
            "language": {
                "lengthMenu":  "",
                "zeroRecords": "لا يوجد نتيجة بحث مطابقة",
                "info":  "",
                "infoEmpty": "",
                "oPaginate": {
                    "sNext":    "التالي",
                    "sPrevious": "السابق"
                },
            }

        });
       /* var temp=$(".grid .row:last");
        var x=$("<button  style='position: absolute;right: 50%;background: #5C71A3;border: none;border-radius: 1.24rem;' class='btn btn-primary'>عرض المزيد</button>");

        temp.html(x);*/
        $("#example_wrapper").css("padding","43px");
        $("#example_wrapper").attr("dir","ltr");

        $("#example_filter").attr("dir","rtl");

        x=$("<button id='modal_button' data-target='#exampleModalCenter' data-toggle='modal' class='btn btn-primary' style='border: none; background: #5C71A3;border-radius: 1.24rem;'><i class='fas fa-shipping-fast fa-2x' ><span style='padding: 14px;font-size: 17px'>اضافة شركة شحن</span></i></button>");
        $(".ui .row:first .eight:first ").html(x);
    } );
    $(document).on("click",".fa-user-edit",function () {
        //get the table tr which contain customer data
        var table=$(this).parent().parent();
        $("#modal_form").attr("action",$("#ships_update").val()+"/"+table.attr("data-id"));
        //get the customer attributes and set them in modal
        $("#name").val(table.find(".name").text());
        $("#address").val(table.find(".address").text());
        $("#modal_form").append("<input style='display:none;' name='_method'  value='PUT' class='put'>  ")

       /* table.find(".phone").each(function () {

            var temp=$("#hidden_phone").clone();
            temp.css("display","");
            temp.attr("id","");
            temp.find("input").val($(this).text());
            // $("#phone").val($(this).text());
            $(".modal-body form .last ").before(temp);

        });*/
        $(".add_word").text("تعديل");
        $(".confirm_word").text("حفظ");
        $("#phone").val(table.find(".phone").text());
        $("#modal_button").click();
    });
    $('#exampleModalCenter').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $(this).find(".hidden_phone").remove();
        $("#modal_form").attr("action",$("#ships_store").val());
        $(".put").remove();
        $(".add_word").text("اضافة");
        $(".confirm_word").text("اضافة");

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




    $(".add_another_phone").click(function () {
        var temp=$("#hidden_phone").clone();
        temp.css("display","");
        temp.attr("id","");

        // $("#phone").val($(this).text());
        $(".modal-body form .last ").before(temp);
    });

    $(".delete").click(function(){
        var temp=$(this);
        $("#alert_modal_button").click();

        $(".confirm_delete").click(function(){

            temp.parent().find(".delete_button").click();
        });

    });
    
    
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

 
  
    function validate(input_array,input_condition_array) {
   
        $bool=true;
        for(var i=0;i<input_array.length;i++){
            for(var j=0;j<input_condition_array[i].length;j++){
   
                if (input_condition_array[i][j]==="null_input"){null_input(input_array[i])}
   
   
            }
   
   
   
        }
        return $bool;
   
   
    }
    $(".submit_button").click(function(){

        if( validate(["all"],[["null_input"]])){
                     
                
            $(".confirm_submit").click();
    
    
        }
        else{
            alert("من فضلك راجع الخانات باللون الاحمر");
        }
    })
    
    $(document).on("click",".paginate_button",function(event){
        $('html, body').animate({
             scrollTop: $("#example").offset().top
        }, 200);
    
});
    

</script>
<script src="{{asset("js/popper.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>

</body>
</html>
