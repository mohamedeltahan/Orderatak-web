<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{csrf_token()}}">
<link rel="stylesheet" href="{{asset("css/style.css")}}">

<link rel="stylesheet" href="{{asset("css/semantic.min.css")}}">
<link rel="stylesheet" href="{{asset("css/dataTables.semanticui.min.css")}}">
<link rel="stylesheet" href="{{asset("css/bootstrap.css")}}">
<title>العملاء</title>
<style>
    .row{
        padding:7px;
    }
    #example_filter label{
        display:none;
    }
     
    .error {
        background-color: #fce4e4;
        border: 1px solid #fcc2c3;
        padding: 20px 30px;
    }
    .error-text {
        color: #cc0033;
        font-family: Helvetica, Arial, sans-serif;
        font-size: 20px;
        font-weight: bold;
        line-height: 20px;
        text-shadow: 1px 1px rgba(250,250,250,.3);
        text-align: center;
    }
    .odd{
        /*background:darkgray;*/

    }
    .even{
        /*background: gainsboro;*/
    }
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
        direction:rtl;
    }

</style>



<body>
<div style="display:none;">{{$user=\Illuminate\Support\Facades\Auth::user()}}</div>
<input style="display: none" value="{{route("customers.update","")}}" id="customers_update">
<input style="display: none" value="{{route("customers.store")}}" id="customers_store">
<input style="display: none" value="{{route("load_more_customers","")}}" id="load_more_customers">
<input style="display: none" value="{{route("search_customers")}}" id="search_customers">

<button style="display: none" id="alert_modal_button" data-target='#alert_modal' data-toggle='modal'></button>
<div class="d-none temp_icons"  >
    <i class="fab fa-facebook fa-2x  فيسبوك"> </i>
    <i class="fab fa-twitter fa-2x تويتر" > </i>
    <i class="fab fa-instagram fa-2x انستجرام" style="color: red"> </i>
    <i class="جوميا">  </i>
    <i class="سوق">  </i>
    <i class="اخري" > </i>
</div>
<div class="wrapper d-flex align-items-stretch" dir="rtl">
    <div class="hidden_phone row" style="width: 100%; display: none" id="hidden_phone">
       <div class="col">
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text" style="font-weight: 700">رقم التليفون</div>
            </div>
            <input  name="phone[]" type="text" class="form-control" placeholder="ادخل رقم العميل">
        </div>
       </div>
    </div>
    <div class="hidden_address  row" style="width: 100%;display: none" id="hidden_address">
        <div class="col">
         <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text" style="font-weight: 700">العنوان</div>
            </div>
            <input name="address[]" id="" type="text" class="form-control"  placeholder="ادخل عنوان العميل">
         </div>
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
            <li class="breadcrumb-item" aria-current="page"><a href="{{route("home")}}"> الصفحة الرئيسية </a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{route("customers.index")}}"> العملاء </a></li>

    @endsection
    @include("sidebars.navbar")
    <!---end of navbar !-->


        <!---start of content !-->
        <div class="exports_cases" style="width: 80%; display: inline-flex; margin-left: 10%" >
            <div class="cases first_case" style="width: 33%;">
                <div class="cards"  style="">

                    <div class="card-body" style="display: flex; padding: 0px;" >
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i style="color: yellowgreen;" class="fas fa-users fa-4x"></i></div>


                        <a  style="width: 100%;height: 100%;padding: 12px 9px; display: inline-grid;"href="#" class="btn " >
                            <span style="font-weight: bold">{{$escaped_customers+$normal_customers}}</span>
                            <span style="font-weight: 900;font-size: 20px"> اجمالي العملاء</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="cases first_case" style="width: 33%;">
                <div class="cards" >

                    <div class="card-body" style="display: flex; padding: 0px">
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i  style="color: orchid;" class="fas fa-user fa-4x"></i></div>

                        <a  style="width: 71%;height: 100%;padding: 12px 9px; display: inline-grid;"href="#" class="btn " >
                            <span style="font-weight: bold">{{$normal_customers}}</span>
                            <span style="font-weight: 900;font-size: 20px"> عملاء عاديين</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="cases first_case" style="width: 33%;">
                <div class="cards" >

                    <div class="card-body" style="display: flex; padding: 0px">
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i style="color: red;" class="fas fa-running fa-4x"></i></div>

                        <a  style="width: 71%;height: 100%;padding: 12px 9px; display: inline-grid; "href="#" class="btn " >
                            <span style="font-weight: bold">{{$escaped_customers}}</span>
                            <span style="font-weight: 900;font-size: 20px">عملاء متهربين</span>
                        </a>
                    </div>
                </div>
            </div>



        </div>
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="error-text">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table id="example" class="ui celled table" style="text-align: center" dir="rtl"   >
            <thead >
            <tr >
                <th style="background: lightseagreen; color: white;" >الاسم</th>
                <th style="background: lightseagreen; color: white;">رقم التليفون</th>
                <th style="background: lightseagreen; color: white;">المنصة</th>
                <th style="background: lightseagreen; color: white;">المحافظة</th>
                <th style="background: lightseagreen; color: white;">العنوان</th>
                <th style="background: lightseagreen; color: white;">الحالة</th>
                <th style="background: lightseagreen; color: white;">تعديل</th>
                <th style="background: lightseagreen; color: white;">حذف</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)

                <tr style="font-weight: 500;" class="customers_row" data-id="{{$customer->id}}">
                <td class="name" style="border-left: 1px solid rgba(34,36,38,.1);"><a target="_blank" href="{{route("customers.show",$customer->id)}}">{{$customer->name}}</a></td>
                <td class="phone">
                    <select style="border: none;font-weight: 500;background: none">
                        @foreach($customer->phones as $phone)
                            <option class="phones" data-id="{{$phone->id}}">{{$phone->phone}}</option>
                        @endforeach
                    </select>
                </td>
                <td class="customer_link">   
                     <a href="{{$customer->customer_link}}" target="_blank"> <span>
                  @if($customer->customer_platform=="فيسبوك")
                  <i class="fab fa-facebook fa-2x"> </i>
                  @elseif($customer->customer_platform=="انستجرام")
                  <i class="fab fa-instagram fa-2x" style="color: red"> </i>
                  @elseif($customer->customer_platform=="تويتر")
                  <i class="fab fa-twitter fa-2x"> </i>
                  @else
                   {{$customer->customer_platform}}
                  @endif




                   
                
                </span></a>
                </td>
                <td class="governorate">{{$customer->governorate}}</td>
                <td class="address" >
                    <select style="border: none;font-weight: 500;background: none; width: 250px">
                        @foreach($customer->addresses as $address)
                            <option data-id="{{$address->id}}">{{$address->address}}</option>
                        @endforeach
                    </select>
                </td>
                <td> <select class="state" style="border: none;font-weight: 500;background: none">
                        <option @if($customer->type=="عادي") selected @endif value="عادي">عادي</option>
                        <option @if($customer->type=="متهرب") selected @endif value="متهرب">متهرب</option></select></td>
                <td><i data-id="{{$customer->id}}" class="fas fa-user-edit"></i></td>
                    <td><i class="fas fa-trash-alt delete"></i>
                        <form style="display:none;" method="post" action="{{route("customers.destroy",$customer->id)}}">
                            @csrf
                            @method("delete")
                            <button class="delete_button"></button>

                        </form>
                    </td>            </tr>
                @endforeach


            </tbody>

        </table>


        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  >
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 60%">
                <div class="modal-content" style="    border: 4px solid gainsboro;  border-radius: 2.24rem;">
                    <div class="modal-header" dir="ltr">
                        <h5 class="modal-title" id="exampleModalLongTitle" style="margin-left: 41%;margin-top: 6%; direction:rtl;"><i class="fas fa-user fa-2x" style="padding-left: 10px;"></i><span class="text">اضافة عميل</span> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 30px">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height: auto">
                        <form id="form" method="post" action="{{route("customers.store")}}">
                            @csrf
                            <div class="row" style="width: 100%">
                                <div class="col">
                                    <div class="input-group mb-2 mr-sm-2">
                                       <div class="input-group-prepend">
                                            <div class="input-group-text" style="font-weight: 700">اسم العميل</div>
                                       </div>
                                    <input name="name" id="name" type="text" class="form-control all"  placeholder="ادخل اسم العميل">
                                    </div>
                                </div>
                                <div class="col">
                                      <div class="input-group mb-2 mr-sm-2">
                                          <div class="input-group-prepend">
                                            <div class="input-group-text" style="font-weight: 700">المحافظة</div>
                                          </div>
                                        <input name="governorate" id="governorate" type="text" class="form-control all"  placeholder="ادخل المحافظة">
                                      </div>
                                    </div>
                                </div>
                            <div class=" row" style="width: 100%">
                                <div class="col">
                                    <div class="input-group mb-2 mr-sm-2">
                                       <div class="input-group-prepend">
                                            <div class="input-group-text" style="font-weight: 700">منصة العميل</div>
                                       </div>
                                    <select  name="customer_platform" type="text" id="customer_platform"  class="form-control all">
                                        <option value="0" >اخنر  منصة العميل</option>
                                        <option data-holder="ادخل لينك الفيسبوك" value="فيسبوك" >فيسبوك</option>
                                        <option data-holder="ادخل لينك انستجرام" value="انستجرام" >انستجرام</option>
                                        <option data-holder="ادخل لينك تويتر" value="تويتر" >تويتر</option>
                                        <option data-holder="ادخل لينك جوميا" value="جوميا" >جوميا</option>
                                        <option data-holder="ادخل لينك سوق" value="سوق" >سوق</option>
                                        <option data-holder="ادخل لينك العميل" value="اخري" >اخري</option>
        
        
         
                                     </select>   
                                
                                </div>
                                </div>

                                <div class="col">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" style="font-weight: 700">لينك العميل</div>
                                        </div>
                                        <input name="customer_link" id="customer_link" type="text" class="form-control all"  placeholder="ادخل لينك الخاص بالعميل">
                                    </div>
                                </div>
                                
                                
                            </div>
                         
                            <div class="last row" style="width: 100%">
                                <div class="col">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" style="font-weight: 700">العنوان</div>
                                        </div>
                                        <input name="address[]" id="address" type="text" class="form-control all"  placeholder="ادخل عنوان العميل">
                                    </div>
                                </div>
                             
                                
                            </div>
                            <div class=" row" style="width: 100%">
                             <div class="col">
                                 <div class="input-group mb-2 mr-sm-2">
                                     <div class="input-group-prepend">
                                         <div class="input-group-text" style="font-weight: 700">رقم التليفون</div>
                                     </div>
                                     <input name="phone[]"  id="phone" type="text" class="form-control all" placeholder="ادخل رقم الهاتف">
                                </div>
                              </div>
                            </div>

                            <div class="form-group row " style="width: 100%">
                                <button type="button" class="btn btn-success add_another_phone" style="margin-right: 7px"><span>إضافة رقم اخر <i class="fas fa-plus"></i></span></button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
                                <button type="button" class="btn btn-primary submit_button" >اضافة</button>
                                <button type="submit" class=" d-none submit_input" >اضافة</button>

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
                        هل تريد حذف العميل ؟
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger close_alert_modal" data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
                        <button type="button" class="btn btn-primary confirm" >تاكيد</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="search_div" style="display: none;">
         <button class="reset_search"><i class="fas fa-sync-alt"></i></button>
        <button id="search_button" style="width: 17%;margin-left: 5%;">بحث </button>
        <select id="search_option" style=" width: 24%; margin-left: 2%;">
            <option value="none">ابحث ب</option>
            <option data-holder="ادخل تفاصيل العميل" type="radio" name="option" value="quick_search">بحث سريع</option>
            <option data-holder="ادخل اسم العميل" type="radio" name="option" value="name">اسم</option>
            <option data-holder="ادخل رقم الهاتف" type="radio" name="option" value="phone">رقم هاتف</option> </select>
        <input type="text" id="search" style="width: 44%;margin-left: 1%;" placeholder="ابحث ب ....">
    </div>
    <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->

        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
<table style="display: none">

    <tr id="temp_customer_row" style="font-weight: 500" class="customers_row">
        <td class="name"><a target="_blank" href="{{route("customers.show","X")}}"></a></td>
        <td class="phone">
            <select style="border: none;font-weight: 500;background: none">

            </select>
        </td>
        <td class="customer_link">   
            <a href="" target="_blank"> <span>
    
       </span></a>
       </td>
        <td class="governorate"></td>
        <td class="address" >
            <select style="border: none;font-weight: 500;background: none; width: 250px">

            </select>
        </td>
        <td> <select class="state" style="border: none;font-weight: 500;background: none">
                <option value="عادي">عادي</option>
                <option value="متهرب">متهرب</option></select></td>
        <td><i data-id="" class="fas fa-user-edit"></i></td>
        <td><i class="fas fa-trash-alt delete"></i>
        <form style="display:none;" method="post" id="delete_form" action="{{route("customers.destroy","X")}}">
                            @csrf
                            @method("delete")
                            <button class="delete_button"></button>

        </form>
        </td>
    </tr>


</table>
<!-- remove exporters popup model -->



    <script  src="{{asset("js/jquery-3.4.1.min.js")}}"></script>
    <script src="{{asset("js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("js/dataTables.semanticui.min.js")}}"></script>
    <script src="{{asset("js/semantic.min.js")}}"></script>



<script >
    var t=null;
    $(document).ready(function() {

     t=$('#example').DataTable({
            "paging":   false,
            "searching":true,

            aaSorting: [],
            "language": {
                "lengthMenu":  "",
                "zeroRecords": "لا يوجد نتيجة بحث مطابقة",
                "info":  "",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from _MAX_ total records)",

            }



        });
        //get the last grid and last row class in  the table to add the view more button
        var temp=$(".grid .row:last");
        var x=$("<button id='load_more'  style='position: absolute;right: 50%;background: lightseagreen;border: none;border-radius: 1.24rem;' class='btn btn-primary'>عرض المزيد</button>");
        temp.html(x);
        //style the example filter
        $("#example_wrapper").css("padding","43px");
        $("#example_wrapper").attr("dir","ltr");
        //put my custom search div that i want to use and replace it by the default datatable search
        $("#example_filter").append($("#search_div").html());
        $("#example_filter").css("display","flex");
        //add the button that trigger add customer modal at the top of datatable wrapper
        x=$("<button id='modal_button' data-target='#exampleModalCenter' data-toggle='modal' class='btn btn-primary' style='border: none; background: lightseagreen;border-radius: 1.24rem;'><i class='fas fa-user-plus fa-2x' ><span style='padding: 14px;font-size: 17px'>اضافة عميل</span></i></button>");
        $(".ui .row:first .eight:first ").html(x);
    } );
    $(document).on("click",".fa-user-edit",function () {
        var customer_id=$(this).attr("data-id");
        $("#form").attr("action",$("#customers_update").val()+"/"+customer_id);
        $("#form").append("<input style='display:none;' name='_method'  value='PUT' class='put'>  ")
        //get the table tr which contain customer data
        var table=$(this).parent().parent();
        //get the customer attributes and set them in modal
        $("#name").val(table.find(".name").text());
       // $("#address").val(table.find(".address").find("option:selected").val());
        $("#governorate").val(table.find(".governorate").text());
        $("#facebook_link").val(table.find(".facebook").text());
        //for each phone for customer add input field in edit form
        table.find(".phone select option").each(function () {

            var temp=$("#hidden_phone").clone();
            temp.css("display","");
            temp.attr("id","");
            temp.find("input").val($(this).text());
            // $("#phone").val($(this).text());
            $(".modal-body form .last ").before(temp);

        });
        table.find(".address select option").each(function () {

            var temp=$("#hidden_address").clone();
            temp.css("display","");
            temp.attr("id","");
            temp.find("input").val($(this).text());
            // $("#phone").val($(this).text());
            $(".modal-body form .last ").before(temp);

        });
        //hide the empty phone input in the original form bec its used in add customer not edit it
        /*$("#phone").attr("name","");
        $("#address").attr("name","");
        $("#phone").parent().parent().css("display","none");
        $("#address").parent().parent().css("display","none");*/

         $("#phone").attr("placeholder","ادخل رقم هاتف اخر");
         $("#address").attr("placeholder","ادخل عنوان اخر");
         $("#phone").removeClass("all");
         $("#address").removeClass("all");

        $('#exampleModalCenter .modal-title .text').text("تعديل عميل");
        $('#exampleModalCenter .submit_button').text("حفظ");




        //triger the modal
        $("#modal_button").click();
    });
    $('#exampleModalCenter').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        //remove the phones added when edit customer
        $("#form").attr("action",$("#customers_store").val());
        $(".put").remove();

        $(this).find(".hidden_phone").remove();
        $(this).find(".hidden_address").remove();

        $("#phone").attr("placeholder","ادخل رقم العميل ");
        $("#address").attr("placeholder"," ادخل العنوان العميل ");
        $("#phone").addClass("all");
        $("#address").addClass("all");
        $("input").css("background-color","#fff");
        
        $('#exampleModalCenter .modal-title .text').text("اضافة عميل");
        $('#exampleModalCenter .submit_button').text("اضافة");

        
    

        $("#phone").parent().parent().css("display","");
    });

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

    $(document).on("click","#search_button",function () {
        $("#load_more").css("display","none");
        if($("#example_filter #search_option").find("option:selected").val()==="none"){
            alert("اختر وسيلة البحث");
            return;
        }
        
        var val=$("#example_filter #search").val();
        if(val.length===0){return;}
        if($("#example_filter #search_option").find("option:selected").val()==="quick_search"){
            t.search(val).draw();
            return ;
        }
        $(".customers_row").css("display", "none");
        var found=search_in_html(val);
        if(found===false){
            var url = $("#search_customers").val();
            var object={};
            object["type"]=$("#example_filter #search_option").find("option:selected").val();
            object["value"]=val;
            

                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if ($.ajax({
                url: url,
                type: "get",
                data:object,
                async: false,

                success: function (result) {

                    var table = $("<table></table>");
                    for (var i = 0; i < result.length; i++) {
                        console.log(result[i]);





                        var tr = $("#temp_customer_row").clone();

                        tr.detach();
                        tr.addClass("searched");
                        tr.css("display","");

                        tr.attr("data-id",result[i].id);
                        tr.attr("id","");

                        tr.find(".name a").text(result[i].name);
                        var href=tr.find(".name a").attr("href").replace("X",result[i].id);
                        var temp= tr.find("#delete_form").attr("action").replace("X",result[i].id);

                        tr.find("#delete_form").attr("action",temp);
                        tr.find(".name a").attr("href",href);
                        for(var x=0;x<result[i].phones.length;x++){
                            tr.find(".phone").find("select").append('<option class="phones">'+ result[i].phones[x] +'</option>')
                        }

                        tr.find(".customer_link a").attr("href",result[i].facebook);
               
                        tr.find(".customer_link a span").html($(".temp_icons").find("."+result[i].customer_platform).clone());
                    
                       

                        tr.find(".governorate").text(result[i].governorate);
                        tr.find(".state").val(result[i].type);

                        for(var y=0;y<result[i].addresses.length;y++){

                            tr.find(".address select").append('<option class="address"> '+result[i].addresses[y]+' </option>')
                        }


                        table.append(tr);
                        t.row.add(tr).draw(false);


                        //     temp.parent().find("table").append("<tr><td>"+result[i].id+"</td><td>"+result[i].username+"</td><td>dsadasd</td><td>"+result[i].no_of_items+"</td><td>"+result[i].hour+"</td><td>"+result[i].delivery+"</td><td>"+result[i].customer_name+"</td><td>dsadasd</td></tr>");
                    }
                //    $("#example tbody").append(table.html());




                },
                error: function (data) {
                    alert('Error on updating, please try again later!');
                    return false;
                }
            })){}

        }




    });
    function search_in_html(val){
        var found=false;
        return found;
        if($("#example_filter #search_option").find("option:selected").val()==="phone") {
        $(".phones").each(function () {
            if ($(this).val().indexOf(val)!=-1) {
                $(this).parent().parent().parent().css("display", "");
                found=true;
               }
           })

        }
        if($("#example_filter #search_option").find("option:selected").val()==="name") {
            $(".name").each(function () {
                if ($(this).find("a").text().indexOf(val)!=-1) {
                    $(this).parent().css("display", "");
                    found=true;
                }

            })
        }

        return found;



    }
    $(document).on("click",".reset_search",function (e) {
            $("#load_more").css("display","");
            $(".searched").each(function(){
                t.rows( '.searched' ).remove().draw();
            });
            t.search("").draw();

            $(".customers_row").css("display","");
            
        

    });
    $(document).on("change","#example_filter #search_option",function () {
        $("#example_filter #search").attr("placeholder",$(this).find("option:selected").attr("data-holder"));
    });
    $(".add_another_phone").click(function () {
        var temp=$("#hidden_phone").clone();
        temp.css("display","");
        temp.attr("id","");

        // $("#phone").val($(this).text());
        $(".modal-body form .last ").before(temp);
    });
    $(document).on("click","#load_more",function () {
        $(".searched").remove();
        var index=$("#example .customers_row:last").attr("data-id");
        var url = $("#load_more_customers").val()+"/"+index;


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if ($.ajax({
            url: url,
            type: "get",
            async: false,

            success: function (result) {

                var table = $("<table></table>");
                for (var i = 0; i < result.length; i++) {
                    console.log(result[i]);





                    var tr = $("#temp_customer_row").clone();

                    tr.detach();
                    tr.attr("data-id",result[i].id);
                    tr.attr("id","");

                    tr.find(".name a").text(result[i].name);
                    var href=tr.find(".name a").attr("href").replace("X",result[i].id);
                    tr.find(".name a").attr("href",href);
                    for(var x=0;x<result[i].phones.length;x++){
                        tr.find(".phone").find("select").append('<option class="phones">'+ result[i].phones[x] +'</option>')
                    }

                    tr.find(".customer_link a").attr("href",result[i].facebook);
               
                    tr.find(".customer_link a span").html($(".temp_icons").find("."+result[i].customer_platform).clone());
                
                   

                    tr.find(".governorate").text(result[i].governorate);
                    tr.find(".state option[value="+result[i].type+"]").attr('selected','selected');;
                    console.log( tr.find(".state"));
                    for(var y=0;y<result[i].addresses.length;y++){

                        tr.find(".address select").append('<option class="address"> '+result[i].addresses[y]+' </option>')
                    }


                 //   table.append(tr);
                    t.row.add(tr).draw(false);


                    //     temp.parent().find("table").append("<tr><td>"+result[i].id+"</td><td>"+result[i].username+"</td><td>dsadasd</td><td>"+result[i].no_of_items+"</td><td>"+result[i].hour+"</td><td>"+result[i].delivery+"</td><td>"+result[i].customer_name+"</td><td>dsadasd</td></tr>");
                }
             //   $("#example tbody").append(table.html());



            },
            error: function (data) {
                alert('Error on updating, please try again later!');
                return false;
            }
        })){}


            })

    $(document).on("change",".state",function () {
        var $id = $(this).parent().parent().attr("data-id");
        var val=$(this).val();

        var obj={};
        obj["type"]=val;
        obj["_method"]="PUT";
        var bool=0;
        var $url=$("#customers_update").val()+"/"+$id;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if ($.ajax({
            url: $url,
            type: "post",
            data:obj,
            async: false,

            success: function (result) {
                alert("تم تغيير حالة العميل")

            },
            error: function (data) {
                alert('Error on updating, please try again later!');
                return false;
            }
        }))
        $(this).parent().find("span").text(bool);


    });
    $(document).on("click",".delete",function(){
        var temp=$(this);
        $("#alert_modal_button").click();


        $(".confirm").click(function(){

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
                if (input_condition_array[i][j]==="wrong_length_input"){wrong_length_input(input_array[i])}
                if (input_condition_array[i][j]==="arabic_input"){arabic_input(input_array[i])}
   
   
            }
   
   
   
        }
        return $bool;
   
   
    }
    $(".submit_button").click(function(){
        if( validate(["all"],[["null_input"]])){
          $(".submit_input").click();
        }
        else{
            alert("من فضلك راجع الخانات باللون الاحمر");

        }

    })
   
    $(document).on("change","#customer_platform",function () {
        $("#customer_link").attr("placeholder",$(this).find("option:selected").attr("data-holder"));
    });

</script>
<script src="{{asset("js/popper.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>

</body>
</html>
