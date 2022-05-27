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
    <title>اوردرات</title>
    <style>
      
       .nav-link{
           font-size: 21px;
       }

        .hidden_order{
            display: none;
        }

        body{
            background: #f7f7f7;
            font-size: 17px;



        }
        #example tr:hover .hovered {
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
         .row{
               padding: 6px;

         }
         #mytable tr:hover .nested_hovered{
            background-color: #ffff99;
         }

    </style>
</head>
<body>
    
<button  id="order_modal_button" data-target='#order_modal' data-toggle='modal' style='display: none'></button>

<button style="display: none" id="alert_modal_button" data-target='#alert_modal' data-toggle='modal'></button>
<button id='modal_button' data-target='#exampleModalCenter' data-toggle='modal' class='btn btn-primary' style='display: none'></button>
<button  id="restore_order_modal_button" data-target='#restore_order' data-toggle='modal' style='display: none'></button>
@if(isset($ship_id))
    <input class="url" value="{{route("get_for_ajax")}}?ship_id={{$ship_id}}" style="display: none">

@else
    <input class="url" value="{{route("get_for_ajax")}}" style="display: none">

@endif


<input id="order_details" value="{{route("order_details","")}}" style="display: none">

<input id="search_url" value="{{route("Search")}}" style="display: none">
<input style="display:none;" id="orders_update" value="{{route("orders.update","")}}">

<input class="url2" value="{{route("get_order_items","")}}" style="display: none">
<input style="display: none;" class="restore_link" value="{{route("restore_item","")}}">
<a href="" style="display: none" id="a">

<button style="display: none;" id="span_to_click"></button></a>
<div style="display: none">{{$user=\Illuminate\Support\Facades\Auth::user()}}</div>
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
        <!---start of navbar !-->
        @section('content')
            <li class="breadcrumb-item" ><a href="{{route("home")}}"> الصفحة الرئيسية </a></li>
            <li class="breadcrumb-item active" aria-current="page" ><a href="{{route("orders.index")}}"> فواتير بيع </a></li>
    @if(isset($ship_id))
                <li class="breadcrumb-item" ><a href="">  @if(\App\Ship::find($ship_id)->type=="company")اوردات شركة شحن {{\App\Ship::find($ship_id)->name}} @else اوردات مندوب شحن {{\App\Ship::find($ship_id)->name}} @endif     </a></li>
        @endif
    @endsection
    @include("sidebars.navbar")
    <!---end of navbar !-->
        
            <div class="exporters-main-container col-12" style="">
                <div class="exports_cases" style="width: 80%; margin-top: 55px; display: inline-flex; margin-right: 23%" >
                    <div><button id='filter_tag' class="headers modal_tag" data-table="users" style="border-top-right-radius: 22px;border-bottom-right-radius: 22px; height: 50px;width: 225px; color: steelblue;">فلترة النتائج<i style="margin-right: 6px;" class="fas fa-filter fa-2x"></i></button>
                        <button id='search_tag' class="headers modal_tag" data-table="permissions" style="height: 50px;width: 225px; color: crimson; /*border-top-left-radius: 6px;border-bottom-left-radius: 6px;border-top-right-radius: 6px;border-bottom-right-radius: 6px;*/">بحث عن فاتورة<i style="margin-right: 6px;" class="fas fa-search fa-2x"></i></button>
                        <button id='excel_tag' class="headers modal_tag" data-table="items" style="border-top-left-radius: 22px;border-bottom-left-radius: 22px;height: 50px;width: 225px; color: forestgreen;">تصدير لاكسيل<i style="margin-right: 6px;" class="fas fa-file-csv fa-2x"></i></button></div>
                </div>
                <div class="exporters-container col-12" style="margin-top: 5%" >
                    <div class="search-container search_tag tags none"  style=" width: 100%; margin-bottom: 45px !important; ">



                        @if ($errors->any())
                            <div class="error">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="error-text">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form  id="searchbox" style="width: 68%; margin-right: 23%" dir="ltr">
                            <div id="example_filter" class="" style="display: flex;">
                                <button type="button" class="search_button" id="search_button" style="width: 17%;margin-left: 18%;">بحث </button>
                                <select id="search_option" style=" width: 24%; margin-left: 2%;">
                                    <option data-holder="ابحث ب ....." value="none">ابحث ب</option>
                                    <option data-holder="ادخل رقم الفاتورة" name="option" value="order_id">رقم الفاتورة</option>
                                    <option data-holder="ادخل رقم البوليصة"  name="option" value="policy_id">رقم البوليصة</option> </select>
                                <input type="text" id="search" style="width: 44%;margin-left: 1%;" placeholder="ابحث ب ....">
                            </div>

                        </form>
                    </div>
                    <div class="inp-cont filter_tag tags none" style="width: 92%; margin-right: 78px; margin-left: -10%;"  >
                        <div class="input-group mb-2">
                            <div class="input-group-prepend" style="    direction: ltr;width: 43%;">
                                <div class="input-group-text" style="width: 24%;padding-left: 7%;font-size: 21px;font-weight: normal;">فواتير </div>
                            </div>
                            <select name="type" id="select"  style="width: 23%;height: 54px;">
                                @if(isset($ship_id))

                                    <option value="{{route("ship_orders",$ship_id)}}" >الكل</option>
                                    <option value="{{route("orders_with_state","انتظار")}}?ship_id={{$ship_id}}">انتظار</option>
                                    <option value="{{route("orders_with_state","لم يتم التاكيد")}}?ship_id={{$ship_id}}">لم يتم التاكيد</option>
                                    <option value="{{route("orders_with_state","تم التاكيد")}}?ship_id={{$ship_id}}"> تم التاكيد</option>
                                    <option value="{{route("orders_with_state","تم التسليم لشركة الشحن")}}?ship_id={{$ship_id}}">تم التسليم لشركة الشحن</option>

                                    <option value="{{route("orders_with_state","تم الشحن")}}?ship_id={{$ship_id}}">تم الشحن </option>
                                    <option value="{{route("orders_with_state","مرتجع جزئي")}}?ship_id={{$ship_id}}"> مرتجع جزئي</option>

                                    <option value="{{route("orders_with_state","مرتجع")}}?ship_id={{$ship_id}}"> مرتجع</option>
                                @else

                                    <option value="{{route("orders.index")}}" >الكل</option>
                                    <option value="{{route("orders_with_state","انتظار")}}">انتظار</option>
                                    <option value="{{route("orders_with_state","لم يتم التاكيد")}}">لم يتم التاكيد</option>


                                    <option value="{{route("orders_with_state","تم التاكيد")}}"> تم التاكيد</option>
                                    <option value="{{route("orders_with_state","تم التسليم لشركة الشحن")}}">تم التسليم لشركة الشحن</option>

                                    <option value="{{route("orders_with_state","تم الشحن")}}">تم الشحن </option>
                                    <option value="{{route("orders_with_state","مرتجع جزئي")}}"> مرتجع جزئي</option>

                                    <option value="{{route("orders_with_state","مرتجع")}}"> مرتجع</option>
                                @endif


                            </select>                        </div>


                    </div>
                    @if($has_id==0)
                    <form method="get" action="{{route("orders.excel")}}" id="excel_div" class="excel_tag tags none "  >
                        <div >
                            <div class="block" style=" margin-right: -100px; position: absolute; bottom: 4px;width: 30% ">
                                <input style="height: 40px" name="start" placeholder="تاريخ البداية"  type="text" onfocus="(this.type='date')" >
                                <label>من</label>


                            </div>
                            <div class="block"   style=" margin-left: 54%; position: absolute; bottom: 4px;width: 30%;left: 0">

                                <input style="height: 40px;" name="end" placeholder="تاريخ النهاية"  type="text" onfocus="(this.type='date')">
                                <label>الي</label>
                            </div>
                            <div class="block"   style=" margin-left: 18%; position: absolute; bottom: 4px;width: 30%;left: 0">
                                <select name="ship_id" id="select"  style="height: 40px;">
                                    <option value="" >اختر شركة الشحن</option>

                                @foreach($ships as $ship)
                                        <option value="{{$ship->id}}" >{{$ship->name}}</option>


                                    @endforeach


                                </select>

                            </div>
                            <div class="block"   style=" margin-left: 36%; position: absolute; bottom: 4px;width: 30%;left: 0">

                                <select name="state" id="select"  style="height: 40px;">

                                    <option value="" >احتر حالة الفواتير</option>
                                    <option value="انتظار">انتظار</option>
                                    <option value="لم يتم التاكيد">لم يتم التاكيد</option>


                                    <option value="تم التاكيد"> تم التاكيد</option>
                                    <option value="تم التسليم لشركة الشحن" >تم التسليم لشركة الشحن</option>

                                    <option value="تم الشحن">تم الشحن </option>
                                    <option value="مرتجع جزئي"> مرتجع جزئي</option>

                                    <option value="مرتجع"> مرتجع</option>

                                </select>
                            </div>

                            <button style=" margin-left: 9%;background: none;border: none;"><i class="fas fa-file-excel fa-2x" style="color: green;"></i></button>
                        </div>
                    </form>
                    @endif
                </div>


            @if($has_id==1)
                    <div class="exporter-info" style="">
        <span><span class="exporter-name" data-name="">
        </span> فواتير</span>
                        {{$customer_name}}
                    </div>
                @endif
                <div class="exportscontainer">

                    <div class="orders" style="width: 99%">
                        @if ($errors->any())
                            <div class="error">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="error-text">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                            @foreach($months as $month=>$days)
                                <div class="order">
                                    <div class="dateheader">
                                        <span>{{$month}}</span>

                                    </div>
                                    <div class="months">
                                        @foreach($days as $day=>$items)


                                            <div class="month co-2">
                                                   <div class="ordersdate"><span class="{{$day}}">{{$day}}</span></div>

                                                <div class="orderstable toggeltable">
                                                    <table id="example" class="maintable" dir="ltr" style="font-weight: 700">
                                                        <tr class="firstrow">
                                                            @if(\Illuminate\Support\Facades\Auth::user()->canDo("orders.destroy"))
                                                                <td class="co-1 head" style="width: 5%;">حذف</td>
                                                            @endif

                                                            <td class="co-1 head" style="width: 5%;">تعديل</td>
                                                            <td class="co-1">المستخدم</td>
                                                            <td class="co-1">حالة</td>
                                                            <td class="co-1">المندوب</td>

                                                            <td class="co-1"  style="width: 6%"> اصناف</td>
                                                            <td class="co-1">الساعة</td>
                                                            <td class="d-none" >السعر بعد الخصم</td>
                                                         
                                                                <td class="co-1"  style="width: 6%"> شركة الشحن</td>

                                                                <td class="co-1" style="width: 9%;" >البوليصة</td>
                                                            <td class="co-1" style="width: 8%;">رقم الفاتورة</td>
                                                        </tr>

                                                        @foreach($items as $item)
                                                            <tr style="display:none;" >
                                                            <td  class="orderprice co-1 total_price_after_discount">{{$item->total_price_after_discount}}</td>
                                                            </tr>
                                                        @endforeach

                                                    </table>

                                                </div>

                                                <div class="bottomspace"></div>
                                                <div class="monthfooter">
                                                    <span dir="rtl"><span>اجمالي اليوم : </span><span class="num"></span> <span class="sign">     {{{\Illuminate\Support\Facades\Auth::user()->currency}}}   </span><span> / </span><span> {{$items_count[$day]}} </span><span>
                                                            @if(isset($ship_id))
                                                                <a href="{{route("detailed_order_items",$day)}}?ship_id={{$ship_id}}">قطعة</a>
                                                            @else
                                                                <a href="{{route("detailed_order_items",$day)}}">قطعة</a>
                                                            @endif
                                                            </span></span>
                                                </div>
                                            </div>
                                            @endforeach
                                    </div>
                                    <div class="orders-of-day">
                                    </div>
                                    <div class="totalmonth">
                                        <span> :اجمالي الشهر  1250$</span>
                                    </div>
                                </div>
                                @endforeach

                    </div>
                </div>
            </div>
            <div class="modal fade" id="order_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  >
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 75%">
                    <div class="modal-content" style="    border: 4px solid gainsboro;  border-radius: 2.24rem;">
                        <div class="modal-header" dir="ltr" style="">
                            <h5 class="modal-title" id="exampleModalLongTitle" style="margin-left: 43%;margin-top: 6%"><i class="fas fa-file-invoice fa-2x" style="padding-right: 10px"></i>تفاصيل الاوردر  </h5>
                            <button type="button" class="close close_update_modal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 30px">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="height: auto">
                            <nav class="nav-fill nav_head" >
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                  <a class="nav-item nav-link active my_navs" id="nav-order-tab" data-toggle="tab" href="#nav-order" role="tab" aria-controls="nav-order" aria-selected="true">  الاوردر <i class="fas fa-file-invoice"></i></a>
                                  <a class="nav-item nav-link my_navs" id="nav-customer-tab" data-toggle="tab" href="#nav-customer" role="tab" aria-controls="nav-customer" aria-selected="false"> العميل <i class="fas fa-address-card"></i></a>
                                  <a class="nav-item nav-link my_navs itemsinordermodal" id="nav-items-tab" data-toggle="tab" href="#nav-items" role="tab" aria-controls="nav-items" aria-selected="false"> الاصناف <i class="fas fa-truck"></i> <span class="no_of_items"> </span></a>

                                </div>
                              </nav>
                              <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-order" role="tabpanel" aria-labelledby="nav-order-tab">
                                    <form id="update_form" method="post" action="" style="padding: 10px">
                                           @csrf
                                           @method("put")
                                        <div class="row" style="width: 100%">
                                            <div class="col">
                                                <label class="sr-only" >Username</label>
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-weight: 700"> رقم الفاتورة</div>
                                                    </div>
                                                    <input disabled name="id" id="order_id" type="text" class="form-control"  >
                                                </div>
                    
                                            </div>
                                            <div class="col">
                                                <label class="sr-only" >Username</label>
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-weight: 700"> رقم البوليصة</div>
                                                    </div>
                                                    <input disabled  name="policy_id" id="policy_id" type="text" class="form-control"  >
                                                </div>
                    
                                            </div>
                    
                                        </div>
        
                                        <div class="row" style="width: 100%">
                                            <div class="col">
                                                <label class="sr-only" >Username</label>
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-weight: 700">تاريخ الاوردر</div>
                                                    </div>
                                                    <input disabled  name="created_at" id="created_at" type="text" class="form-control"  >
                                                </div>
                    
                                            </div>
                                            <div class="col">
                                                <label class="sr-only" >Username</label>
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-weight: 700"> نوع الاوردر</div>
                                                    </div>
                                                    <input disabled  name="type" id="type" type="text" class="form-control"  >
                                                </div>
                    
                                            </div>
                                   
                    
                                        </div>
                                        <div class="row" style="width: 100%">
                                            <div class="col">
                                                <label class="sr-only" >Username</label>
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-weight: 700">تاريخ التسليم</div>
                                                    </div>
                                                    <input   name="receiving_date" id="receiving_date" type="date" class="form-control" >
                                                </div>
                    
                                            </div>
                                            <div class="col">
                                                <label class="sr-only" >Username</label>
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-weight: 700"> عنوان الاستلام</div>
                                                    </div>
                                                    <input  name="receiving_address" id="receiving_address" type="text" class="form-control"  >
                                                </div>
                    
                                            </div>
                                   
                    
                                        </div>
                    
                                        <div class="row" style="width: 100%">
                                            <div class="col">
                                                <label class="sr-only" >Username</label>
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-weight: 700">حالة الاوردر</div>
                                                    </div>
                                                    <select name="state" id="state" disabled class="form-control">
        
                                                        <option value="" >احتر حالة الفواتير</option>
                                                        <option value="انتظار">انتظار</option>
                                                        <option value="لم يتم التاكيد">لم يتم التاكيد</option>
                    
                    
                                                        <option value="تم التاكيد"> تم التاكيد</option>
                                                        <option value="تم التسليم لشركة الشحن" >تم التسليم لشركة الشحن</option>

                                                        <option value="تم الشحن">تم الشحن </option>
                                                        <option value="مرتجع جزئي"> مرتجع جزئي</option>
                    
                                                        <option value="مرتجع"> مرتجع</option>
                    
                                                    </select>                                        </div>
                    
                                            </div>
                                        
                                   
                                            <div class="col">
                                                <label class="sr-only" >Username</label>
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-weight: 700"> عدد القطع</div>
                                                    </div>
                                                    <input disabled  name="no_of_items" id="no_of_items" type="text" class="form-control"  >
                                                </div>
                    
                                            </div>

                                            
                                            <div class="col">
                                                <label class="sr-only" >Username</label>
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-weight: 700"> منطقة الشحن</div>
                                                    </div>
                                                    <select name="district_id" id="district"  class="form-control">
                                                        <option value="null" > اختر منطقة شحن</option>

                                                         @foreach($districts as $district)
                                                        <option value="{{$district->id}}" > {{$district->name}}</option>
                                                         @endforeach
                                                    </select>                                                  </div>
                    
                                            </div>
                                          
                                   
                    
                                        </div>
                                   
                                        <div class="row" style="width: 100%">
                                            <div class="col">
                                                <label class="sr-only" >Username</label>
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-weight: 700"> اجمالي</div>
                                                    </div>
                                                    <input  name="total_price_after_discount" id="total_price_after_discount" type="text" class="form-control" >
                                                </div>
                    
                                            </div>
        
                                            <div class="col">
                                                <label class="sr-only" >Username</label>
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-weight: 700"> مصاريف الشحن</div>
                                                    </div>
                                                    <input  name="delivery" disabled id="delivery" type="text" class="form-control" >
                                                </div>
                    
                                            </div>
        
                    
                                  
                                            <div class="col">
                                                <label class="sr-only" >Username</label>
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-weight: 700">الخصم</div>
                                                    </div>
                                                    <input  name="discount" id="discount" type="text" class="form-control" >
                                                </div>
                    
                                            </div>
                                        </div>
                                        <div class="row" style="width: 100%">
                                            <div class="col">
                                                <label class="sr-only" >Username</label>
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="font-weight: 700">ملاحظة</div>
                                                    </div>
                                                    <textarea  name="details" id="details" type="text" class="form-control" ></textarea>
                                                </div>
                    
                                            </div>
                    
                                        </div>
                    
                    
                                        <div class="modal-footer" >
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
                                            <button type="button" id="confirm_update" class="btn btn-primary" >تاكيد التعديل</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="nav-customer" role="tabpanel" aria-labelledby="nav-customer-tab" style="padding: 35px" >


                                    <table class="table table-striped table-bordered " style="background: white; width:100%; margin-right: 0" >
                                        <tbody>
                                        <tr class="name_row">
                                            <th scope="row">الاسم</th>
                                            <td class="customer_name"></td>
                    
                                        </tr>
                                        <tr id="phone_row">
                                            <th scope="row" >رقم الهاتف</th>
                                            <td class="customer_phone"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"> المحافظة</th>
                    
                                            <td class="customer_governorate"> </td>
                                        </tr>
                                        <tr id="address_row">
                                            <th scope="row">العنوان</th>
                                            <td class="customer_address"></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">لينك الفيسبوك</th>
                    
                                            <td class="facebook_username"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="nav-items" role="tabpanel" aria-labelledby="nav-items-tab" style="padding:25px">
                                    <table class="table table-bordered" id="modal_items_table" dir="rtl" style="background: white; width:100%; margin-right: 0">
                                        <tbody>
                                        <tr class="headrow" style="background-color: lightseagreen" >
                                            <td class="co-2">اسم المنتج</td>
                                            <td class="co-2">كود</td>
                                            <td class="co-1">مقاس</td>
                                            <td class="co-2">الكمية</td>
                                            <td class="co-1">السعر</td>
                                            <td class="co-1">ارتجاع جزئي</td>
                                            <td class="co-1">استبدال</td>
                                        </tr>
                                        </tbody>
                
                                    </table>
                                </div>
                              </div>
                          
                        </div>
            
                    </div>
                </div>
            </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="    border: 4px solid gainsboro;  border-radius: 2.24rem;">
                    <div class="modal-header" dir="ltr">
                        <h5 class="modal-title" id="exampleModalLongTitle" style="margin-left: 37%;margin-top: 6%"><i class="fas fa-user fa-2x" style="padding-right: 10px"></i>اضافة عميل  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 30px">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height: auto">
                        <form id="form" method="post" action="{{route("restore_item","")}}">
                            @csrf
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">سبب الاسترجاع</div>
                                    </div>
                                    <textarea dir="rtl" type="number" name="reason" class="form-control" placeholder="ادخل سبب الاسترجاع" aria-describedby="basic-addon1">
                </textarea>                                </div>
                            </div>
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">الحالة</div>
                                    </div>
                                    <select dir="rtl"   name="received" class="form-control" aria-describedby="basic-addon1">
                                        <option value="0">لم يتم اللاستلام من شركة الشحن بعد</option>

                                        <option value="1">تم الاستلام من شركة الشحن</option>

                                    </select>                             
                                   </div>
                            </div>
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">الكمية المسترجعة</div>
                                    </div>
                                    <input dir="rtl" type="number" min="1" id="restored_quantity"  name="quantity" class="form-control" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">المخزن</div>
                                    </div>
                                    <select dir="rtl"   name="store_id" class="form-control" aria-describedby="basic-addon1">
                                        <option value="0">اختر مخزن</option>
                                        @foreach($stores as $store)
                                        <option value="{{$store->id}}">{{$store->name}}</option>
                                        @endforeach
                                    </select>                             
                                   </div>
                            </div>


                            <div class="modal-footer">
                                <button  type="button" class="btn btn-danger " data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
                                <button id="submit_button" type="submit" class="btn btn-primary" >اضافة</button>
                            </div>
                        </form>
                    </div>

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
                   هل تريد حذف الطلب ؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger close_alert_modal" data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
                    <button type="button" class="btn btn-primary confirm" >تاكيد</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="restore_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="    border: 4px solid gainsboro;  border-radius: 2.24rem;">
                <div class="modal-header" dir="ltr">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="margin-left: 37%;margin-top: 6%"><i class="fas fa-user fa-2x" style="padding-right: 10px"></i>اضافة عميل  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 30px">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="height: auto">
                    <form id="form" method="post" action="{{route("orders.update","")}}">
                        @csrf
                        <div class="form-group row" style="width: 100%">
                            <label class="sr-only" >Username</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" style="font-weight: 700">سبب الاسترجاع</div>
                                </div>
                                <textarea dir="rtl" type="number" id="reason" name="reason" class="form-control" placeholder="ادخل سبب الاسترجاع" aria-describedby="basic-addon1">
                              </textarea>                                
                </div>
                        </div>
                        <div class="form-group row" style="width: 100%">
                            <label class="sr-only" >Username</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" style="font-weight: 700">الحالة</div>
                                </div>
                                <select dir="rtl" id="received"   name="received" class="form-control" aria-describedby="basic-addon1">
                                    <option value="0">لم يتم اللاستلام من شركة الشحن بعد</option>
    
                                    <option value="1">تم الاستلام من شركة الشحن</option>
    
                                </select>                             
                               </div>
                        </div>
                        <div class="form-group row" style="width: 100%">
                            <label class="sr-only" >Username</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" style="font-weight: 700">التكلفة بعد الاسترجاع</div>
                                </div>
                                <input dir="rtl" id="new_cost" name="new_cost" class="form-control" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="form-group row" style="width: 100%">
                            <label class="sr-only" >Username</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" style="font-weight: 700">المخزن</div>
                                </div>
                                <select dir="rtl" id="store_id"  name="store_id" class="form-control" aria-describedby="basic-addon1">
                                    <option value="0">اختر مخزن</option>
                                    @foreach($stores as $store)
                                    <option value="{{$store->id}}">{{$store->name}}</option>
                                    @endforeach
                                </select>                             
                               </div>
                        </div>
    
    
                        <div class="modal-footer">
                            <button  type="button" class="btn btn-danger close_restore_order_modal" data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
                            <button id="restore_order_submit_button" type="button" class="btn btn-primary" >اضافة</button>
                        </div>
                    </form>
                </div>
    
            </div>
        </div>
    </div>
        <!--End body container-->
    </div>
</div>
<!-- remove exporters popup model -->




<table  style="display: none">
 <tr id="temp" class="orderdetails noborderright">

    @if(\Illuminate\Support\Facades\Auth::user()->canDo("orders.destroy"))

        <td class="co-1 tail hovered">
            <i class="fas fa-trash-alt delete"></i>
            <form class="destroy_form" style="display: none" method="post" action="">
                @csrf
                @method("DELETE")
                <button type="submit" class="delete_button"></button>
            </form>
        </td>
    @endif

    <td class="co-1 tail hovered "><i class="fas fa-edit edit"></i>
            <form target="_blank" class="edit_form" style="display: none" method="get" action="">

                <button type="submit" class="edit_button"></button>
            </form>
        </td>

    <td class="co-1 username hovered" data-id="">
        <select class="order_user" style="border: none;background: transparent; font-weight: 700">
        @foreach($users as $u)
            <option  value="{{$u->id}}">{{$u->name}}</option>
        @endforeach


    </select></td>

    <td data-id="" class="co-1 hovered" ><select class="state" style="border: none; background: transparent; font-weight: 700">
            <option value="انتظار">انتظار</option>
            <option value="لم يتم التاكيد">لم يتم التاكيد</option>
            <option value="تم التاكيد" >تم التاكيد</option>
            <option value="تم التسليم لشركة الشحن" >تم التسليم لشركة الشحن</option>

            <option value="تم الشحن" >تم الشحن</option>
            <option value="مرتجع" >مرتجع</option>
            <option value="مرتجع جزئي" >مرتجع جزئي</option>

        </select><span class="unpaid" style="display: none">aa</span></td>
    <td class="co-1 delivery_man hovered" data-id=""><select class="ship" style="border: none;background: transparent; font-weight: 700">
        <option value="">اختر مندوب</option>
        @foreach($delivery_man as $man)
            <option value="{{$man->id}}">{{$man->name}}</option>

        @endforeach


    </select></td>
    <td class="co-1 itemsinorder count hovered"></td>
    <td class="co-1 hour hovered" ></td>
    <td class="orderprice co-1 total_price_after_discount hovered d-none"></td>

    <td class="co-1 hovered"  data-id=""><select class="ship" style="border: none;background: transparent; font-weight: 700">
            <option value="">اختر شركة</option>
            @foreach($ships as $ship)
                <option value="{{$ship->id}}">{{$ship->name}}</option>

            @endforeach


        </select></td>

        <td class="co-1 policy_id hovered"><a target="_blank" href="{{ route('order_to_pdf',"")}}"></a></td>

    <td class="co-1 number hovered "><a target="_blank" class="link" href=""></a></td>
        <td id="">  <div class="TotalItemsInOrderPopupContainer">
                <div class="closepopup">
                    <i class="fas fa-times"></i>
                </div>
                <div class="TotalItemsInOrderPopup">
                    <table id="mytable" dir="rtl">
                        <tr class="headrow" style="background-color: lightseagreen" >
                            <td class="co-2">اسم المنتج</td>
                            <td class="co-2">كود</td>
                            <td class="co-1">مقاس</td>
                            <td class="co-2">الكمية</td>
                            <td class="co-1">السعر</td>
                            <td class="co-1">ارتجاع جزئي</td>
                            <td class="co-1">استبدال</td>
                        </tr>

                    </table>
                </div>
            </div>
        </td>

 </tr>
</table>

<table id="last" style="display: none">
    <tr>
        <td class="co-2 name nested_hovered"></td>
        <td class="co-2 code nested_hovered"></td>
        <td class="co-1 size nested_hovered"></td>
        <td class="co-2 max_restored_quantity nested_hovered"></td>
        <td class="co-2 price nested_hovered"></td>
        <td class="co-1 restore nested_hovered" data-route="" data-id="" ><i style="border: none" class="fas fa-undo fa-2x"></i></td>
        <td class="co-1 nested_hovered" data-id="" ><a class="replace_link" style="border: none" href="{{route("replacement_create","X")}}">استبدال</a></td>

    </tr>
</table>

<script  src="{{asset("js/jquery-3.4.1.min.js")}}"></script>
<script src="{{asset("js/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("js/dataTables.semanticui.min.js")}}"></script>
<script src="{{asset("js/semantic.min.js")}}"></script>


<script>
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
    
    $("body").on("click",".number",function() {

            $(".nav_head").attr("data-id",$(this).find("a").text());
      
            
            var id =  $(this).find("a").text();
            var url = $("#order_details").val()+"/"+id;
    
    
    
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
                    console.log(r);
                    $("#order_id").val(r.id);
                    $("#policy_id").val(r.policy_id);
                    $("#created_at").val(r.created_at);
                    $("#type").val(r.type);
                    $("#receiving_date").val(r.receiving_date);
                    $("#receiving_address").val(r.receiving_address);
                    $("#state").val(r.state);
                    $("#district").val(r.district_id);
                    $("#ship").val(r.ship);
                    $("#delivery").val(r.delivery);
                    $("#total_price_after_discount").val(r.total_price_after_discount);
                    $("#discount").val(r.discount);
                    $("#details").val(r.details);
                    $('#no_of_items').val(r.no_of_items);
                    $("#update_form").attr("action",$("#orders_update").val()+"\\"+id);


                    $(".customer_name").text(r.customer.name);
                    var phones="";
                 
                    
                    for(i=0 ;i<r.customer.phones.length;i++){
                          phones+=r.customer.phones[i].phone+" - ";


                    }
                    $(".customer_phone").text(phones.substring(0, phones.length - 2));

                
                        
                   
                     var addresses="";
                 
                    
                    for(i=0 ;i<r.customer.addresses.length;i++){
                        addresses+=r.customer.addresses[i].address+" - ";


                    }
                    $(".customer_address").text(addresses.substring(0, addresses.length - 2));

                
                        $(".customer_governorate").text(r.customer.governorate);
                        $(".facebook_username").text(r.customer.facebook_username);

                        

                    $("#order_modal_button").click();


    
                },
                error: function (data) {
                    alert('Error on updating, please try again later!');
                    return false;
                }
            })){}
        });
        function add_item(){
                var temp=$("#modal_items_table");
            if(!temp.hasClass("filled")){
                var result = null;
                var id = $(".nav_head").attr("data-id");
        
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
        
        
        
        
        
        
                    var tr = $("#last").clone();
                    
                    tr.detach();
                    tr.find("tr").addClass("filled_row");
        
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
               // temp.parent().find(".TotalItemsInOrderPopup table").addClass("filled");
        
                temp.append(table.html());
                temp.addClass("filled")
            }
        }
        
        $("body").on("click",".itemsinordermodal", add_item);

        $("#order_modal").on("hidden.bs.modal",function(){
            $(".filled_row").remove();
            $("#modal_items_table").removeClass("filled");

            $(".nav-link").removeClass("active");
            $(".tab-pane").removeClass("active");
            $(".tab-pane").removeClass("show");
            $(".my_navs").first().addClass("active");
            $(".tab-pane").first().addClass("active");
            $(".tab-pane").first().addClass("show");
            var id=$("#update_form").attr("action").substring($("#update_form").attr("action").length-1);
            $("#"+id).css("background-color","cyan");
            

        });
        $("body").on("click","td",function(){

              if($(this).parent().hasClass("colored")){
                $(this).parent().removeClass("colored");

                $(this).parent().css("background-color","");
            
              }
              else{
                $(this).parent().addClass("colored");

                $(this).parent().css("background-color","cyan");


              }

    
    
              

        });
        
          
</script>
<script src="{{asset("js/popper.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>
<script type="module" src="{{asset("js/order-reciept.js")}}"></script>

</body>
</html>


