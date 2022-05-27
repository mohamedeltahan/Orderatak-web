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
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1094779117668579');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1094779117668579&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
<title>الصفحة الرئيسية</title>
<style>
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
        float: right;
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



<body>
<div id="statstics-items" style="display: none;">
    @foreach($items_count as $item_count)
        <div class="items">
            <div class="name">مقاس{{$item_count->size."- كود".$item_count->name->code}}</div>
            <div class="amount">{{$item_count->quantity}}</div>
        </div>
    @endforeach
</div>
<div id="statstics-hidden-info" style="display: none;">
    @foreach($users_sales as $user)
    <div class="user-1 user">
        <div class="name">{{$user->name}}</div>
        <div class="amount">{{$user->sales}}</div>
    </div>
        @endforeach
</div>
<!-- company sales per month -->
<div id="hidden-sales-graph" style="display: none;">
    @foreach($monthly_sales as $month)
    <div class="month">
        <div class="sales">{{$month}}</div>
    </div>
        @endforeach

</div>
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
    @endsection
    @include("sidebars.navbar")
    <!---end of navbar !-->


        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!---start of content !-->
        <div class="exports_cases" style="width: 80%; display: inline-flex; margin-left: 10%" >
            <div class="cases first_case" style="width: 33%;">
                <div class="cards"  style="">

                    <div class="card-body" style="display: flex; padding: 0px;" >
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i style="color: yellowgreen;" class="fas fa-clock fa-3x"></i></div>


                        <a  style="width: 100%;height: 100%;padding: 12px 9px; display: inline-grid;"href="{{route("orders_with_state","انتظار")}}" class="btn " >
                            <span class="count" style="font-weight: bold">{{$wait}}</span>
                            <span style="font-weight: 900;font-size: 20px;color:yellowgreen; "> اوردرات قيد الانتظار</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="cases first_case" style="width: 33%;">
                <div class="cards" >

                    <div class="card-body" style="display: flex; padding: 0px">
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i  style="color: #72b1ff;" class="fas fa-check-double fa-3x"></i></div>

                        <a  style="width: 71%;height: 100%;padding: 12px 9px; display: inline-grid;"href="{{route("orders_with_state","تم التاكيد")}}" class="btn " >
                            <span class="count" style="font-weight: bold">{{$confirm}}</span>
                            <span style="font-weight: 900;font-size: 20px;color:#72b1ff; "> اوردرات تم تاكيدها</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="cases first_case" style="width: 33%;">
                <div class="cards" >

                    <div class="card-body" style="display: flex; padding: 0px">
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i style="color: forestgreen;" class="fas fa-shipping-fast fa-3x"></i></div>

                        <a  style="width: 71%;height: 100%;padding: 12px 9px; display: inline-grid; "href="{{route("orders_with_state","تم الشحن")}}" class="btn " >
                            <span class="count" style="font-weight: bold">{{$charge}}</span>
                            <span style="font-weight: 900;font-size: 20px;color: forestgreen;">اوردرات تم شحنها</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="cases first_case" style="width: 33%;">
                <div class="cards" >

                    <div class="card-body" style="display: flex; padding: 0px">
                        <div style="width: 29%;height: 100%;margin-top: 9px;"><i style="color: #ff6161;" class="fas fa-undo fa-3x"></i></div>

                        <a  style="width: 71%;height: 100%;padding: 12px 9px; display: inline-grid; "href="{{route("orders_with_state","مرتجع")}}" class="btn " >
                            <span class="count" style="font-weight: bold">{{$restore}}</span>
                            <span style="font-weight: 900;font-size: 20px;color:#ff6161; ">اوردرات مرتجعة</span>
                        </a>
                    </div>
                </div>
            </div>


        </div>
        <div class="chart-container" style="position: relative; height:40vh; width:60%;float: left;margin-left: 20%;margin-top: 10%; ">
            <canvas height="200px" id="third_chart"></canvas>
        </div>
        <div class="chart-container" style="position: relative; height:40vh; width:40%; float: left;margin-left: 2%; ">
            <canvas height="200px" id="myChart"></canvas>
        </div>
        <div class="chart-container" style="position: relative; height:40vh; width:40%;float: left;margin-left: 10% ">
            <canvas height="200px" id="second_chart"></canvas>
        </div>


    </div>




</div>
<script  src="{{asset("js/jquery-3.4.1.min.js")}}"></script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>

<script >
    $(document).ready(function () {
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
        var ctx = document.getElementById('myChart').getContext('2d');
        var names=[];
        var amounts=[];
        var monthly_sales=[];
        $(".user").each(function () {

            names.push($(this).find(".name").text());
            amounts.push($(this).find(".amount").text());

        });
        $(".sales").each(function () {
            monthly_sales.push($(this).text());
        });


        Chart.defaults.global.defaultFontSize = 21;
        Chart.defaults.global.defaultFontStyle = "bold";
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو',"يوليو","اغسطس","سبتمبر","اكتوبر","نوفمبر","ديسمبر"],
                datasets: [{
                    label: 'مبيعات الشركة شهريا',
                    data: monthly_sales,
                    backgroundColor: [
                        'rgb(100,224,235)',
                    ],

                    borderColor: [
                        'rgb(100,224,235)',
                    ],
                    borderWidth: 3
                }]
            },
            options: {
                responsive:true,

                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: "جنيها مصريا"
                        }
                    }]
                }
            }


        });
        var ctx = document.getElementById('second_chart').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'bar',

            data: {
                labels: names,
                datasets: [{
                    label: 'اكثر المستخدمين مبيعات',
                    data: amounts,
                    backgroundColor: [
                        'rgb(100,224,235)',
                         "2D5FEB",
                        "2D5FEB",

                    ],
                    borderColor: [

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive:true,
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: "عدد الاوردرات"
                        }
                    }]
                }
            }

        });

    })
    var ctx = document.getElementById('third_chart').getContext('2d');
    names=[];
    amounts=[];
    $(".items").each(function () {

        names.push($(this).find(".name").text());
        amounts.push($(this).find(".amount").text());

    });
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            datasets: [{
                data: amounts,
                label: 'اكثر الصناف توافرا',
                backgroundColor: [
                    'rgb(100,224,235)',
                    'rgb(995,58,235)',
                    'rgb(100,103,275)',
                    'rgb(255,229,69)',
                ],
            },
            ],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: names
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'اكثر الصناف توافرا'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }

    });

    //  $(this).css("width", "18%");


</script>
<script src="{{asset("js/popper.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>

</body>
</html>
