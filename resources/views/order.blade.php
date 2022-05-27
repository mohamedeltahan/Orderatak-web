<!DOCTYPE html>
<html lang="en">
<head>
    @include("includes.exporter_head")
    <link rel="stylesheet" href="{{asset("css/order.css")}}">

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
        <div class="name co-6"><span></span></div>
        <div class="countity co-2">
            <button class="decress" onclick="decreas(this.id)">
                <i class="fas fa-minus" ></i>
            </button>
            <input type="text" value="1" placeholder="1">
            <button class="incress" onclick="increas(this.id)">
                <i class="fas fa-plus"></i>
            </button>
        </div>
        <div class="price co-2">
            <span><span class="mainprice"></span><span class="sign">$</span></span>
        </div>
        <div class="delete co-1" id="s" onclick="deleteorder(this.id)">
            <i class="fas fa-trash-alt"></i>
        </div>
    </div>
</div>
<div class="layout-container-fluid">
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--start side menu component-->
    <div class="menu-side-container">
        <div class="page-title">
            <span>الموردين</span>
        </div>
        <div class="user-info">
            <div class="user-img-container">
                <img src="./imges/mo1.jpg" alt="user">
                <span>Muhamed Reda</span>
            </div>
        </div>
        <div class="system-categories" id="menu-categories">
            <ul>
                <li><a href="#"><i class="fas fa-sign-out-alt"></i>الصفحة الرئيسية</a></li>
                <li><a href="clients.html"><i class="fas fa-sign-out-alt"></i>العملاء</a></li>
                <li><a href="exporters.html"><i class="fas fa-sign-out-alt"></i>الموردين</a></li>
                <li class="hover"><a href="#"><i class="fas fa-sign-out-alt"></i>الاوردرات</a></li>
                <li><a href="#"><i class="fas fa-sign-out-alt"></i>الاعدادات</a></li>
            </ul>
        </div>
    </div>
    <!--End side menu component-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--start body container-->
    <div class="body-content-container">
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--start navbar component-->
        <div class="navbar-container col-12">
            <div class="nav-bar col-12">
                <ul class="user-list">
                    <li class="user-img">
                        <img src="./imges/mo1.jpg" alt="">
                    </li>
                    <li class="notification">
                        <i class="fas fa-bell"></i>
                    </li>
                </ul>
            </div>
            <!--=================================-->
            <!--=================================-->
            <!--Start user nav list-->
            <div class="user-nav-list">
                <ul>
                    <li><i class="fas fa-sign-out-alt"></i><a href="#">الصفحة الرئيسية</a></li>
                    <li><i class="fas fa-sign-out-alt"></i><a href="#">الاعدادات</a></li>
                    <li><i class="fas fa-sign-out-alt"></i><a href="#">تسجيل الخروج</a></li>
                </ul>
            </div>
            <!--End user nav list-->
            <!--=================================-->
            <!--=================================-->
            <!--Start user notification list-->
            <div class="user-notification-list">
                <ul class="notification-list">
                    <!--=================================-->
                    <!--=================================-->
                    <li class="noti">
                        <ul>
                            <li class="noti-img">
                                <img src="./imges/mo1.jpg" alt="">
                            </li>
                            <li class="noti-description">
                                <p>قام محمد بإضافه 25 قطعه قام محمد بإضافه 25 قطعه قام محمد بإضافه 25 قطعه قام محمد بإضافه 25 قطعه قام محمد بإضافه 25 قطعه</p>
                                <span>from 25m ago</span>
                            </li>
                        </ul>
                    </li>
                    <!--=================================-->
                    <!--=================================-->
                    <li class="noti">
                        <ul>
                            <li class="noti-img">
                                <img src="./imges/mo1.jpg" alt="">
                            </li>
                            <li class="noti-description">
                                <p>قام محمد بإضافه 25 قطعه قام محمد بإضافه 25 قطعه قام محمد بإضافه 25 قطعه قام محمد بإضافه 25 قطعه قام محمد بإضافه 25 قطعه</p>
                                <span>from 25m ago</span>
                            </li>
                        </ul>
                    </li>
                    <!--=================================-->
                    <!--=================================-->
                </ul>
                <div class="noti-footer">
                    <a href="#">Show more</a>
                </div>
            </div>
            <!--End user notification list-->
        </div>
        <!--End navbar component-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <div class="settingcontainer">
            <div class="foodcategoriescontainer">
                <div class="foodcategories co-11">
                    <ul id="foodcategories">
                        <li>meats</li>
                        <li>chicken</li>
                        <li>pizza</li>
                        <li>meals</li>
                        <li>salads</li>
                        <li>drinks</li>
                        <li>snikers</li>
                        <li>sweets</li>
                    </ul>
                </div>
            </div>
            <div class="itemscontainer co-7">
                <div class="search">
                    <form action="" id="searchbox">
                        <input type="search" placeholder="What Are You Looking For ?">
                    </form>
                </div>
                <div class="productcategories" id="productcontainer">
                    @foreach($items as $item)
                    <div class="product meats" id="{{$item->id}}" style="width:150px;">
                        <div class="productinfo">
                            <span class="productname" data-id="{{$item->id}}">{{$item->name->name.":".$item->name->code.":".$item->name->color}}</span><br><br>
                            <span class="size">{{$item->size}}</span><br><br>
                            <span style="margin-top: 10px;"  class="productprice"><span class="sign"></span> <span dir="rtl" class="proprice">@if($item->quantity==0)0 @else{{$item->selling_price}} @endif</span></span>
                        </div>
                        <div class="overlay">
                            <span class="amount">{{$item->quantity}}</span>
                            <!--This if only counter and it will not display in the screen-->
                            <span class="ordercounter" style="display: none">1</span>
                        </div>
                    </div>
                        @endforeach
                </div>
            </div>
            <!--=================================-->
            <!--end items-->
            <!--=================================-->
            <!--start dashboard-->
            <div class="setting co-5">
                <div class="clientinfocontainer">
                    <div class="clientinfo">
                        <form id="receiptclientinfoform">
                            <input type="number" placeholder="Client Number" class="defv" id="clientnumber">
                            <div class="expectedlist" id="expectedlist">
                                <ul>
                                    @foreach($customers as $customer)
                                    <li>
                                        <span id="{{$customer->id}}" class="clientname">{{$customer->name}}</span>
                                        <span  class="clientnumber"> {{$customer->get_phones()[0]}}</span>
                                        <span style="display: none"  class="clientaddress"> {{$customer->address}}</span>

                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <input type="text" placeholder="Client Name" id="clientname" name="clientname">
                            <input type="text" id="client_address" placeholder="Client Adress" class="deff"><br>

                        </form>
                    </div>
                    <div class="orderscontainer" id="ordercontainer">
                        <form style="display: none" id="hiddenform" method="post" action="{{route("orders.store")}}">
                            @csrf
                            <input name="total_price_after_discount" class="total_price_after_discount">
                            <input name="discount" class="discount">
                            <input type="date" name="receiving_date" class="receiving_date">
                            <input name="customer_id" id="customer_id">
                            <input class="client_address" name="address">

                            <button type="submit" id="submithiddenform"></button>
                        </form>
                    </div>
                    <div class="receipt">
                        <input style="border: 0;
  border-bottom: solid 1px #9ACD32;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  -o-border-radius: 4px;
  -ms-border-radius: 4px;
  border-radius: 4px;
  padding: 10px;
  font-size: 14px;
  margin-bottom: 10px;
  width: 25%;
  float: left;
  margin-left: 4%;
  text-align: right;" type="number" placeholder="خصم"  class="defv" id="discount">
                        <input style="border: 0;
  border-bottom: solid 1px #9ACD32;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  -o-border-radius: 4px;
  -ms-border-radius: 4px;
  border-radius: 4px;
    margin-bottom: 10px;

  padding: 10px;
  font-size: 14px;
  width: 48%;
  float: right;
  text-align: right;"  placeholder="تاريخ التسليم" type="text" onfocus="(this.type='date')" id="receiving_date" name="receiving_date">
                        <div class="line">
                        </div>
                        <div class="line">
                            <span id="discount_val" class="span2">اجمالي الخصم :0 جنيه</span>
                            <span style="margin-left: 25px" class="span1">عدد : <span class="numberOfOrders">0</span></span>

                        </div>
                        <div class="line receipttotalprice">
                            <span class="span2" style=" visibility: hidden; border-bottom:solid 1px #cfcfcf;">price : <span class="ordersprice">0</span>جنيه</span><br><br>
                            <span style="margin-left: 25px" class="span1"> <span id="">اجمالي: </span> <span id="total_price_after_discount" class="recieptsprice">0</span>جنيه<span></span></span>
                            <button id="sumbitreciepts">submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--end dashboard-->
            <!--=================================-->
        </div>
    </div>
    <!--End body container-->
</div>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{asset("js/navbar.js")}}"></script>
<script src="{{asset("js/script.js")}}"></script>
</body>
</html>
