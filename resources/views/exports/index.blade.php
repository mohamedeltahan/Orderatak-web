<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{csrf_token()}}">

    <link rel="stylesheet" href="{{asset("fontawesome-free-5.11.2-web/css/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" href="{{asset("css/semantic.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/dataTables.semanticui.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/bootstrap.css")}}">
    <link rel="stylesheet" href="{{asset("css/exporter_recipts/exporter_reciepts.css")}}">

    <title>فواتير الشراء</title>
    <style>
        .exporter-info {
            width: 100%;
            text-align: center;
            color: #000;
            text-transform: capitalize;
            font-size: 40px;
            margin: 50px 0px;
        }
        .exporter-info .exporter-name {
            font-weight: bold;
        }

        .hidden_order{
            display: none;
        }
        body{
            background: #f7f7f7;
            font-size: 17px;



        }
        #example tr:hover td {
            background-color: #ffff99;
        }
        
        .maintable tr:hover .hov {
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
            width: 60%;
            padding: 10px;
            border: 1px solid #a1a0a0;

        }
        
        button{
            direction: rtl;
            font-weight: 500;
            font-size: 20px;

        }
        button:hover{
            background-color: powderblue;
        }

        .headers{
            background-color: white;
            margin-right: -6px;
            background: gainsboro;
            border-color: #556080;


        }
        .clicked{
            background-color:powderblue;

        }
        .none{
            display:none;
        }
        .block{
            direction: ltr;
        }
    </style>
</head>
<body>
<button style="display: none" id="modal_button" data-target='#exampleModalCenter' data-toggle='modal'></button>
<button style="display: none" id="alert_modal_button" data-target='#alert_modal' data-toggle='modal'></button>
<div style="display: none">{{$user=\Illuminate\Support\Facades\Auth::user()}}</div>
<div class="wrapper d-flex align-items-stretch" dir="rtl">
    <div class="hidden_phone form-group row" style="width: 100%; display: none" id="hidden_phone">
        <label class="sr-only" >Username</label>
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text" style="font-weight: 700">رقم التليفون</div>
            </div>
            <input  name="phone[]" type="text" class="form-control" placeholder="ادخل رقم العميل">
        </div>
    </div>
    <div class="hidden_address form-group row" style="width: 100%;display: none" id="hidden_address">
        <label class="sr-only" >Username</label>
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text" style="font-weight: 700">العنوان</div>
            </div>
            <input name="address[]" id="address" type="text" class="form-control"  placeholder="ادخل عنوان العميل">
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
            <li class="breadcrumb-item" ><a href="{{route("exports.index")}}"> فواتير شراء </a></li>
    @endsection
    @include("sidebars.navbar")
    <!---end of navbar !-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->

        <div class="exporters-main-container col-12" style="">
            <div class="exports_cases" style="width: 80%; display: inline-flex; margin-right: 33%" >
                <div>
                    <button id='search_tag' class="headers modal_tag" data-table="permissions" style="border-top-right-radius: 22px;border-bottom-right-radius: 22px; height: 50px;width: 225px; color: steelblue;">بحث عن فاتورة<i style="margin-right: 6px;" class="fas fa-search fa-2x"></i></button>
                    <button id='excel_tag' class="headers modal_tag" data-table="items" style="border-top-left-radius: 22px;border-bottom-left-radius: 22px;height: 50px;width: 225px; color: forestgreen;">تصدير لاكسيل<i style="margin-right: 6px;" class="fas fa-file-csv fa-2x"></i></button></div>
            </div>
            <div class="exporters-container col-12" style="margin-top: 5%" >
                <div class="search-container search_tag tags none"  style=" width: 100%; margin-bottom: 45px !important; ">





                    <form  id="searchbox" style="width: 68%; margin-right: 23%" dir="ltr">
                        <div id="example_filter" class="" style="display: flex;">
                            <button type="button" class="search_button" id="search_button" style="width: 17%;margin-left: 18%;">بحث </button>
                                        <input type="text" id="search" style="width: 44%;margin-left: 1%;" placeholder="ابحث ب ....">
                            <select id="search_option" style=" width: 24%; margin-left: 2%;">
                                <option data-holder="ابحث ب ....." value="none">ابحث ب</option>
                                <option data-holder="ادخل رقم الفاتورة" name="option" value="order_id">رقم الفاتورة</option>
                             </select>
                
                        </div>

                    </form>
                </div>
                <div class="inp-cont filter_tag tags none" style="width: 92%; margin-right: 78px; margin-left: -10%;"  >
                    <div class="input-group mb-2">
                        <div class="input-group-prepend" style="    direction: ltr;width: 43%;">
                            <div class="input-group-text" style="width: 24%;padding-left: 7%;font-size: 21px;font-weight: normal;">فواتير </div>
                        </div>
                        <select name="type" id="select"  style="width: 23%;height: 54px;">

                            <option value="{{route("orders.index")}}" >الكل</option>
                            <option value="{{route("orders_with_state","انتظار")}}">انتظار</option>
                            <option value="{{route("orders_with_state","لم يتم التاكيد")}}">لم يتم التاكيد</option>


                            <option value="{{route("orders_with_state","تم التاكيد")}}"> تم التاكيد</option>
                            <option value="{{route("orders_with_state","تم الشحن")}}">تم الشحن </option>
                            <option value="{{route("orders_with_state","مرتجع جزئي")}}"> مرتجع جزئي</option>

                            <option value="{{route("orders_with_state","مرتجع")}}"> مرتجع</option>

                        </select>                        </div>


                </div>
                @if($has_id==0)
                    <form method="get" action="{{route("exports.excel")}}" id="excel_div" class="excel_tag tags none"  >
                        <div >
                            <div class="block" style=" margin-left: 64%; position: absolute; bottom: 4px;width: 30% ">
                                <input name="start" placeholder="تاريخ البداية"  type="text" onfocus="(this.type='date')" >
                                <label>من</label>


                            </div>
                            <div class="block"   style=" margin-left: 28%; position: absolute; bottom: 4px;width: 30%;left: 0">

                                <input name="end" placeholder="تاريخ النهاية"  type="text" onfocus="(this.type='date')">
                                <label>الي</label>
                            </div>
                            <button style=" margin-left: 9%;background: none;border: none;"><i class="fas fa-file-excel fa-2x" style="color: green;"></i></button>
                        </div>
                    </form>
                @endif
            </div>

        @if($has_id==1)
                <div class="exporter-info">
        <span><span class="exporter-name" data-name="{{$exporter->name}}">
        </span> فواتير</span>
                    {{$exporter->name}}
                </div>
                @endif
            <div class="exportscontainer">
                <div class="orders">

                    @if ($errors->any())
                        <div class="error">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="error-text">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @for($i=0; $i<$size-1; $i++)
                        <div id="setTempValue" style="display: none;">{{$exports[$i]->setTemp($temp)}}</div>
                        @if($exports[$i]->startOfMonth($temp, $tempMonthYear))
                    <div class="order">
                        <div class="dateheader">
                            <span>{{$temp}}</span>
                        </div>
                        <div style="display: none;">{{$exports[$i]->setTempMonthYear($tempMonthYear, $temp)}}</div>
                        <div class="months">
                            @endif

                            @if($exports[$i]->startOfDay($tempDay))
                                <div style="display: none;">{{$exports[$i]->setTempDay($tempDay)}}</div>
                            <div class="month co-2">
                                <div class="ordersdate"><span>{{$exports[$i]->getDate()}}</span></div>
                                <div class="orderstable toggeltable">
                                    <table class="maintable" dir="ltr">
                                        <tr class="firstrow">
                                            @if(\Illuminate\Support\Facades\Auth::user()->canDo("orders.destroy"))

                                            <td class="co-1">حذف</td>
                                            @endif
                                            <td class="co-1">الحالة</td>
                                            <td class="co-1">عدد المنتجات</td>
                                            <td class="co-2"> الخصم</td>
                                            <td class="co-1">اجمالي</td>
                                            <td class="co-2">التاريخ</td>
                                            <td class="co-1">المورد</td>
                                            <td class="co-1">رقم الفاتورة</td>
                                        </tr>
                                        @endif
                                        <tr class="orderdetails noborderright">
                                            @if(\Illuminate\Support\Facades\Auth::user()->canDo("orders.destroy"))

                                            <td class="co-1 hov ">

                                                <i class="fas fa-trash-alt delete"></i>
                                            <form style="display: none" method="post" action="{{route("exports.destroy",$exports[$i]->id)}}">
                                            @csrf
                                                @method("DELETE")
                                                <button type="submit" class="delete_button"></button>
                                            </form>
                                            </td>
                                            @endif

                                            <td data-id="{{$exports[$i]->id}}" class=" hov co-1 @if($exports[$i]->rest()>0)payed-details @endif" >@if($exports[$i]->rest()>0)   غير مسدد  <span class="unpaid" style="display: none">{{$exports[$i]->rest()}}</span> @else مسدد @endif </td>
                                            <td class="co-1 itemsinorder hov">{{$exports[$i]->exports_items()->count()}}</td>
                                            <td class="co-2 hov">{{$exports[$i]->discount}}%</td>
                                            <td class="orderprice co-1 hov">{{$exports[$i]->total_price_after_discount}}</td>
                                            <td class="co-2 hov">{{$exports[$i]->created_at}}</td>
                                            <td class="co-1 hov">{{$exports[$i]->exporter->name}}</td>


                                            <td class="co-1 number hov" >{{$exports[$i]->id}}</td>
                                          <td>  <div class="TotalItemsInOrderPopupContainer">
                                                <div class="closepopup">
                                                    <i class="fas fa-times"></i>
                                                </div>
                                                <div class="TotalItemsInOrderPopup">
                                                    <table id="example" dir="rtl">
                                                        <tr class="headrow" style="background-color: #5C71A3">

                                                            <td class="co-3">اسم المنتج</td>
                                                            <td class="co-3">كود</td>
                                                            <td class="co-2">الكمية</td>
                                                            <td class="co-3">مقاس</td>
                                                            <td class="co-1">حذف</td>
                                                        </tr>
                                                        <tr>
                                                        @foreach($exports[$i]->exports_items as $item)

                                                                <td class="co-3">{{$item->name->name}}</td>
                                                                <td class="co-3">{{$item->name->code}}</td>

                                                                <td class="co-2">{{$item->quantity}}</td>
                                                                <td class="co-3">{{$item->size}}</td>
                                                                <td class="co-1 "><i class="fas fa-trash-alt delete_item"></i>
                                                                    <form style="display: none" method="post" action="{{route("delete_item",$item->id)}}">
                                                                        @csrf
                                                                        @method("DELETE")
                                                                        <input name="id" value="{{$exports[$i]->id}}">
                                                                        <button type="submit" class="delete_button"></button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                          </td>
                                        </tr>
                                        @if( ($exports[$i]->endOfDay($exports[$i+1]) || ($i == $size-2)) || ($exports[$i]->sameDay($exports[$i+1]) && $exports[$i]->differentMonth($exports[$i+1]))  )

                                    </table>
                                </div>

                                <div class="bottomspace"></div>
                                <div class="monthfooter">
                                    <span dir="rtl"><span>اجمالي اليوم : </span><span class="num"></span> <span class="sign">     {{\Illuminate\Support\Facades\Auth::user()->currency}}   </span></span>
                                </div>
                            </div>
                            @endif
                            @if($exports[$i]->differentMonth($exports[$i+1]) || $i==$size-2)
                        </div>
                        <div class="orders-of-day">
                        </div>
                        <div class="totalmonth">
                            <span> :اجمالي الشهر  1250$</span>
                        </div>
                    </div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="    border: 4px solid gainsboro;  border-radius: 2.24rem;">
                    <div class="modal-header" dir="ltr">
                        <h4 class="modal-title" id="exampleModalLongTitle" style="margin-left: 37%;margin-top: 6%"><div dir="ltr" class="title">
                                <span> غير مسدد</span>
                                <span class="unpaid_val">0</span>

                                <span> {{\Illuminate\Support\Facades\Auth::user()->currency}} </span>

                            </div></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 30px">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height: auto">
                        <form method="post" action="{{route("exporter_transactions.store")}}" dir="ltr">
                            @csrf

                            <div class="input-group mb-3">
                                <input name="receipt_id" type="number" class="form-control all " placeholder="اادخل رقم الفاتورة" aria-label="Username" aria-describedby="basic-addon1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">رقم الفاتورة</span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input name="paid" type="text" class="form-control all " placeholder="ادخل المبلغ المدفوع" aria-label="Username" aria-describedby="basic-addon1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">المبلغ المدفوع</span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input name="date" type="date" class="form-control all " placeholder="تاريخ الفاتورة" aria-describedby="basic-addon1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">التاريخ</span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input name="details" type="text" class="form-control  all" placeholder="ملاحظات علي الفاتورة" aria-describedby="basic-addon1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">التفاصيل</span>
                                </div>
                            </div>
                            <input class="all" style="display: none" name="export_id" id="export_id">



                        <div class="modal-footer" dir="rtl">
                            <input type="submit" style="display: none" id="confirm_submit">
                            <button  type="button" class="btn btn-danger " data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
                            <button id="submit" type="button" class="btn btn-primary" >اضافة</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--End body container-->

    <div class="modal fade" id="alert_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="    border: 4px solid gainsboro;  border-radius: 2.24rem;">
                <div class="modal-header" dir="ltr">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 30px">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="height: auto;    font-weight: bold;text-align: center;padding: 38px;">
                    هل تريد حذف الفاتورة ؟
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
<!-- remove exporters popup model -->

<!--  pay transaction popup -->



<script  src="{{asset("js/jquery-3.4.1.min.js")}}"></script>
<script src="{{asset("js/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("js/dataTables.semanticui.min.js")}}"></script>
<script src="{{asset("js/semantic.min.js")}}"></script>


<script type="module" src="{{asset("js/expo-reciepts.js")}}"></script>
<script src="{{asset("js/popper.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>
<script>
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
    $("#submit").click(function () {
        if(validate(["all"],[["null_input"]])){
            $("#confirm_submit").click();
        }
    })
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
    $("#select").on('change',function() {
        var href = $("#select option:selected").val();

        $("#a").attr("href",href);
        $("#span_to_click").click();



    })

    $(document).on("click",".modal_tag",function () {
        if( !$("."+$(this).attr("id")).hasClass("none")){
            $(".tags").addClass("none");
            $(".modal_tag").removeClass("clicked");
            return;
        }
        $(".tags").addClass("none");

        $(".modal_tag").removeClass("clicked");
        $(this).addClass("clicked");
        $("."+$(this).attr("id")).removeClass("none");





    });
    $(document).on("change","#example_filter #search_option",function () {
        $("#example_filter #search").attr("placeholder",$(this).find("option:selected").attr("data-holder"));
    });
    $("#example .orderdetails").mouseover(function () {

        $(".head").removeClass("head");

        $(this).find(".tail").removeClass("tail");
    });
    $(".payed-details").click(function(){

        var $val=$(this).find(".unpaid").text();
        $(".unpaid_val").text($val)
        $("#export_id").val($(this).attr("data-id"));
        $("#modal_button").click();
    });
</script>
</body>
</html>
