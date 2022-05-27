<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset("fontawesome-free-5.11.2-web/css/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" href="{{asset("css/semantic.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/dataTables.semanticui.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/bootstrap.css")}}">

    <link rel="stylesheet" href="{{asset("css/exporter_recipts/exporter_reciepts.css")}}">
    <title>جدول الاوردرات</title>
    <style>
        body{
            background: #f7f7f7;
            font-size: 17px;



        }
        .ui{
            overflow: auto;
        }
        .active_store{
            border: 1px solid black;
            color: white;
            background-color: blue;
            
        }
        .not_active_store{
            border: 1px solid black;
            background-color: white;
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
        .table-fixed thead th {
            position: sticky;
            position: -webkit-sticky;
            top: 0;
            z-index: 999;
            background-color: #000;
            color: #fff;
        }


    </style>
    <title>خزنة</title>
</head>
<body>
    <input style="display:none;" id="orders_update" value="{{route("orders.update","")}}">
    <input class="url2" value="{{route("get_order_items","")}}" style="display: none">

<input style="display: none" value="{{route("items.store")}}" id="items_store_route">
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
            <li class="breadcrumb-item" aria-current="page"><a href="{{route("home")}}" >  الصفحة الرئيسية </a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{route("orders_table")}}">  جدول الاوردرات </a></li>

    @endsection
    @include("sidebars.navbar")
    <!---end of navbar !-->


        <!---start of content !-->
     
        <div id="add_item_div" style="height: auto; width: 80%; background-color: #efeded; margin-right: 10%; margin-top: 10px; border-radius: 1.24rem; display: none">
            <form style="display: block;font-weight: 500">
                <div class="line" style="display: flex;width: 90%">
                    <div style="margin-top: 25px; margin-right: 10px;width: 33%;">
                        <label style="display: block;margin-left: 57%;"> الصنف:</label>
                        <input  style="border: 1px solid cadetblue;border-radius: 10px;width: 80%; height: 35px;">
                    </div>
                    <div style="margin-top: 25px; margin-right: 10px;width: 33%;">
                        <label style="display: block;margin-left: 57%;" >المقاس:</label>
                        <input style="border: 1px solid cadetblue;border-radius: 10px;width: 80%;height: 35px;">
                    </div>
                    <div style="margin-top: 25px; margin-right: 10px;width: 33%;">
                        <label style="display: block;margin-left: 57%;"> الكمية:</label>
                        <input style="border: 1px solid cadetblue;border-radius: 10px;width: 80%;height: 35px;">
                    </div>
                </div>


                <div class="line" style="display: flex;width: 90%">

                    <div style="margin-top: 25px; margin-right: 10px;width: 33%;">
                        <label style="display: block;margin-left: 50%;"> سعر الشراء:</label>
                        <input style="border: 1px solid cadetblue;border-radius: 10px;width: 80%;height: 35px;">
                    </div>
                    <div style="margin-top: 25px; margin-right: 10px;width: 33%;">
                        <label style="display: block;margin-left: 55%;"> سعر البيع:</label>
                        <input style="border: 1px solid cadetblue;border-radius: 10px;width: 80%;height: 35px;">
                    </div>
                    <div style="margin-top: 25px; margin-right: 10px;width: 33%; visibility: hidden">
                        <label> الكمية:</label>
                        <input style="border: 1px solid cadetblue;border-radius: 10px;width: 80%;height: 35px;">
                    </div>
                </div>
                <div class="line" style="display: flex;width: 90%">
                    <button class="btn btn-success" style="margin-right: 50%;margin-bottom: 3%;margin-top: 3%;width: 12%; border-radius: 10px;"> تم</button>
                </div>
            </form>
        </div>
        <div class="exports_cases" style="width: 80%; display: inline-flex; margin-left: 10%;display: none" >
            <div class="cases first_case" style="width: 33%;">
                <div class="cards"  style="">

                    <div class="card-body" style="display: flex; padding: 0px;" >
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i style="color: yellowgreen;" class="fas fa-users fa-4x"></i></div>


                        <a  style="width: 100%;height: 100%;padding: 12px 9px; display: inline-grid;"href="#" class="btn " >
                            <span style="font-weight: bold">1010</span>
                            <span style="font-weight: 900;font-size: 20px"> جمالي العملاء</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="cases first_case" style="width: 33%;">
                <div class="cards" >

                    <div class="card-body" style="display: flex; padding: 0px">
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i  style="color: orchid;" class="fas fa-user fa-4x"></i></div>

                        <a  style="width: 71%;height: 100%;padding: 12px 9px; display: inline-grid;"href="#" class="btn " >
                            <span style="font-weight: bold">925</span>
                            <span style="font-weight: 900;font-size: 20px"> عملاء في النتظار</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="cases first_case" style="width: 33%;">
                <div class="cards" >

                    <div class="card-body" style="display: flex; padding: 0px">
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i style="color: red;" class="fas fa-running fa-4x"></i></div>

                        <a  style="width: 71%;height: 100%;padding: 12px 9px; display: inline-grid; "href="#" class="btn " >
                            <span style="font-weight: bold">5</span>
                            <span style="font-weight: 900;font-size: 20px">عملاء متهربين</span>
                        </a>
                    </div>
                </div>
            </div>



        </div>
        <table id="example" class="ui celled table table-fixed" style="text-align: center" dir="rtl"   >
            <thead >
            <tr>

            <th style="background: lightseagreen; color: white;" >رقم</th>
            <th style="background: lightseagreen; color: white;">اسم الصفحة</th>
            <th style="background: lightseagreen; color: white;">اكونت العميل</th>
            <th style="background: lightseagreen; color: white;">اسم العميل</th>
            <th style="background: lightseagreen; color: white;">تليفون العميل</th>
            <th style="background: lightseagreen; color: white;"> المحافظة</th>
            <th style="background: lightseagreen; color: white;"> العنوان</th>
            <th style="background: lightseagreen; color: white;">محتويات الاوردر</th>
            <th style="background: lightseagreen; color: white;">الشحن</th>

            <th style="background: lightseagreen; color: white;">سعر الشحن</th>
            <th style="background: lightseagreen; color: white;">اسم المندوب</th>
            <th style="background: lightseagreen; color: white;">اكونت المندوب</th>
            <th style="background: lightseagreen; color: white;">تليفون المندوب</th>
            <th style="background: lightseagreen; color: white;"> ملاحظات</th>
            <th style="background: lightseagreen; color: white;"> الحالة</th>

            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)

                <tr  id="{{$order->id}}" data-route="{{route("orders.update",$order->id)}}" style="font-weight: 500">
                <td class="id">{{$order->id}}</td>
                <td class="page_name"></td>
                <td class="customer_link"><a target="_blank" href="{{$order->customer->customer_link}}"> لينك</a></td>
                <td class="customer_name">{{$order->customer->name}}</td>
                <td class="customer_phone">
                     <select style="border: none;font-weight: 500;background: none">
                    @foreach($order->customer->phones as $phone)
                        <option class="phones" data-id="{{$phone->id}}">{{$phone->phone}}</option>
                    @endforeach
                </select></td>
                <td class="customer_governorate">{{$order->customer->governorate}}</td>
                <td class="address"> 
                {{$order->receiving_address}}
                </td>
                <td class="itemsinorder" data-id="{{$order->id}}">{{$order->no_of_items()}}</td>
                <td class="delivery">{{$order->delivery}}

                    <div class="modal fade" id="alert_modal_{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  >
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="    border: 4px solid gainsboro;  border-radius: 2.24rem;">
                                <div class="modal-header" dir="ltr">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" style="font-size: 30px">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="height: auto;    font-weight: bold;text-align: center;">
                                    <form method="post" action="{{route("orders.update",$order->id)}}" >
                                        @csrf
                                        @method("put")
                                    <div class="input-group mb-3" dir="ltr">
                                     <textarea dir="rtl" type="number"  name="note" class="form-control" placeholder="ادخل ملاحظة اذا وجد" aria-describedby="basic-addon1">
                                     </textarea>
                                          <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"> ملاحظة علي الطلب</span>
                                        </div>
                                    </div>
                                    
                                </div>
            
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger " data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
                                    <button type="submit" class="btn btn-primary " >حفظ</button>
                                </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </td>

                <td class="total_price_after_discount">{{$order->total_price_after_discount}}</td>
                <td class="ship_name">@if($order->ship){{$order->ship->name}}@endif</td>
                <td class="ship_account">@if($order->ship)<a target="_blank" href="{{$order->ship->social_account}}"> لينك</a>@endif</td>
                <td class="phone">@if($order->ship){{$order->ship->phone}}@endif</td>
                <td class="note" data-target='#alert_modal_{{$order->id}}' data-toggle='modal'>{{$order->details}}

                    
                </td>
                
                <td class="sta " data-id="{{$order->id}}"
                    @if($order->state=="لم يتم التاكيد") style="background-color: yellow" @endif
                    @if($order->state=="تم التاكيد") style="background-color: sandybrown" @endif
                    @if($order->state=="تم التسليم لشركة الشحن") style="background-color: springgreen" @endif
                    @if($order->state=="تم الشحن") style="background-color: green" @endif
                    @if($order->state=="مرتجع") style="background-color: red" @endif
                    >
                    <select class="state" style="border: none; background: transparent; font-weight: 700">
                        <option  @if($order->state=="انتظار") selected @endif value="انتظار">انتظار</option>
                        <option style="background-color: yellow" @if($order->state=="لم يتم التاكيد") selected @endif value="لم يتم التاكيد">لم يتم التاكيد</option>
                        <option style="background-color: sandybrown" @if($order->state=="تم التاكيد") selected @endif value="تم التاكيد" >تم التاكيد</option>
                        <option style="background-color: springgreen" @if($order->state=="تم التسليم لشركة الشحن") selected @endif value="تم التسليم لشركة الشحن" >تم التسليم لشركة الشحن</option>
            
                        <option style="background-color: green" @if($order->state=="تم الشحن") selected @endif value="تم الشحن" >تم الشحن</option>
                        <option style="background-color: red" @if($order->state=="مرتجع") selected @endif value="مرتجع" >مرتجع</option>
                        <option @if($order->state=="مرتجع جزئي") selected @endif value="مرتجع جزئي" >مرتجع جزئي</option>
            
                    </select>
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
                        <h5 class="modal-title" id="exampleModalLongTitle" style="margin-left: 37%;margin-top: 6%"><i class="fas fa-box-open fa-2x" style="padding-right: 10px"></i>اضافة صنف  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 30px">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height: auto">
                        @if($flag_that_all_items_are_passed==="true")
                        <form method="post" action="{{route("items.store")}}" id="form">

                        @else
                        <form method="post" action="{{route("items.store")}}?store_id={{$flag_that_all_items_are_passed}}" id="form">

                        @endif
                            @csrf
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2" style="width: 60%;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">صنف</div>
                                    </div>
                                    <select name="name_id" id="name" type="text" class="form-control all"  >
                                        @foreach($names as $name)
                                            <option value="{{$name->id}}" >{{$name->name.":".$name->code.":".$name->color}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group mb-2 mr-sm-2" style="width: 35%">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">مقاس</div>
                                    </div>
                                    <input name="size" id="size" type="text" class="form-control all"  placeholder="ادخل المقاس">
                                </div>

                            </div>





                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2" style="width: 47%">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">سعر شراء</div>
                                    </div>
                                    <input name="buying_price"  id="buying_price" type="text" class="form-control all" placeholder="ادخل سعر الشراء">
                                </div>
                                <div class="input-group mb-2 mr-sm-2" style="width: 49%">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">سعر بيع</div>
                                    </div>
                                    <input name="selling_price"  id="selling_price" type="text" class="form-control all" placeholder="ادخل سعر البيع">
                                </div>
                            </div>
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">كمية</div>
                                    </div>
                                    <input  name="quantity" id="quantity" type="text" class="form-control all" placeholder="ادخل الكمية المضافة">
                                </div>
                            </div>
                            <input type="submit" id="submit_button" name="submit_button" style="display:none;">

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
                        <button  type="button" class="btn btn-primary confirm_button" >اضافة</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Expired Modal -->
        <div class="modal fade" id="expiredModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="    border: 4px solid gainsboro;  border-radius: 2.24rem;">
                    <div class="modal-header" dir="ltr">
                        <h5 class="modal-title" id="exampleModalLongTitle" style="margin-left: 37%;margin-top: 6%"><i class="fas fa-box-open fa-2x" style="padding-right: 10px"></i>اهلاك صنف  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 30px">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height: auto">
                        <form method="post" action="{{route("expireds.store")}}" id="expired_form">
                            @csrf
                            <div class="form-group row d-none" style="width: 100%">
                                <input name="name_id" id="name_id" value="">
                                <input name="store_id" id="store_id" @if(isset($item))value="{{$item->store_id}}" @endif>

                            </div>
                            
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2" style="width: 47%;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">صنف</div>
                                    </div>
                                    <input readonly name="name" id="expired_name" type="text" class="form-control " >
                                </div>
                                
                                <div class="input-group mb-2 mr-sm-2" style="width: 47%;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">كود</div>
                                    </div>
                                    <input readonly name="code" id="expired_code" type="text" class="form-control " >
                                </div>
                                <div class="input-group mb-2 mr-sm-2" style="width: 47%;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">لون</div>
                                    </div>
                                    <input readonly name="color" id="expired_color" type="text" class="form-control " >
                                </div>
                                <div class="input-group mb-2 mr-sm-2" style="width: 47%">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">مقاس</div>
                                    </div>
                                    <input readonly name="size" id="expired_size" type="text" class="form-control "  placeholder="ادخل المقاس">
                                </div>
                                <div class="input-group mb-2 mr-sm-2" style="width: 47%">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">سعر شراء</div>
                                    </div>
                                    <input readonly name="buying_price"  id="expired_buying_price" type="text" class="form-control " placeholder="ادخل سعر الشراء">
                                </div>
                                <div class="input-group mb-2 mr-sm-2" style="width: 47%">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">  الكمية المتوفرة</div>
                                    </div>
                                    <input readonly  id="expired_available_quantity" type="number" class="form-control " placeholder="ادخل الكمية المضافة">
                                </div>

                            </div>


                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">الكمية المهلكة</div>
                                    </div>
                                    <input  name="quantity" id="expired_quantity" type="number" class="form-control" placeholder="ادخل الكمية المهلكة">
                                </div>
                            </div>
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">سبب الاهلاك </div>
                                    </div>
                                    <input  name="reason" id="" type="text" class="form-control " placeholder="ادخل  سبب الاهلاك">
                                </div>
                            </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
                        <button  type="submit" class="btn btn-primary expired_confirm_button" disabled="false" >اضافة</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

    </div>

    
    <div class="TotalItemsInOrderPopupContainer">
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
                    <td class="co-1 d-none">ارتجاع جزئي</td>
                    <td class="co-1 d-none">استبدال</td>
                </tr>

            </table>
        </div>
    </div>

    <table id="last" style="display: none">
        <tbody class="filled">
        <tr>
            <td class="co-2 name nested_hovered"></td>
            <td class="co-2 code nested_hovered"></td>
            <td class="co-1 size nested_hovered"></td>
            <td class="co-2 max_restored_quantity nested_hovered"></td>
            <td class="co-2 price nested_hovered"></td>
            <td class="co-1 restore nested_hovered d-none" data-route="" data-id="" ><i style="border: none" class="fas fa-undo fa-2x"></i></td>
            <td class="co-1 nested_hovered d-none" data-id="" ><a class="replace_link" style="border: none" href="{{route("replacement_create","X")}}">استبدال</a></td>
    
        </tr>
    </tbody>
    </table>
    

</div>

<script  src="{{asset("js/jquery-3.4.1.min.js")}}"></script>
<script src="{{asset("js/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("js/dataTables.semanticui.min.js")}}"></script>
<script src="{{asset("js/semantic.min.js")}}"></script>    <script type="text/javascript">
      /*  $(".edit").click(function(){
            var parent=$(this).parent().parent();
            $("#code").text(parent.find(".code").text());
            $("#color").text(parent.find(".color").text());
            $("#quantity").val(parent.find(".quantity").text());
            $("#buying_price").val(parent.find(".buying_price").text());
            $("#selling_price").val(parent.find(".selling_price").text());
            $("#size").val(parent.find(".size").text());

            $("#form").attr("action",parent.attr("data-route"));
            $(".details-popup-container").fadeIn();
        });*/
        $(".done").click(function () {

            var object={};

            object["quantity"]=$("#quantity").val();
            object["buying_price"]=$("#buying_price").val();
            object["selling_price"]=$("#selling_price").val();
            object["size"]=$("#size").val();
            object["_method"]="PUT";



            var url=$("#form").attr("action");
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
                    console.log(result)
                   var temp=$("#"+result.id);
                      temp.find(".quantity").text(result.quantity);
                    temp.find(".buying_price").text(result.buying_price);
                    temp.find(".selling_price").text(result.selling_price);
                    temp.find(".size").text(result.size);
                    alert("تم التعديل");
                    $(".close-popup").click();

                },
                error: function (data) {
                    //alert('عفوا هذه الفاتورة غير متوفرة هنا');
                    return false;
                }
            })){

            }

        });
        $(".delete").click(function(){

            var temp=$(this);
            $(".alert-popup-container").addClass("show");
            $(".cancel").click(function(){
                $(".alert-popup-container").removeClass("show");
            });
            $(".confirm").click(function(){
                $(".alert-popup-container").removeClass("show");
                temp.parent().find(".delete_button").click();
            });

        });
        $("td").click(function(){

            $("td").parent().find(".sorting_1").css("background-color","");
            $("td").parent().css("background-color","");

            $(this).parent().find(".sorting_1").css("background-color","cyan");
            $(this).parent().css("background-color","cyan");
        });

        </script>






<script >
    $(document).ready(function() {
        $("#sidebarCollapse").click();

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
        var x=$("<button  style='position: absolute;right: 50%;background: lightseagreen;border: none;border-radius: 1.24rem;' class='btn btn-primary'>عرض المزيد</button>");

      //  temp.html(x);
        $("#example_wrapper").css("padding","43px");
        $("#example_wrapper").attr("dir","ltr");

        $("#example_filter").attr("dir","rtl");

       /*  x=$("<button id='modal_button' data-target='#exampleModalCenter' data-toggle='modal' class='btn btn-primary' style='border: none; background: lightseagreen;border-radius: 1.24rem;'><i class='fas fa-box-open fa-2x' ><span style='padding: 14px;font-size: 17px'>اضافة صنف</span></i></button>");
         $(".ui .row:first .eight:first ").html(x);*/
   
   
   
         $("#expired_quantity").keyup(function () {

            if(parseInt($(this).val())>parseInt($(this).attr("data-quantity")) || $(this).val().length==0){
                alert("الكمية المهلكة غير صحيحة");
                $(".expired_confirm_button").attr("disabled",true);
            }
            else
            {                  
    
                  $(".expired_confirm_button").attr("disabled",false);
            }
        });
        } );

    
    $(document).on("click",".recycle",function () {
        //get the table tr which contain customer data
        var table=$(this).parent().parent();
        //get the customer attributes and set them in modal

       $("#name_id").val(table.attr("data-nameid"));
        $("#expired_name").val(table.find(".name").text());
        $("#expired_code").val(table.find(".code").text());
        $("#expired_color").val(table.find(".color").text());
        $("#expired_available_quantity").val(table.find(".quantity").text());
        $("#expired_buying_price").val(table.find(".buying_price").text());
        $("#expired_size").val(table.find(".size").text());
        $("#expired_quantity").attr("data-quantity",parseInt(table.find(".quantity").text()));

       // $("#expired_form").attr("action",table.attr("data-route"));

        $(".details-popup-container").fadeIn();


        $("#phone").parent().parent().css("display","none");
        $('#expiredModal').modal('show');
    });
    $(document).on("click",".fa-edit",function () {
        //get the table tr which contain customer data
        var table=$(this).parent().parent();
        //get the customer attributes and set them in modal

        $("#name").val(table.attr("data-nameid"));
        $("#code").text(table.find(".code").text());
        $("#color").text(table.find(".color").text());
        $("#quantity").val(table.find(".quantity").text());
        $("#buying_price").val(table.find(".buying_price").text());
        $("#selling_price").val(table.find(".selling_price").text());
        $("#size").val(table.find(".size").text());
        $(".confirm_button").addClass("done");
        $("#form").attr("action",table.attr("data-route"));

        $(".details-popup-container").fadeIn();


        $("#phone").parent().parent().css("display","none");
        $('#exampleModalCenter').modal('show');
    });
    $('#exampleModalCenter').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        
        $(".confirm_button").removeClass("done");
        $(this).find('form').attr('action',$("#items_store_route").val());

    });
    $('#expiredModal').on('hidden.bs.modal', function () {
        $('#expired_form').trigger('reset');
        

    });
    
    

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
    });
    

    $("body").on("click",".itemsinorder",function() {
            var result = null;
            var id = $(this).attr("data-id");
          
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
    
    
    
    
                $("#mytable").find(".filled").empty();
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
            $(".TotalItemsInOrderPopup table").addClass("filled");
    
            $(".TotalItemsInOrderPopup table").append(table.html());
        
    
        
        $(".TotalItemsInOrderPopupContainer").fadeIn();
    });
    
    $(".confirm_button").click(function () {
            if ($(this).hasClass("done")) {
                var object = {};

                object["quantity"] = $("#quantity").val();
                object["buying_price"] = $("#buying_price").val();
                object["selling_price"] = $("#selling_price").val();
                object["size"] = $("#size").val();
                object["_method"] = "PUT";


                var url = $("#form").attr("action");
                var result = null;
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
                        console.log(result)
                        var temp = $("#" + result.id);
                        temp.find(".quantity").text(result.quantity);
                        temp.find(".buying_price").text(result.buying_price);
                        temp.find(".selling_price").text(result.selling_price);
                        temp.find(".size").text(result.size);
                        alert("تم التعديل");
                        $('#exampleModalCenter').modal('hide');

                    },
                    error: function (data) {
                        //alert('عفوا هذه الفاتورة غير متوفرة هنا');
                        return false;
                    }
                })) {

                }

            } 

                 else if( validate(["all"],[["null_input"]])){
                     
                
                    $("#submit_button").click();
    
    
                }
                else if( validate(["all"],[["null_input"]])==false){
                    alert("من فضلك راجع الخانات باللون الاحمر");
                }


            
        }
    )

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

    


</script>
<script src="{{asset("js/popper.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>
<script type="module" src="{{asset("js/order-reciept.js")}}"></script>

</body>
</html>
