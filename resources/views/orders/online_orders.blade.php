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
        .transparent_button{
            background: transparent;
            border: none;
        }
        .collect{
            background-color: blue; 
            border-color: blue;
        }
        .exports_cases {
            padding: 10px;
        }
        input{
            border: 1px solid lightgrey;
            border-radius: 6px;
            padding: 4px;
            text-align: center;
            direction: rtl;
            font-weight: 600;

        }
      
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
        .name{
            font-weight: bold;
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

<button id="cancel_collect_button" class="btn btn-danger cancel_collect d-none"  >الغاء</button>
<button id="collect_button" class="btn btn-primary collect d-none" style="background-color: blue; border-color: blue;" >تحصيل</button>
<button  id="order_modal_button" data-target='#order_modal' data-toggle='modal' style='display: none'></button>
<button style="display: none" id="alert_modal_button" data-target='#alert_modal' data-toggle='modal'></button>
<button id='modal_button' data-target='#exampleModalCenter' data-toggle='modal' class='btn btn-primary' style='display: none'></button>

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

<div class="hidden_district row" style="width: 100%; display: none" id="hidden_district">
        <div class="col">
            <label class="sr-only">Username</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-weight: 700">  المنطقة</div>
                </div>
                <select  name="districts[]" type="text" class="form-control" >
               
                 </select>
            </div>

        </div>
        <div class="col">
            <label class="sr-only">Username</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-weight: 700">  التكلفة</div>
                </div>
                <input name="cost[]" type="text" class="form-control"  placeholder="">
            </div>

        </div>

    
</div>
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
    <nav style="margin-right: 1%">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item  nav-link active" id="ship-details-tab" data-toggle="tab" href="#ship-details" role="tab" aria-controls="nav-home" aria-selected="true">تفاصيل الشركة</a>
          <a class="nav-item  nav-link" id="ship-orders-tab" data-toggle="tab" href="#ship-orders" role="tab" aria-controls="nav-profile" aria-selected="false">اوردرات تم تسليمها للشركة</a>
          <a class="nav-item  nav-link" id="ship-payments-tab" data-toggle="tab" href="#ship-payments" role="tab" aria-controls="nav-contact" aria-selected="false"> التعاملات المالية</a>
          <a class="nav-item  nav-link" id="ship-districts-tab" data-toggle="tab" href="#ship-districts" role="tab" aria-controls="nav-contact" aria-selected="false">  مناطق الشحن </a>

        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
       
        <div class="tab-pane fade" id="ship-orders" role="tabpanel" aria-labelledby="nav-home-tab">
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
                                    <option value="{{route("orders_with_state","تم الشحن")}}?ship_id={{$ship_id}}">تم الشحن </option>
                                    <option value="{{route("orders_with_state","مرتجع جزئي")}}?ship_id={{$ship_id}}"> مرتجع جزئي</option>

                                    <option value="{{route("orders_with_state","مرتجع")}}?ship_id={{$ship_id}}"> مرتجع</option>
                                @else

                                    <option value="{{route("orders.index")}}" >الكل</option>
                                    <option value="{{route("orders_with_state","انتظار")}}">انتظار</option>
                                    <option value="{{route("orders_with_state","لم يتم التاكيد")}}">لم يتم التاكيد</option>


                                    <option value="{{route("orders_with_state","تم التاكيد")}}"> تم التاكيد</option>
                                    <option value="{{route("orders_with_state","تم الشحن")}}">تم الشحن </option>
                                    <option value="{{route("orders_with_state","مرتجع جزئي")}}"> مرتجع جزئي</option>

                                    <option value="{{route("orders_with_state","مرتجع")}}"> مرتجع</option>
                                @endif


                            </select>                        </div>


                    </div>
               
                </div>


    
                <table id="example" dir="ltr" class="ui celled table table-fixed" style="text-align: center" dir="rtl"   >
                    <thead>
                        
                    <tr class="firstrow">
                        <th style="background: #5C71A3; color: white;" >تحصيل</th>
                        <th style="background: #5C71A3; color: white;" >المستخدم</th>
                        <th style="background: #5C71A3; color: white;">اجمالي</th>
                        <th  style="background: #5C71A3; color: white;">اصناف</th>
                        <th style="background: #5C71A3; color: white;">عنوان</th>
                        <th style="background: #5C71A3; color: white;">رقم العميل</th>
                        <th  style="background: #5C71A3; color: white;"> اسم العميل</th>
                    </tr>

                   

                </thead>
                <tbody>
                
            
                @foreach ($orders as $order)
                <tr id="{{$order->id}}"  style="font-weight: 700">
                    <td class="first_td">
                        <button  class="btn btn-danger cancel_collect " style="font-weight: 700;" >الغاء</button>
                        <button class="btn btn-primary collect" style="background-color: blue; border-color: blue; font-weight: 700;"  > قبول</button></td>
                    
                    <td data-id="{{$order->id}}">           
                     مسوق
                    </td>
                    <td>{{$order->total_price_after_discount}}
                        <div class="TotalItemsInOrderPopupContainer">
                            <div class="closepopup">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="TotalItemsInOrderPopup">
                                <table id="mytable" dir="rtl">
                                    <tr class="headrow" style="background-color: #5C71A3" >
                                        <td class="co-2">اسم المنتج</td>
                                        <td class="co-2">كود</td>
                                        <td class="co-1">لون</td>
                                        <td class="co-1">مقاس</td>
                                        <td class="co-2">الكمية</td>
                                        <td class="co-1">السعر</td>
                                    </tr>
                                    @foreach($order->items as $item)
                                    <tr >
                                        <td class="co-2 name nested_hovered" style="font-weight: 700">{{$item->name->name}}</td>
                                        <td class="co-2 code nested_hovered" style="font-weight: 700">{{$item->name->code}}</td>
                                        <td class="co-1 color nested_hovered" style="font-weight: 700">{{$item->name->color}}</td>
                                        <td class="co-1 size nested_hovered" style="font-weight: 700">{{$item->size}}</td>
                                        <td class="co-2 max_restored_quantity nested_hovered" style="font-weight: 700">{{$item->quantity}}</td>
                                        <td class="co-2 price nested_hovered" style="font-weight: 700">{{$item->price()}}</td>
                                    </tr>
                                    @endforeach
            
                                </table>
                            </div>
                        </div>
                    </td>
                    <td class="itemsinorder count">
                        <a href="#">{{$order->items()->count()}}</a> 

                    </td>
                   
                    <td>{{$order->customer_address}}</td>

                    <td>{{$order->customer_phone}}</td>
                    <td class="number"><a style="font-weight: 700" target="_blank" class="link" href="">{{$order->customer_name}}</a></td>

                </tr>   
                    
                @endforeach
            
                 </tbody>


                
                

                </table>
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
                                <div class="tab-pane fade show active second_tab" id="nav-order" role="tabpanel" aria-labelledby="nav-order-tab">
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
                                                    <select name="state" id=""  class="form-control">
        
                                                        <option value="" >احتر حالة الفواتير</option>
                                                        <option value="انتظار">انتظار</option>
                                                        <option value="لم يتم التاكيد">لم يتم التاكيد</option>
                    
                    
                                                        <option value="تم التاكيد"> تم التاكيد</option>
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
                                                    <input  name="delivery" id="delivery" type="text" class="form-control" >
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
                                <div class="tab-pane fade second_tab" id="nav-customer" role="tabpanel" aria-labelledby="nav-customer-tab" style="padding: 35px" >


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
                                <div class="tab-pane fade second_tab" id="nav-items" role="tabpanel" aria-labelledby="nav-items-tab" style="padding:25px">
                                    <table class="table table-bordered" id="modal_items_table" dir="rtl" style="background: white; width:100%; margin-right: 0">
                                        <tbody>
                                        <tr class="headrow" style="background-color: #5C71A3" >
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
     


    </select></td>

    <td data-id="" class="co-1 hovered" ><select class="state" style="border: none; background: transparent; font-weight: 700">
            <option value="انتظار">انتظار</option>
            <option value="لم يتم التاكيد">لم يتم التاكيد</option>
            <option value="تم التاكيد" >تم التاكيد</option>
            <option value="تم الشحن" >تم الشحن</option>
            <option value="مرتجع" >مرتجع</option>
            <option value="مرتجع جزئي" >مرتجع جزئي</option>

        </select><span class="unpaid" style="display: none">aa</span></td>
    <td class="co-1 delivery_man hovered" data-id=""><select class="ship" style="border: none;background: transparent; font-weight: 700">
        <option value="0">اختر مندوب</option>
       


    </select></td>
    <td class="co-1 itemsinorder count hovered"></td>
    <td class="co-1 hour hovered" ></td>
    <td class="orderprice co-1 total_price_after_discount hovered d-none"></td>

    <td class="co-1 hovered"  data-id=""><select class="ship" style="border: none;background: transparent; font-weight: 700">
            <option value="0">اختر شركة</option>
   


        </select></td>

        <td class="co-1 policy_id hovered"><a target="_blank" href="{{ route('order_to_pdf',"")}}"></a></td>

    <td class="co-1 number hovered "><a target="_blank" class="link" href=""></a></td>
        <td id="">  
            <div class="TotalItemsInOrderPopupContainer">
                <div class="closepopup">
                    <i class="fas fa-times"></i>
                </div>
                <div class="TotalItemsInOrderPopup">
                    <table id="mytable" dir="rtl">
                        <tr class="headrow" style="background-color: #5C71A3" >
                            <td class="co-2">اسم المنتج</td>
                            <td class="co-2">كود</td>
                            <td class="co-1">مقاس</td>
                            <td class="co-2">الكمية</td>
                            <td class="co-1">السعر</td>
                            <td class="co-1">ارتجاع جزئي</td>
                            <td class="co-1">استبدال</td>
                        </tr>
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
    $(document).ready(function(){
        $('#example').DataTable({
            "paging":   true,

            aaSorting: [],
            "language": {
                "lengthMenu":  "",
                "zeroRecords": "لا يوجد نتيجة بحث مطابقة",
                "info":  "",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "oPaginate": {
                    "sNext":    "التالي",
                    "sPrevious": "السابق"
                },

            }

        });

        var temp=$(".grid .row:last");
        var x=$("<button  style='position: absolute;right: 50%;background: #5C71A3;border: none;border-radius: 1.24rem;' class='btn btn-primary'>عرض المزيد</button>");

      //  temp.html(x);
        $("#example_wrapper").css("padding","43px");
        $("#example_wrapper").attr("dir","ltr");

        $(".dataTables_filter").attr("dir","rtl");

       /*  x=$("<button id='modal_button' data-target='#exampleModalCenter' data-toggle='modal' class='btn btn-primary' style='border: none; background: #5C71A3;border-radius: 1.24rem;'><i class='fas fa-box-open fa-2x' ><span style='padding: 14px;font-size: 17px'>اضافة صنف</span></i></button>");
         $(".ui .row:first .eight:first ").html(x);*/

            $('#payments').DataTable({
                "paging":   true,
    
                aaSorting: [],
                "language": {
                    "lengthMenu":  "",
                    "zeroRecords": "لا يوجد نتيجة بحث مطابقة",
                    "info":  "",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "oPaginate": {
                        "sNext":    "التالي",
                        "sPrevious": "السابق"
                    }
                }
    
            });
            
           /* var temp=$(".grid .row:last");
            var x=$("<button  style='position: absolute;right: 50%;background: cadetblue;border: none;border-radius: 1.24rem;' class='btn btn-primary'>عرض المزيد</button>");
    
            temp.html(x);*/
            $("#payments_wrapper").css("padding","43px");
            $("#payments_wrapper").attr("dir","ltr");
    
            $("#payments_filter").attr("dir","rtl");
    
             x=$("<button id='modal_button' data-target='#exampleModalCenter' data-toggle='modal' class='btn btn-primary' style='border: none; background: #5C71A3;border-radius: 1.24rem;'><i class='fas fa-hand-holding-usd fa-2x' ><span style='padding: 14px;font-size: 17px'> تحصيل مبلغ</span></i></button>");
             $("#payments_wrapper .ui .row:first .eight:first ").html(x);

             $('#districts').DataTable({
                "paging":   true,
    
                aaSorting: [],
                "language": {
                    "lengthMenu":  "",
                    "zeroRecords": "لا يوجد نتيجة بحث مطابقة",
                    "info":  "",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "oPaginate": {
                        "sNext":    "التالي",
                        "sPrevious": "السابق"
                    }
                }
    
            });
            $("#districts_wrapper").css("padding","43px");
            $("#districts_wrapper").attr("dir","ltr");
    
            $("#districts_filter").attr("dir","rtl");
    
             x=$("<button id='districts_modal_button' data-target='#districtsModalCenter' data-toggle='modal' class='btn btn-primary' style='border: none; background: #5C71A3;border-radius: 1.24rem;'><i class='fas fa-map-marked-alt fa-2x' ><span style='padding: 14px;font-size: 17px'>  تسجيل منطقة شحن </span></i></button>");
             $("#districts_wrapper .ui .row:first .eight:first ").html(x);
   
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

            $(".my_navs").removeClass("active");
            $(".second_tab").removeClass("active");
            $(".second_tab").removeClass("show");
            $(".my_navs").first().addClass("active");
            $(".second_tab").first().addClass("active");
            $(".second_tab").first().addClass("show");
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
        
        function collect_order(id){
        
            
             var url=$("#orders_update").val()+"\\"+id;
         
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if ($.ajax({
                url: url,
                type: "post",
                async: false,
                data:{"_method":"put","collected":1},
    
                success: function (r) {

                    var cancel_collect_button=$("#cancel_collect_button").clone();
                    cancel_collect_button.removeAttr("id");
                    cancel_collect_button.removeClass("d-none");
                    $("#"+id).find(".first_td").html(cancel_collect_button);
    
                },
                error: function (data) {
                    alert('Error on updating, please try again later!');
                    return false;
                }
            })){}
           
        }
    $(document).on("click",".collect",function(){
        var id=$(this).parent().parent().attr("id");
        collect_order(id);
    });
    
    function decollect_order(id){
        
            
        var url=$("#orders_update").val()+"\\"+id;
    
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       if ($.ajax({
           url: url,
           type: "post",
           async: false,
           data:{"_method":"put","collected":0},

           success: function (r) {

               var collect_button=$("#collect_button").clone();
               collect_button.removeAttr("id");
               collect_button.removeClass("d-none");
               $("#"+id).find(".first_td").html(collect_button);

           },
           error: function (data) {
               alert('Error on updating, please try again later!');
               return false;
           }
       })){}
      
   }
$(document).on("click",".cancel_collect",function(){
   var id=$(this).parent().parent().attr("id");
   decollect_order(id);
});


$(document).on("click",".add_another_district",function () {
    var temp=$("#hidden_district").clone();
    temp.css("display","");
    temp.attr("id","");

    $(".last").before(temp);
});
$("body").on("click",".itemsinorder",function() {
  
    $(this).parent().find(".TotalItemsInOrderPopupContainer").fadeIn();
});
$("body").on("click",".closepopup",function() {
    $(this).parent().fadeOut();
    $(this).parent().parent().click();

});

        
          
</script>
<script src="{{asset("js/popper.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>

</body>
</html>


