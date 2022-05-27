<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">


    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.semanticui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <title>حسابات موردين</title>
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
            <li class="breadcrumb-item" ><a href="{{route("home")}}"> الصفحة الرئيسية </a></li>
            <li class="breadcrumb-item active" aria-current="page" ><a href=""> حسابات موردين </a></li>
          @if(isset($exporter))
                <li class="breadcrumb-item active" aria-current="page" ><a href=""> حساب مورد {{$exporter->name}}</a></li>

        @endif

    @endsection
    @include("sidebars.navbar")
    <!---end of navbar !-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--system transaciont container-->
        <div class="inp-cont" style="margin: 57px;display: flex; direction: ltr;">
            <select name="type" id="select" style="     width: 243px;
    text-align: right;
    padding: 10px;
    border: solid 1px #5C71A3;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    -o-border-radius: 10px;
    -ms-border-radius: 10px;
    border-radius: 10px;
margin-left: 40%">
                <option disabled selected>حدد المورد</option>
                @foreach($exporters as $e)
                    <option @if(isset($exporter)) @if($exporter->id==$e->id) selected @endif @endif value="{{route("get_exporter_payments",$e->id)}}" >{{$e->name}}</option>
                @endforeach
            </select>
            <span style="margin-top: 1%;">اختر مورد لعرض معاملاته</span>
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
        <table id="example" class="ui celled table" style="text-align: center" dir="rtl"   >
            <thead >
            <tr >

                <th style="background: #5C71A3; color: white;" >تاريخ</th>
                <th style="background: #5C71A3; color: white;">بيان</th>
                <th style="background: #5C71A3; color: white;">وسيلة الدفع</th>
                <th style="background: #5C71A3; color: white;">ارقم الفاتورة</th>
                <th style="background: #5C71A3; color: white;">دائن</th>
                <th style="background: #5C71A3; color: white;">مدين</th>
                <th style="background: #5C71A3; color: white;">اجمالي</th>


            </tr>
            </thead>
            <tbody>


            </tbody>

        </table>


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
                        <form>
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">اسم العميل</div>
                                    </div>
                                    <input id="name" type="text" class="form-control"  placeholder="">
                                </div>
                            </div>
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">المحافظة</div>
                                    </div>
                                    <input id="governorate" type="text" class="form-control"  placeholder="">
                                </div>
                            </div>
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">لينك الفيسبوك</div>
                                    </div>
                                    <input id="facebook_link" type="text" class="form-control"  placeholder="">
                                </div>
                            </div>
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">العنوان</div>
                                    </div>
                                    <input id="address" type="text" class="form-control"  placeholder="">
                                </div>
                            </div>
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">رقم التليفون</div>
                                    </div>
                                    <input  id="phone" type="text" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="form-group row last" style="width: 100%">
                                <button class="btn btn-success" style="margin-right: 7px"><span>إضافة رقم اخر <i class="fas fa-plus"></i></span></button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
                        <button type="button" class="btn btn-primary" >اضافة</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>

<!-- details popup -->
        <div class="details-popup-container">
            <div class="close-popup">
                <i class="fas fa-times"></i>
            </div>
            <div class="details-popup">
                <div class="details">
                    <p id="p" style="margin: 0;"></p>
                </div>
            </div>
        </div>
        <a id="form" href=""><button id="submit"></button></a>

<script  src="{{asset("js/jquery-3.4.1.min.js")}}"></script>
<script src="{{asset("js/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("js/dataTables.semanticui.min.js")}}"></script>
<script src="{{asset("js/semantic.min.js")}}"></script>




    <script >
        $(document).ready(function() {

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
            /* var temp=$(".grid .row:last");
             var x=$("<button  style='position: absolute;right: 50%;background: cadetblue;border: none;border-radius: 1.24rem;' class='btn btn-primary'>عرض المزيد</button>");

             temp.html(x);*/
            $("#example_wrapper").css("padding","43px");
            $("#example_wrapper").attr("dir","ltr");

            $("#example_filter").attr("dir","rtl");

            /* x=$("<button id='modal_button' data-target='#exampleModalCenter' data-toggle='modal' class='btn btn-primary' style='border: none; background: cadetblue;border-radius: 1.24rem;'><i class='fas fa-user-plus fa-2x' ><span style='padding: 14px;font-size: 17px'>اضافة عميل</span></i></button>");
             $(".ui .row:first .eight:first ").html(x);*/
        } );
        $(document).on("click",".fa-user-edit",function () {
            //get the table tr which contain customer data
            var table=$(this).parent().parent();
            //get the customer attributes and set them in modal
            $("#name").val(table.find(".name").text());
            $("#address").val(table.find(".address").text());
            $("#governorate").val(table.find(".governorate").text());
            $("#facebook_link").val(table.find(".facebook").text());

            table.find(".phone select option").each(function () {

                var temp=$("#hidden_phone").clone();
                temp.css("display","");
                temp.attr("id","");
                temp.find("input").val($(this).text());
                // $("#phone").val($(this).text());
                $(".modal-body form .last ").before(temp);

            })
            $("#phone").parent().parent().css("display","none");
            $('#exampleModalCenter').modal('show');
        });
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

        <script>
            $("#select").on('change',function() {
                var href = $("#select option:selected").val();

                $("#form").attr("href",href);
                $("#submit").click();



            })

        </script>
</body>
</html>
