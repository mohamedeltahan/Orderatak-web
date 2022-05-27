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
    <title>مرتجعات</title>
    <style>
      /*  .odd{
            background:darkgray;

        }
        .even{
            background: gainsboro;
        }*/
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
<input style="display: none" value="" id="target_link">
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
            <li class="breadcrumb-item" aria-current="page"><a href="{{route("home")}}"> الصفحة الرئيسية </a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{route("restoreds.index")}}"> مرتجعات </a></li>

    @endsection
    @include("sidebars.navbar")
    <!---end of navbar !-->

    <ul class="nav nav-pills nav-fill" style="padding-bottom: 50px">
        <li class="nav-item" style="margin:5px;">
          <a class="nav-link @if($flag_that_all_items_are_passed==="true")) active_store @else not_active_store @endif" href="{{route('restoreds.index')}}" style="border-radius:1.24rem">كل المخازن</a>
        </li>
        @foreach ($stores as $store)
        <li class="nav-item" style="margin:5px;  ">
            <a class="nav-link @if($flag_that_all_items_are_passed==$store->id) active_store @else not_active_store @endif" href="{{route('restoreds.index')}}?store_id={{$store->id}}" style="border-radius:1.24rem">{{$store->name}}</a>
          </li>
        @endforeach
       
        
      </ul>

        <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--system transaciont container-->
        <div class="exports_cases" style="width: 80%; display: inline-flex; margin-left: 10%;" >
            <div class="cases first_case" style="width: 33%;">
                <div class="cards"  style="">

                    <div class="card-body" style="display: flex; padding: 0px;" >
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i style="color: yellowgreen;" class="fas fa-undo-alt fa-4x"></i></div>


                        <a  style="width: 100%;height: 100%;padding: 12px 9px; display: inline-grid;"href="#" class="btn " >
                            <span style="font-weight: bold">{{$restored_quantity}}</span>
                            <span style="font-weight: 900;font-size: 20px;color: yellowgreen;">قطعة مسترجعة</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="cases first_case" style="width: 33%;">
                <div class="cards" >

                    <div class="card-body" style="display: flex; padding: 0px">
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i  style="color: red;" class="fas fa-exclamation-triangle fa-4x"></i></div>

                        <a  style="width: 71%;height: 100%;padding: 12px 9px; display: inline-grid;"href="#" class="btn " >
                            <span style="font-weight: bold">{{$unconfirmed_restored}}</span>
                            <span style="font-weight: 900;font-size: 20px;color: red">مرتجع لم يتم تاكيده</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="cases first_case" style="width: 33%;">
                <div class="cards" >

                    <div class="card-body" style="display: flex; padding: 0px">
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i style="color: blue;" class="fas fa-check-circle fa-4x"></i></div>

                        <a  style="width: 71%;height: 100%;padding: 12px 9px; display: inline-grid; "href="#" class="btn " >
                            <span style="font-weight: bold">{{$confirmed_restored}}</span>
                            <span style="font-weight: 900;font-size: 20px; color: blue;">مرتجع تم تاكيده</span>
                        </a>
                    </div>
                </div>
            </div>



        </div>
        <table id="example" class="ui celled table" style="text-align: center" dir="ltr"   >
            <thead >
            <tr >
                <th style="background: lightseagreen; color: white;">تاكيد</th>
                <th style="background: lightseagreen; color: white;" >سبب الاسترجاع</th>
                <th style="background: lightseagreen; color: white;" >تاريخ الاسترجاع</th>
                <th style="background: lightseagreen; color: white;" >اسم العميل</th>

                <th style="background: lightseagreen; color: white;" >رقم الفاتورة</th>
                <th style="background: lightseagreen; color: white;">الكمية</th>
                <th style="background: lightseagreen; color: white;">مقاس</th>
                <th style="background: lightseagreen; color: white;">اللون</th>
                <th style="background: lightseagreen; color: white;">الكود</th>
                <th style="background: lightseagreen; color: white;">الصنف</th>


            </tr>
            </thead>
            <tbody>
            @foreach($restoreds as $restored)
                <tr style="font-weight: 500">
                    <td class="rest-{{$restored->id}}" >
                        @if($restored->confirmed==0)
                            <i class="fas fa-check-circle"></i>
                            <a class="link" href="{{route("confirm_restored",$restored->id)}}"> <span class="clickable"></span></a>
                        @else
                             تم الاسترجاع
                        @endif
                    </td>
                    <td >{{$restored->reason}}</td>
                    <td>{{$restored->created_at}}</td>

                    <td >{{$restored->get_customer()->name}}</td>

                    <td >{{$restored->order_id}}</td>

                    <td>{{$restored->quantity}}</td>
                    <td >{{$restored->size}}</td>

                    <td>{{$restored->name->color}}</td>
                    <td>{{$restored->name->code}}</td>
                    <td>{{$restored->name->name}}</td>
                </tr>
            @endforeach

            </tbody>

        </table>

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="    border: 4px solid gainsboro;  border-radius: 2.24rem;">
                    <div class="modal-header" dir="ltr">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 30px">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height: auto;    font-weight: bold;text-align: center;padding: 38px;">
                       هل تريد تاكيد استلام هذا المرتجع من شركة الشحن ؟
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
                        <button type="button" class="btn btn-primary confirm" >تاكيد</button>
                    </div>
                </div>
            </div>
        </div>


            <!--End body container-->
        </div>
    </div>
<!-- Modal -->


<script  src="{{asset("js/jquery-3.4.1.min.js")}}"></script>
<script src="{{asset("js/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("js/dataTables.semanticui.min.js")}}"></script>
<script src="{{asset("js/semantic.min.js")}}"></script>



<script >
    $(document).ready(function() {

        $('#example').DataTable({
            "paging":   false,

            aaSorting: [],
            "language": {
                "lengthMenu":  "",
                "zeroRecords": "لا يوجد نتيجة بحث مطابقة",
                "info":  "",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from _MAX_ total records)",

            }

        });
        var temp=$(".grid .row:last");
        var x=$("<button  style='position: absolute;right: 50%;background: lightseagreen;border: none;border-radius: 1.24rem;' class='btn btn-primary'>عرض المزيد</button>");

        temp.html(x);
        $("#example_wrapper").css("padding","43px");
        $("#example_wrapper").attr("dir","ltr");

        $("#example_filter").attr("dir","rtl");

        /* x=$("<button id='modal_button' data-target='#exampleModalCenter' data-toggle='modal' class='btn btn-primary' style='border: none; background: lightseagreen;border-radius: 1.24rem;'><i class='fas fa-user-plus fa-2x' ><span style='padding: 14px;font-size: 17px'>اضافة عميل</span></i></button>");
         $(".ui .row:first .eight:first ").html(x);*/
    } );
    $(document).on("click",".fa-check-circle",function () {
        //get the table tr which contain customer data
        $("#target_link").val($(this).parent().find("a").attr("href"));

        $('#exampleModalCenter').modal('show');
    });
    $(".confirm").click(function () {
      var url=$("#target_link").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if ($.ajax({
            url: url,
            type: "get",
            async: false,
            //request data
            //data: object,
            success: function (r) {
                $(".rest-"+r).text("تم الاسترجاع");

            $('#exampleModalCenter').modal('hide');

            },
            error: function (data) {
                alert('عفوا لم يسبق التعامل في هذا المنتج');
                return false;
            }
        })) {

        }
    })
    $('#exampleModalCenter').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $(this).find(".hidden_phone").remove();
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






</script>
<script src="{{asset("js/popper.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>

</body>
</html>
