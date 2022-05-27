<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{csrf_token()}}">

    <link rel="stylesheet" href="{{asset("fontawesome-free-5.11.2-web/css/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" href="{{asset("css/semantic.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/dataTables.semanticui.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/bootstrap.css")}}">
    <link rel="stylesheet" href="{{asset("css/order.css")}}">
    <title>اوردرات</title>

    <style>

        .results tr[visible='false'],
        .no-result{
            display:none;
        }

        .results tr[visible='true']{
            display:table-row;
        }

        .counter{
            padding:8px;
            color:#ccc;
        }
        table {
            width:100%;
            font-weight: 700;
            text-align: center;
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

    </style>

</head>
<body>

<div id="hiddeninputs" style="display: none;" class="inputdiv">

    <input type="number" name="price[]" class="orderprice">
    <input type="number" name="quantity[]" class="quantity">
    <input type="text" name="items_id[]" class="name">



</div>
<div id="temp-order">
    <div class="order hide">
        <div class="number co-1">1</div>
        <div class="name co-5"><span></span></div>
        <div class="countity co-2" dir="ltr">
           
            <input class="input_quantity" type="text" value="1" style="width: 57px; direction:ltr;">
         
        </div>
        <div class="price co-3">
            <span><span class="mainprice"></span><span class="sign">{{\Illuminate\Support\Facades\Auth::user()->currency}}</span></span>
        </div>
        <div class="delete co-1" id="s" onclick="deleteorder(this.id)">
            <i class="fas fa-trash-alt"></i>
        </div>
    </div>
</div><div class="wrapper d-flex align-items-stretch" dir="rtl">
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
                <li class="breadcrumb-item" ><a href="{{route("orders.index")}}"> الاوردرات </a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route("orders.create")}}"> اوردر جديد </a></li>
        @endsection
        @include("sidebars.navbar")
        <div class="store_nav" >
            <ul class="nav nav-tabs" id="myTab" role="tablist" style="width:50%; margin-right: 42%">
                @foreach ($all_items as $k=>$v)
                <li class="nav-item">
                  <a class="nav-link  my_nav_tab" data-toggle="tab" href="{{$k}}" role="tab" aria-controls="home" aria-selected="true">{{App\Store::find($k)->name}}</a>
                </li>
                @endforeach
              </ul>
        </div>
        <!---end of navbar !-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <div class="settingcontainer">
                @foreach ($all_items as $key=>$items)
                <div class="items_container_wraper d-none" id={{$key}}>
                <div class="itemscontainer co-7">
    
                    <div class="search">
                        <form action="" id="searchbox">
                            <input dir="rtl" type="search" placeholder="بحث">
                        </form>
                    </div>
                    <div class="productcategories" id="productcontainer">
    
                            <div id="accordion">
                                @foreach($items as $key=>$value)
    
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#item_{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                                {{App\Name::find($key)->name}}
                                            </button>
                                        </h5>
                                    </div>
    
    
                                    <div id="item_{{$key}}" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div id="accordion1">
                                                @foreach($value as $color=>$items)
    
                                                <div class="card">
                                                    <div class="card-header" id="headingOne">
                                                        <h5 class="mb-0">
                                                            <button class="btn btn-link" data-toggle="collapse" data-target="#color_{{$color}}" aria-expanded="true" aria-controls="collapseOne">
                                                                 {{App\Name::find($color)->color}}
                                                             </button>
                                                        </h5>
                                                    </div>
    
                                                    <div id="color_{{$color}}" class="collapse " aria-labelledby="headingOne" data-parent="">
                                                        <div class="card-body">
                                                            <div class="form-group pull-right">
                                                                <input type="text" class="search form-control" placeholder="هل تبحث عن مقاس محدد ؟">
                                                            </div>
                                                            <span class="counter pull-right"></span>
                                                            <table class="table table-hover table-bordered results" style="margin-top: -10px;">
                                                                <thead>
                                                                <tr style="background: lightblue;">
                                                                    <th>#</th>
                                                                    <th class="col-md-5 col-xs-5">صنف </th>
                                                                    <th class="col-md-5 col-xs-5">لون </th>
    
                                                                    <th class="col-md-5 col-xs-5">كود</th>
                                                                    <th class="col-md-4 col-xs-4">مقاس</th>
                                                                    <th class="col-md-3 col-xs-3">سعر</th>
                                                                </tr>
                                                                <tr class="warning no-result">
                                                                    <td colspan="4"><i class="fa fa-warning"></i> المقاس ليس متوفر !</td>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($items as $item)
    
                                                                    <tr class="iteem {{$item->name->name}}" id="{{$item->id}}">
                                                                        <td><a  data-toggle="popover" data-placement="left" data-trigger="hover" title="{{$item->quantity}}" data-content=" ">الكمية المتبقية</a>
                                                                        </td>
                                                                        <td>{{$item->name->name}}</td>
                                                                        <td>{{$item->name->color}}</td>
                                                                        <td style="display: none">
                                                                            <span class="ordercounter">1</span>
                                                                            <span style="margin-top: 10px;"  class="productprice"><span class="sign"></span> <span dir="" class="proprice"><span class="real_price" style="display: none">@if($item->quantity==0)0 @else{{$item->price()}} @endif</span>{{$item->price()}}  </span><span>: سعر</span></span>
    
                                                                            <span class="amount">{{$item->quantity}}</span></td>
                                                                        <td class="productname" data-id="{{$item->id}}">{{$item->name->code}}</td>
                                                                        <td class="size">{{$item->size}}</td>
                                                                        <td>{{$item->selling_price}}<span>{{\Illuminate\Support\Facades\Auth::user()->currency}}</span>
    
    
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
    
    
                                                @endforeach
                                            </div>
    
    
    
                                        </div>
                                    </div>
                                </div>
                                @endforeach
    
                            </div>
    
                    </div>
    
                </div>
                </div>
            @endforeach
                <!--=================================-->
                <!--end items-->
                <!--=================================-->
                <!--start dashboard-->
            
                <div class="setting co-5">
                    <div class="clientinfocontainer">
                        <div class="clientinfo">
                            <div style="margin-bottom: 14px; text-align: right; border-bottom: 6px solid; padding: 7px; color:darkcyan; font-weight: 600; ">
                                تفاصيل العميل
                            </div>
                            <form autocomplete="off" id="receiptclientinfoform" >
                                <input  data-alertmessage="من فضلك ادخل رقم هاتف صحيح" value="{{$customer->phones()->first()->phone}}" type="text" placeholder="رقم العميل" data-length="11" class="defv all paste" id="clientnumber">
                            
                                <input  data-alertmessage="من فضلك ادخل اسم العميل" value="{{$customer->name}}" class="all" type="text" placeholder="اسم العمبل" id="clientname" name="clientname" autocomplete="off">
                                <input  data-alertmessage="من فضلك ادخل عنوان العميل" value="{{$order->receiving_address}}" type="text" placeholder="عنوان العميل" id="client_address"  class="deff all" autocomplete="off"><br>
                                
                                
    
                                <select   type="text" id="district" placeholder="Client Adress" class="rdev all" style="font-size:17px; margin-bottom: 17px;float: left;margin-left: 0%">
                                    <option value="0" data-cost="0">اخنر منطفة الشحن</option>
                                     @foreach($districts as $district)
                                     <option @if($order->district_id==$district->id) selected @endif value="{{$district->id}}" data-name="{{$district->name}}">{{$district->name}}</option>
                                     @endforeach
     
                                 </select>
                                 <input type="text" id="governorate"  value="{{$customer->governorate}}" class="rdev all" style="font-size:17px; margin-bottom: 17px">
                                    
                                    
                                 <input class="defv" type="text" value="{{$customer->customer_link}}" placeholder="لينك العميل" id="customer_link" name="customer_link">
    
                                 <input  type="text" name="customer_platform" id="customer_platform" value="{{$customer->customer_platform}}"  class=" rdev all" style="font-size:17px;">

                                 
                                <input type="text" placeholder="ملاحظة"  class="rdev  note"><br>
    
    
                            </form>
                        </div>
                    
    
                        <div  style="display:none; margin-bottom: 14px; padding-top: 175px; text-align: right; border-bottom: 6px solid; padding: 7px; color:darkcyan; font-weight: 600; ">
                            اصناف الاوردر
                        </div>
                        <div class="orderscontainer" id="ordercontainer">
                            <table style="width: 100%; direction: ltr"><tr style="width: 100%; background-color: lightseagreen"><th style="width: 2%" >مقاس</th><th style="width: 23%; text-align:center" >صنف</th> <th style="width: 25%" >كمية</th > <th style="width: 9%">سعر</th> <th style="width: 10%; "></th></tr></table>
                            <form style="display: none" id="hiddenform" method="post" action="{{route("edit_order",$order->id)}}">
                                @csrf
                                @foreach($order_items as $order_item)
                                <div id="order-{{$order_item->main_item_id}}" style="display: none;" class="inputdiv">

                                    <input type="number" value="{{$order_item->selling_price}}" name="price[]" class="orderprice">
                                    <input type="number" value="{{$order_item->quantity}}" name="quantity[]" class="quantity">
                                    <input type="text" value="{{$order_item->main_item_id}}" name="items_id[]" class="name">



                                </div>

                             @endforeach
                                <input name="total_price_after_discount" class="total_price_after_discount">
                                <input name="discount" class="discount">
                                <input type="date" name="receiving_date" class="receiving_date">
                                <textarea name="details" class="details">
                                </textarea>
                                <input name="customer_id" id="customer_id" value="0">
                                <input class="client_address" name="address">
                                <input class="client_name" name="name">
                                <input class="client_phone" name="phone">
                                <input class="client_governorate" name="governorate">
                                <input class="client_link" name="customer_link">
                                <input class="customer_platform" name="customer_platform">

                                <input class="district_id" name="district_id">
    
    
                                <button type="submit" id="submithiddenform"></button>
                            </form>
                            @foreach($order_items as $order_item)
                            <div id="temp-order">
                                <div class="order " id="{{$order_item->main_item_id}}">
                                    <div class="number co-1">{{$order_item->size}}</div>
                                    <div class="name co-5"><span></span>{{$order_item->name->color.":".$order_item->name->code}}</div>
                                    <div class="countity co-2" >
           
                                        <input class="input_quantity" type="text" value="{{$order_item->quantity}}" style="width: 57px; direction:ltr;">
                                     
                                    </div>
                                    <div class="price co-3">
                                        <span><span class="mainprice">{{$order_item->selling_price}}</span><span class="sign">ج.م</span></span>
                                    </div>
                                    <div  class="delete co-1" id="delete-{{$order_item->main_item_id}}" onclick="deleteorder(this.id)">
                                        <i class="fas fa-trash-alt"></i>
                                    </div>
                                </div>
                            </div>
                                @endforeach
                        
    
                        </div>
                        
                        <div class="receipt" style="font-size:20px;">
                            <div style=" text-align: right; border-bottom: 6px solid; padding: 7px; color:darkcyan; font-weight: 600; ">
                                اجمالي الاوردر
                            </div>
    
                            <input    type="number" placeholder="خصم"  class="defv discount" id="discount">
                            <input   placeholder="تاريخ التسليم" type="text" class="date" onfocus="(this.type='date')" id="receiving_date" name="receiving_date">
                            <div class="line">
                            </div>
                            <div class="line" style="margin-bottom: 8px;">
                                <span id="discount_val" class="span2"> اجمالي الخصم : {{$order->discount}} {{\Illuminate\Support\Facades\Auth::user()->currency}}</span>
                                <span style="margin-left: 25px" class="span1">عدد : <span class="numberOfOrders">{{$order->no_of_items()}}</span></span>
    
                            </div>
                            <div class="line receipttotalprice">
                                <span dir="ltr" class="span2" style="  border-bottom:solid 1px #cfcfcf;"><span> مصاريف الشحن : </span> <span class="district_price"> {{$order->delivery}} </span> <span> {{\Illuminate\Support\Facades\Auth::user()->currency}} </span></span> <br><br>
                                <button id="sumbitreciepts" style="float: left">تاكيد</button>
    
                                <span style=" margin-left: 25px; float: right;  padding: 4px;  background: lavender; border: 1px solid; border-radius: 0.24rem;" class="span1"> <span id=""> اجمالي : </span> <span id="total_price_after_discount" class="recieptsprice"> {{$order->total_price_after_discount}} </span> {{\Illuminate\Support\Facades\Auth::user()->currency}} <span></span></span>
                              
                            </div>
                        </div>
                    </div>
                </div>
              
                <!--end dashboard-->
                <!--=================================-->
            </div>
            <div class="modal fade" id="alert_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  >
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" style="    border: 4px solid gainsboro;  border-radius: 2.24rem;">
                        <div class="modal-header" dir="ltr">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 30px">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="height: auto;    font-weight: bold;text-align: center;">
                            <div class="input-group mb-3" dir="ltr">
                    <textarea dir="rtl" type="number"  id="textarea" name="reason" class="form-control" placeholder="ادخل ملاحظة اذا وجد" aria-describedby="basic-addon1">
                    </textarea>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"> ملاحظة علي الطلب</span>
                                </div>
                            </div>
                        </div>
    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger close_alert_modal" data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
                            <button type="button" class="btn btn-primary confirm" >حفظ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End body container-->
    </div>
    
    
    
    <script  src="{{asset("js/jquery-3.4.1.min.js")}}"></script>
    <script src="{{asset("js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("js/dataTables.semanticui.min.js")}}"></script>
    <script src="{{asset("js/semantic.min.js")}}"></script>
    
    <script type="text/javascript" src="{{asset("js/script.js")}}"></script>
    
    <script src="{{asset("js/popper.js")}}"></script>
    <script src="{{asset("js/bootstrap.min.js")}}"></script>
    <script>
        $(document).ready(function() {
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
             $(".my_nav_tab").first().click();
            $(".search").keyup(function (e) {
                    if(e.key==="Backspace"){
                        var temp=$(this).parent().parent();
                        temp.find(".iteem").removeClass("no-result");
                                    return;
                        }
    
                var value=$(this).val();
                var temp=$(this).parent().parent();
                   temp.find(".size").each(function () {
                       if($(this).text().indexOf(value)===-1){
                           $(this).parent().addClass("no-result");
                       }
                   });
    
    
    
    
            });
        });
    
        $(".my_nav_tab").click(function(){
            $(".items_container_wraper").addClass("d-none");
            $("#"+$(this).attr("href")).removeClass("d-none");
        })
        $(function () {
            $('[data-toggle="popover"]').popover({ trigger: 'hover'})
        });
    
        $(document).on("change","#customer_platform",function () {
            $("#customer_link").attr("placeholder",$(this).find("option:selected").attr("data-holder"));
        });
    </script>
    
    </body>
    </html>
    