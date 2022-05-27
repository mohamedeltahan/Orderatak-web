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
    <title>المخزن</title>
    <style>
        body{
            background: #f7f7f7;
            font-size: 17px;



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
        button{
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
            <li class="breadcrumb-item" aria-current="page"><a href="{{route("items.index")}}"> منتجات المخزن </a></li>

    @endsection
    @include("sidebars.navbar")
    <!---end of navbar !-->


        <!---start of content !-->
        
    <div class="form-group row" style="width: 100%">
                <label class="sr-only" >Username</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend" style="margin-right: 30%">
                    <div class="input-group-text" style="font-weight: 700; padding: 10px;"> اختر مخزن لعرض منتجاته</div>

                    </div>
                    <select name="type" id="stores_list" style="width: 28%">
                                   
            <option @if($flag_that_all_items_are_passed==="true")  selected  @endif data-link="{{route('items.index')}}"> كل المخازن</option>
            

                @foreach(App\Store::all() as $store)
            <option data-link="{{route('items.index')}}?store_id={{$store->id}}" @if($flag_that_all_items_are_passed==$store->id) selected @endif> {{$store->name}}</option>
                @endforeach
            </select>

                 </div>
            </div>
        
        <div class="exports_cases" style="width: 80%; display: inline-flex; margin-left: 10%" >
            <div class="cases first_case" style="width: 33%;">
                <div class="cards"  style="">

                    <div class="card-body" style="display: flex; padding: 0px;" >
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i style="color: yellowgreen;" class="fas fa-box-open fa-4x"></i></div>


                        <a  style="width: 100%;height: 100%;padding: 12px 9px; display: inline-grid;"href="#" class="btn " >
                            <span style="font-weight: bold">{{$items_count}}</span>
                            <span style="font-weight: 900;font-size: 20px">اجمالي اصناف</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="cases first_case" style="width: 33%;">
                <div class="cards" >

                    <div class="card-body" style="display: flex; padding: 0px">
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i  style="color: blue;" class="fas fa-boxes fa-4x"></i></div>

                        <a  style="width: 71%;height: 100%;padding: 12px 9px; display: inline-grid;"href="#" class="btn " >
                            <span style="font-weight: bold">{{$items_sum}}</span>
                            <span style="font-weight: 900;font-size: 20px">اجمالي قطع</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="cases first_case" style="width: 33%;">
                <div class="cards" >

                    <div class="card-body" style="display: flex; padding: 0px">
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i style="color: green;" class="fas fa-dollar-sign fa-4x"></i></div>

                        <a  style="width: 71%;height: 100%;padding: 12px 9px; display: inline-grid; "href="#" class="btn " >
                            <span style="font-weight: bold">{{$items_overall_price}}</span>
                            <span style="font-weight: 900;font-size: 20px">اجمالي المبلغ</span>
                        </a>
                    </div>
                </div>
            </div>



        </div>
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

            <th style="background: #5C71A3; color: white;" >الصنف</th>
            <th style="background: #5C71A3; color: white;">الكود</th>
            <th style="background: #5C71A3; color: white;">اللون</th>
            <th style="background: #5C71A3; color: white;">مقاس</th>
                <th style="background: #5C71A3; color: white;">كمية</th>

                <th style="background: #5C71A3; color: white;">سعر الشراء</th>
            <th style="background: #5C71A3; color: white;">سعر البيع</th>
            <th style="background: #5C71A3; color: white;"> اجمالي المبلغ</th>
            <th style="background: #5C71A3; color: white;">اهلاك</th>

            <th style="background: #5C71A3; color: white;">تعديل</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)

                <tr  id="{{$item->id}}" data-nameid="{{$item->name->id}}" data-route="{{route("items.update",$item->id)}}" style="font-weight: 500">
                <td class="name">{{$item->name->name}}</td>
                <td class="code">{{$item->name->code}}</td>
                <td class="color">{{$item->name->color}}</td>
                <td class="size">{{$item->size}}</td>
                <td class="quantity">{{$item->quantity}}</td>
                <td class="buying_price">{{$item->buying_price}}</td>
                <td class="selling_price">{{$item->selling_price}}</td>
                <td class="" >{{$item->quantity*$item->buying_price}}</td>
                <td ><i class="fas fa-recycle recycle"></i></i>
                <td ><i  class="fas fa-edit edit"></i>




            </tr>
                @endforeach

            </tbody>

        </table>


        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="    border: 4px solid gainsboro;  border-radius: 2.24rem;">
                    <div class="modal-header" dir="ltr">
                        <h5 class="modal-title" id="exampleModalLongTitle" style="direction:rtl; margin-left: 37%;margin-top: 6%"><i class="fas fa-box-open fa-2x" style="padding-right: 10px"></i><span class="text">اضافة صنف</span>  </h5>
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
                                    <input name="buying_price"  id="buying_price" min="0" onkeypress="return event.charCode >= 48" type="number" class="form-control all" placeholder="ادخل سعر الشراء">
                                </div>
                                <div class="input-group mb-2 mr-sm-2" style="width: 49%">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">سعر بيع</div>
                                    </div>
                                    <input name="selling_price"  id="selling_price" min="0" onkeypress="return event.charCode >= 48"  type="number" class="form-control all" placeholder="ادخل سعر البيع">
                                </div>
                            </div>
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">كمية</div>
                                    </div>
                                    <input  name="quantity" id="quantity" min="1"  onkeypress="return event.charCode >= 48" type="number" class="form-control all" placeholder="ادخل الكمية المضافة">
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
                        <h5 class="modal-title" id="exampleModalLongTitle" style="direction:rtl; margin-left: 37%;margin-top: 6%"><i class="fas fa-box-open fa-2x" style="padding-right: 10px"></i>اهلاك صنف  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 30px">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height: auto">
                        @if($flag_that_all_items_are_passed==="true")
                        <form method="post" action="{{route("expireds.store")}}" id="expired_form">

                        @else
                        <form method="post" action="{{route("expireds.store")}}?store_id={{$flag_that_all_items_are_passed}}" id="expired_form">

                        @endif
                            @csrf
                            <div class="form-group row d-none" style="width: 100%">
                                <input name="name_id" id="name_id" value="">

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

        $('#example').DataTable({
            "paging":   true,

            aaSorting: [],
            "language": {
                "lengthMenu":  "",
                "zeroRecords": "لا يوجد نتيجة بحث مطابقة",
                "info":  "",
                "infoEmpty": "",
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

        $("#example_filter").attr("dir","rtl");

         x=$("<button id='modal_button' data-target='#exampleModalCenter' data-toggle='modal' class='btn btn-primary' style='border: none; background: #5C71A3;border-radius: 1.24rem;'><i class='fas fa-box-open fa-2x' ><span style='padding: 14px;font-size: 17px'>اضافة صنف</span></i></button>");
         $(".ui .row:first .eight:first ").html(x);
   
   
   
         $("#expired_quantity").keyup(function () {
            
            if(parseInt($(this).val())>parseInt($(this).attr("data-quantity")) || $(this).val().length==0 || parseInt($(this).val())<1){
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
        $('#exampleModalCenter .modal-title .text').text("تعديل صنف");
        $('#exampleModalCenter .confirm_button').text("حفظ");

        $(".details-popup-container").fadeIn();


        $("#phone").parent().parent().css("display","none");
        $('#exampleModalCenter').modal('show');
    });
    $('#exampleModalCenter').on('hidden.bs.modal', function () {
        
        $('#exampleModalCenter .modal-title .text').text("اضافة صنف");

        $('#exampleModalCenter .confirm_button').text("اضافة");
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
    })
    $(".confirm_button").click(function () {
            if ($(this).hasClass("done")) {
                var object = {};
                
                if(! validate(["all"],[["null_input"]])){
                  alert("من فضلك راجع الخانات باللون الاحمر");
                  return 0;
                }

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
                        result = JSON.parse(r);
                        console.log(result)
                        var temp = $("#" + result.data.item.id);
                        temp.find(".quantity").text(result.data.item.quantity);
                        temp.find(".buying_price").text(result.data.item.buying_price);
                        temp.find(".selling_price").text(result.data.item.selling_price);
                        temp.find(".size").text(result.data.item.size);
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

$(document).on("change","#stores_list",function () {
         window.location.href = $(this).find("option:selected").attr("data-link");

    });


</script>
<script src="{{asset("js/popper.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>

</body>
</html>
