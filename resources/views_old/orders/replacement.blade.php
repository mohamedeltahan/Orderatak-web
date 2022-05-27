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
    <title>استبدال</title>

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
            <button class="decress" onclick="decreas(this.id)">
                <i class="fas fa-minus" ></i>
            </button>
            <input type="text" value="1" placeholder="1">
            <button class="incress" onclick="increas(this.id)">
                <i class="fas fa-plus"></i>
            </button>
        </div>
        <div class="price co-3">
            <span><span class="mainprice"></span><span class="sign">ج.م</span></span>
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
            <li class="breadcrumb-item active" aria-current="page" ><a href="{{route("orders.index")}}"> فواتير بيع </a></li>
            <li class="breadcrumb-item" ><a href=""> استبدال فاتورة بيع رقم {{$order->id}}</a></li>

    @endsection
    @include("sidebars.navbar")
    <!---end of navbar !-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <div class="settingcontainer">

                <div class="itemscontainer co-7">
                    <div class="search">
                        <form action="" id="searchbox">
                            <input dir="rtl" type="search" placeholder="بحث">
                        </form>
                    </div>
                    <div class="productcategories" id="productcontainer" style="height: 721px">
                        <div id="accordion">
                            @foreach($items as $key=>$value)

                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                                {{$key}}
                                            </button>
                                        </h5>
                                    </div>


                                    <div id="{{$key}}" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div id="accordion1">
                                                @foreach($value as $color=>$items)

                                                    <div class="card">
                                                        <div class="card-header" id="headingOne">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link" data-toggle="collapse" data-target="#{{$color.$key}}" aria-expanded="true" aria-controls="collapseOne">
                                                                    {{$color.$key}}
                                                                </button>
                                                            </h5>
                                                        </div>

                                                        <div id="{{$color.$key}}" class="collapse " aria-labelledby="headingOne" data-parent="">
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
                                                                            <td><a  data-toggle="popover" data-placement="left" data-trigger="hover" title="Popover title" data-content="الكمية المتبقية {{$item->quantity}}">الكمية المتبقية</a>
                                                                            </td>
                                                                            <td>{{$item->name->name}}</td>
                                                                            <td>{{$item->name->color}}</td>
                                                                            <td style="display: none">
                                                                                <span class="ordercounter">1</span>
                                                                                <span style="margin-top: 10px;"  class="productprice"><span class="sign"></span> <span dir="" class="proprice"><span class="real_price" style="display: none">@if($item->quantity==0)0 @else{{$item->price()}} @endif</span>{{$item->price()}}  </span><span>: سعر</span></span>

                                                                                <span class="amount">{{$item->quantity}}</span></td>
                                                                            <td class="productname" data-id="{{$item->id}}">{{$item->name->code}}</td>
                                                                            <td class="size">{{$item->size}}</td>
                                                                            <td>{{$item->selling_price}}<span>ج.م </span>


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

                <!--=================================-->
                <!--end items-->
                <!--=================================-->
                <!--start dashboard-->
                <div class="setting co-5" style="height: 861px">
                    <div class="clientinfocontainer">
                        <div class="clientinfo">
                            <form id="receiptclientinfoform">
                                <input value="{{$customer->phones()->first()->phone}}" readonly  type="text" placeholder="رقم العميل" data-length="11" class="defv all paste" id="clientnumber">
                                <div class="expectedlist" id="expectedlist">
                                    <ul>

                                    </ul>
                                </div>
                                <input value="{{$customer->name}}" readonly class="all" type="text" placeholder="اسم العمبل" id="clientname" name="clientname">
                                <input value="{{$customer->addresses()->first()->address}}" readonly type="text" placeholder="عنوان العميل" id="client_address"  class="deff all"><br>
                                <div class="expectedlist" id="expectedlist2" style=" top: 75px;">
                                    <ul id="address_ul">



                                    </ul>
                                </div>
                                <input value="{{$customer->facebook_username}}"  readonly class="all defv" type="text" placeholder="لينك الفيسبوك" id="facebook_username" name="facebbok_username">
                                <input value="{{$customer->governorate}}" readonly type="text" placeholder="محافظة" id="govornorate"  class="rdev all"><br>

                                <select style="" type="text" id="district" placeholder="Client Adress" class=" rdev all">
                                    <option value="0" data-cost="0">اخنر منطفة الشحن</option>
                                    @foreach($districts as $district)
                                        <option value="{{$district->id}}" data-cost="{{$district->cost}}">{{$district->name}}</option>
                                    @endforeach

                                </select>
                                <br>
                                <input type="text" placeholder="ملاحظة" id=""  class="defv  note"><br>
                                <input type="number" name="restored_quantity"  data-quantity="{{$order_item->quantity}}" placeholder="الكمية المستبدلة" id="restored_quantity"  class="rdev" style="float: right;
    width: 112px;
    margin-top: 20px;" ><br>
                                <select   id="received"  class="defv" style="float: left;     border: 0;
    border-bottom: solid 1px lightseagreen;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    -o-border-radius: 4px;
    -ms-border-radius: 4px;
    border-radius: 4px;
    padding: 4px;
    font-size: 14px;
    margin-bottom: 15px;
    width: 62%;
    float: left;
    margin-left: 4%;
    text-align: right; height: 41px; ">         <option value="0">لم يتم اللاستلام من شركة الشحن بعد</option>

                                    <option value="1">تم الاستلام من شركة الشحن</option>
                                </select><br>

                            </form>
                        </div>
                        <div class="orderscontainer" id="ordercontainer">
                            <table style="width: 100%; direction: ltr"><tr style="width: 100%; background-color: lightseagreen"><th style="width: 2%" >مقاس</th><th style="width: 23%; text-align:center" >صنف</th> <th style="width: 25%" >كمية</th > <th style="width: 9%">سعر</th> <th style="width: 10%; "></th></tr></table>
                            <form style="display: none" id="hiddenform" method="post" action="{{route("replacement")}}">
                                @csrf
                                <input name="item_id" value="{{$order_item->id}}">

                                <input name="total_price_after_discount" class="total_price_after_discount">
                                <input name="discount" class="discount">
                                <input type="date" name="receiving_date" class="receiving_date">
                                <textarea name="details" class="details">
                            </textarea>
                                <input name="customer_id" id="customer_id" value="{{$customer->id}}">
                                <input class="client_address" name="address">
                                <input class="client_name" name="name">
                                <input class="client_phone" name="phone">
                                <input class="client_governorate" name="governorate">
                                <input class="client_facebook" name="facebook_username">
                                <input type="number" class="restored_quantity" name="restored_quantity"   ><br>

                                <input class="district_cost" name="delivery_cost">
                                <input class="received" name="received">
                                <button type="submit" id="submithiddenform"></button>
                            </form>
                        </div>
                        <div class="receipt">

                            <input   type="number" placeholder="خصم"  class="defv discount" id="discount">
                            <input   placeholder="تاريخ التسليم" type="text" class="date" onfocus="(this.type='date')" id="receiving_date" name="receiving_date">
                            <div class="line">
                            </div>
                            <div class="line">
                                <span id="discount_val" class="span2">اجمالي الخصم :0 جنيه</span>
                                <span style="margin-left: 25px" class="span1">عدد : <span class="numberOfOrders">0</span></span>

                            </div>
                            <div class="line receipttotalprice">
                                <span dir="ltr" class="span2" style="  border-bottom:solid 1px #cfcfcf;"><span>مصاريف الشحن:</span> <span class="district_price"> 0 </span> <span> جنيه </span></span> <br><br>
                                <span style="margin-left: 25px" class="span1"> <span id="">اجمالي: </span> <span id="total_price_after_discount" class="recieptsprice">0</span>جنيه<span></span></span>
                                <button id="sumbitreciepts">تاكيد</button>
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
</div>
<div class="add-popup-container">
    <div class="close-popup">
        <i class="fas fa-times"></i>
    </div>
    <div class="add-popup">


        <div class="input-group mb-3">
                <textarea dir="rtl" type="number"  id="textarea" name="reason" class="form-control" placeholder="ادخل ملاحظة اذا وجد" aria-describedby="basic-addon1">
                </textarea>
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">ملاحظة علي الطلب</span>
            </div>
        </div>

        <div class="form-action">
            <button id="done">إضافة</button>
            <button class="close-pop">إلغاء</button>
        </div>
        </form>
    </div>
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
    $(function () {
        $('[data-toggle="popover"]').popover({ trigger: 'hover'})
    })
</script>

</body>
</html>
