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
    <title>تقارير</title>
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
    <title>حسابات موردين</title>
</head>
<body>
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
            <li class="breadcrumb-item" aria-current="page"><a href="{{route("home")}}"> الصفحة الرئيسية </a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{route("most_paying_customers")}}">تقارير</a></li>


        @endsection
    @include("sidebars.navbar")
    <!---end of navbar !-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--system transaciont container-->
        @include("select_list_in_reports")

        <div class="reports-container">
            <!-- clients-reports container-->
            <div class="item-reports report" id="item-reports">
                <canvas style="padding: 20px;"  id="myChart" width="100" height="30px"></canvas>

                <div class="data-container">
                    <table id="example" class="ui celled table" style="width:100%;text-align: center;font-weight: 500" dir="rtl" >
                        <thead>
                        <tr>

                            <th style="background: #5C71A3; color: white;">الصنف</th>
                            <th style="background: #5C71A3; color: white;">الربح</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($static_array as $name=>$value)
                            <tr class="items">
                                <td style="border-left: 1px solid rgba(34,36,38,.1);" class="name"> {{$name}} </td>
                                <td   class="value">{{$value}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <!--End body container-->
        </div>
        <form style="display: none" id="form" method="get">
            @csrf
            <button type="submit"></button>
        </form>
    </div>


    <script  src="{{asset("js/jquery-3.4.1.min.js")}}"></script>
    <script src="{{asset("js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("js/dataTables.semanticui.min.js")}}"></script>
    <script src="{{asset("js/semantic.min.js")}}"></script>
    <script src="{{asset("js/Chart.min.js")}}"></script>
    <script src="{{asset("js/Chart.bundle.min.js")}}"></script>
    <script >
        $(document).ready(function () {

            $('#example').DataTable({
                "paging":   false,
                "info":false,

                aaSorting: [],
                "language": {
                    "lengthMenu":  "",
                    "zeroRecords": "لا يوجد نتيجة بحث مطابقة",
                    "info":  "",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtered from _MAX_ total records)",

                }

            });
            $("#example_wrapper").css("padding","43px");
            $("#example_wrapper").attr("dir","ltr");

            $("#example_filter").attr("dir","rtl");

            $('#sidebarCollapse').on('click', function () {

                if ($(this).hasClass("hidden")) {

                    $(this).removeClass("hidden");
                    $("#sidebar").delay(50).fadeIn('slow', function () {
                        $("#main_div").css("width", "82%");

                    })
                } else {
                    $("#main_div").css("width", "100%");

                    $('#sidebar').delay(50).fadeOut('slow', function () {

                        $("#sidebarCollapse").addClass("hidden")
                    });

                }
            });

            var ctx = document.getElementById('myChart').getContext('2d');
            var username = [];
            var uservalues = [];
            var counter = 0;
            $(".items").each(function () {

                username[counter] = $(this).find(".name").text();
                uservalues[counter] = parseInt($(this).find(".value").text() , 10);
                counter = counter + 1;
            });
           /* username.push("amira","sayed","mohamed","saeed","maro","dsfsdf","omar");
            uservalues.push(50,60,90,30,15,70,40);*/



            Chart.defaults.global.defaultFontSize = 19;
            Chart.defaults.global.defaultFontStyle = "bold";
            var myLineChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels:username,
                    datasets: [{
                        label: 'اكثر المنتجات ربحا',
                        data: uservalues,
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
                    responsive: true,

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
        })

        //  $(this).css("width", "18%");

        $("#select").on("change",function () {
            $("#form").attr("action",$("#select").find("option:selected").val());
            $("#form").find("button").click();
        })
    </script>

    <script src="{{asset("js/popper.js")}}"></script>
    <script src="{{asset("js/bootstrap.min.js")}}"></script>

</body>
</html>
