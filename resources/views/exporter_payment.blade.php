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
    <title>حساب مورد</title>
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
            <li class="breadcrumb-item active" aria-current="page" ><a href="{{route("paymentsview")}}"> حسابات موردين </a></li>
            @if(isset($exporter))
                <li class="breadcrumb-item active" aria-current="page" ><a href=""> حساب المورد  {{$exporter->name}} </a></li>

        @endif

    @endsection
    @include("sidebars.navbar")
    <!---end of navbar !-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <div class="inp-cont" style="margin: 57px;display: flex;">

            <div class="form-group row" style="width: 100%">
                <label class="sr-only" >Username</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend" style="margin-right: 30%">
                        <div class="input-group-text" style="font-weight: 700; padding: 10px;"> اختر مورد لعرض حسابه</div>
                    </div>
                    <select name="type" id="select" style="width: 28%">
                <option disabled selected> اختر مورد لعرض حسابه</option>
                @foreach($exporters as $e)
                    <option @if(isset($exporter)) @if($exporter->id==$e->id) selected @endif @endif value="{{route("get_exporter_payments",$e->id)}}" >{{$e->name}}</option>
                @endforeach
            </select>

                 </div>
            </div>
            </div>
        <div class="inp-cont" style="margin: 57px;display: flex; direction: ltr; display:none">
            <select name="type" id="select" style="     width: 300px;
    text-align: right;
    padding: 10px;
    border: solid 1px #5C71A3;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    -o-border-radius: 10px;
    -ms-border-radius: 10px;
    border-radius: 10px;
margin-left: 35%">
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
                <th style="background: #5C71A3; color: white;" >   تاريخ التسجيل</th>
                <th style="background: #5C71A3; color: white;" > تاريخ الفاتورة</th>
                <th style="background: #5C71A3; color: white;">بيان</th>
                <th style="background: #5C71A3; color: white;">وسيلة الدفع</th>
                <th style="background: #5C71A3; color: white;">ارقم الفاتورة</th>
                <th style="background: #5C71A3; color: white;">دائن</th>
                <th style="background: #5C71A3; color: white;">مدين</th>
                <th style="background: #5C71A3; color: white;">اجمالي</th>


            </tr>
            </thead>
            <tbody>
            @for ($i=0;$i<sizeof($collection_of_items);$i++)
               
                <td style="font-weight: 500; border-left:1px solid rgba(34,36,38,.1); ">{{$collection_of_items[$i]->created_at}}</td>
                <td style="font-weight: 500; border-left:1px solid rgba(34,36,38,.1); ">{{explode(" ",$collection_of_items[$i]->date)[0]}}</td>
                <td style="font-weight: 500;">{{$collection_of_items[$i]->details}}</td>
                <td style="font-weight: 500;">
                    @if($collection_of_items[$i]->type=="export")
                        فاتورة شراء         
                    @else
                    {{$collection_of_items[$i]->method}}
                     @endif
                </td>
                <td style="font-weight: 500;">{{$collection_of_items[$i]->id}}</td>
                <td style="font-weight: 500;">@if($collection_of_items[$i]->type=="export")
                    {{$collection_of_items[$i]->amount}}                             @endif
                 </td >
                <td style="font-weight: 500;">@if($collection_of_items[$i]->type=="transaction")
                        {{$collection_of_items[$i]->amount}}                                 @endif
                </td>
                <td style="background-color: aqua; font-weight: 700"><span>{{$balance_array[$i]}}</span> جنيه</td>
            </tr>
                @endfor

            </tbody>

        </table>


        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="    border: 4px solid gainsboro;  border-radius: 2.24rem;">
                    <div class="modal-header" dir="ltr">
                        <h5 class="modal-title" id="exampleModalLongTitle" style="margin-left: 37%;margin-top: 6%"><i class="fas fa-money-check-alt fa-2x" style="padding-right: 10px; color: green;"></i> تسجيل معاملة  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 30px">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height: auto">
                        <form style="display: block" method="post" action="{{route("pay")}}">
                            @csrf
                            @if(isset($exporter))
                            <input style="display:none;" value="{{$exporter->id}}" name="exporter_id" class="form-control">
                           @endif    
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">نوع العملية</div>
                                    </div>
                                    <select name="method"  name="type" class="form-control all">
                                        <option  selected value="0">اختر وسيلة الدفع</option>
                                        <option value="نقدي" >نقدي</option>
                                        <option value="شيك" >شيك</option>
                                    </select>                               
                                 </div>
                            </div>
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">  رقم الفاتورة</div>
                                    </div>
                                    <input name="receipt_id"  class="form-control all">
       
                                 </div>
                            </div>
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700"> المبلغ المدفوع</div>
                                    </div>
                                    <input name="paid"  class="form-control all">
                                </div>
                            </div>
                            
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">التاريخ</div>
                                    </div>
                                    <input name="date"  type="date"  class="form-control all">
                                </div>
                            </div>
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">ملاحظة</div>
                                    </div>
                                    <input name="details"  type="text"  class="form-control">
                                </div>
                            </div>
                       
                    </div>
                    <div class="modal-footer">
                        <input type="submit" id="confirm_submit_pay" class="d-none">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
                        <button type="button" id="submit_pay" class="btn btn-primary" >اضافة</button>
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
<script src="{{asset("js/semantic.min.js")}}"></script>





<script >
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
    function wrong_length_input(input) {

        $("."+input).each(function () {
            var $length=$(this).attr("data-length");
            if($(this).val().length<$length){

                $bool=false;
                var alert_message=$(this).attr("data-alertmessage");

                $(this).css("background-color","#fce4e4");
                $(this).attr("placeholder",alert_message);
                $(this).val("");


            }
        })
    }
    function arabic_input() {

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

    $("#submit_pay").click(function () {
        if(validate(["all"],[["null_input"]])){
         
            $("#confirm_submit_pay").click();
        }
        else{
            
            alert("من فضلك راجع الخانات باللون الاحمر");
        }
    })

    $(document).ready(function() {

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
       /* var temp=$(".grid .row:last");
        var x=$("<button  style='position: absolute;right: 50%;background: cadetblue;border: none;border-radius: 1.24rem;' class='btn btn-primary'>عرض المزيد</button>");

        temp.html(x);*/
        $("#example_wrapper").css("padding","43px");
        $("#example_wrapper").attr("dir","ltr");

        $("#example_filter").attr("dir","rtl");

         x=$("<button id='modal_button' data-target='#exampleModalCenter' data-toggle='modal' class='btn btn-primary' style='border: none; background: #5C71A3;border-radius: 1.24rem;'><i class='fas fa-money-check-alt fa-2x' ><span style='padding: 14px;font-size: 17px'> تسجيل معاملة </span></i></button>");
         $(".ui .row:first .eight:first").html(x);
    });
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


    $("#select").on('change',function() {
        var href = $("#select option:selected").val();

        $("#form").attr("href",href);
        alert("ss");
        $("#submit").click();



    })

    $(document).on("change","input",function () {
        $(this).css("background-color","");
     })
     $(document).on("change","select",function () {
        $(this).css("background-color","");
     })

</script>
<script src="{{asset("js/popper.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>

</body>
</html>
