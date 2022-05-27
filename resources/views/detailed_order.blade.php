<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{csrf_token()}}">
<link rel="stylesheet" href="{{asset("fontawesome-free-5.11.2-web/css/all.min.css")}}">
<link rel="stylesheet" href="{{asset("css/style.css")}}">
<link rel="stylesheet" href="{{asset("css/semantic.min.css")}}">
<link rel="stylesheet" href="{{asset("css/dataTables.semanticui.min.css")}}">
<link rel="stylesheet" href="{{asset("css/bootstrap.css")}}">
<title>تفاصيل اليوم</title>
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

<body>

<div class="wrapper d-flex align-items-stretch" dir="rtl">

    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--start side menu component-->
    @section('content')
        <li class="breadcrumb-item" aria-current="page"><a href="{{route("home")}}"> الصفحة الرئيسية </a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="{{route("orders.index")}}"> مبيعات </a></li>

@endsection
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

    @include("sidebars.navbar")
    <!---end of navbar !-->

        <!--End navbar component-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--system transaciont container-->
        <div style="height: 12%; width: 80%; background-color: white; margin-right: 10%; border-radius: 1.24rem">
            <div style="position: relative;top:38%;margin-left: 29%"  >
                <i style="color: darkgreen;" class="fas fa-money-check-alt fa-2x">
                        <span >الاصناف المباعة في يوم <i class="">{{$date}}</i> </span>
                    </i>
            </div>

        </div>





            <div class="transactions-container">
                <table id="example" class="ui celled table table-fixed" style="text-align: center;font-weight: 500;" dir="rtl"    >
                    <thead>
                    <tr >
                        <th style="background: #5C71A3; color: white;">الصنف</th>
                        <th style="background: #5C71A3; color: white;">المقاس</th>
                        <th style="background: #5C71A3; color: white;">الكمية</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($last_arr as $key=>$item)
                        @foreach($item  as $i=>$k)
                            @if($k!=0)
                                <tr >
                                    <td  style="border-left: 1px solid rgba(34,36,38,.1);">{{$key}}</td>
                                    <td  class="selling_price">{{$i}}</td>
                                    <td class="selling_price">{{$k}}</td>

                                </tr>
                            @endif
                        @endforeach
                    @endforeach

                    </tbody>

                </table>
            </div>


            <!--End body container-->
        </div>
    </div>


    <!-- details popup -->
    <div class="details-popup-container">
        <div class="close-popup">
            <i class="fas fa-times"></i>
        </div>
        <div class="details-popup">
            <div class="details">
                <form id="form" method="post" action="">
                    @csrf
                    @method("PUT")
                    <div class="inp-cont" style="margin: 20px; margin-right: 50px;">
                        <div class="inp-name">
                            <span> <span id="name" style=" margin-right: 69px;">ddd</span>   :  الصنف   </span>
                        </div>

                    </div>
                    <div class="inp-cont" style="margin: 20px; margin-right: 69px;">
                        <div class="inp-name">
                            <span><span style=" margin-right: 64px;" id="code">ddd</span>    :  الكود  </span>
                        </div>
                    </div>
                    <div class="inp-cont" style="margin: 20px; margin-right: 65px;">
                        <div class="inp-name">
                            <span> اللون  :<span style=" margin-right: 69px;" id="color">ddd</span>   </span>
                        </div>
                    </div>
                    <div class="inp-cont" style="margin: 20px;margin-right: 59px;">
                        <div class="inp-name">
                            <span>   <input id="quantity" name="quantity" type="number"  style="border:none;width:40px;text-align: center;border: dashed 1px grey; width: 154px; ">: الكمية</span>
                        </div>
                    </div>
                    <div class="inp-cont" style="margin: 20px;margin-right: 59px;">
                        <div class="inp-name">
                            <span>   <input id="size" name="size" type="number"  style="border:none;width:40px;text-align: center;border: dashed 1px grey; width: 154px; ">: مقاس</span>
                        </div>
                    </div>
                    <div class="inp-cont" style="margin: 20px; margin-right: 28px;">
                        <div class="inp-name">
                            <span> <input id="buying_price" name="buying_price" type="text"  style="border:none;width:40px;text-align: center;    border: dashed 1px grey; width: 154px; ">: سعر الشراء </span>
                        </div>

                    </div>
                    <div class="inp-cont" style="margin: 20px; margin-right: 35px;">
                        <div class="inp-name">
                            <span>     <input  id="selling_price" name="selling_price" type="text"  style="border:none;width:40px; text-align: center;    border: dashed 1px grey;   width: 154px; ">: سعر البيع</span>
                        </div>

                    </div>
                    <button style="margin-right: 124px;width: 110px;">حفظ</button>
                </form>

            </div>
        </div>
    </div>


<script  src="{{asset("js/jquery-3.4.1.min.js")}}"></script>
<script src="{{asset("js/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("js/dataTables.semanticui.min.js")}}"></script>
<script src="{{asset("js/semantic.min.js")}}"></script>


<script src="{{asset("js/popper.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>

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
        $("#example_wrapper").css("padding","43px");
        $("#example_wrapper").attr("dir","ltr");

        $("#example_filter").attr("dir","rtl");

    } );
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

            } else {
                $("#submit_button").click();


            }
        }
    )






</script>


</body>
</html>
