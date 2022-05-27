<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("plugins/bootstrap-4.3.1-dist/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("plugins/fontawesome-free-5.11.2-web/css/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/component/navbar.css")}}">
    <link rel="stylesheet" href="{{asset("css/sys-transaction/system-transaction.css")}}">
    <link rel="stylesheet" href="{{asset("css/component/alert-popup.css")}}">

    <link rel="stylesheet" type="text/css" href="{{asset("plugins/DataTables/datatables.min.css")}}"/>
    <style>
        .dataTables_filter{
            direction: rtl;
        }
    </style>
    <title>مرتجعات </title>
</head>
<body>
<div class="layout-container-fluid">
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--============================================-->
    <!--start side menu component-->
    <div class="menu-side-container">
        <div class="page-title">
            <span>{{$state}}</span>
        </div>
    @include("sidebars.sidebar")

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
        @include("sidebars.navbar")

        <!--End navbar component-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--system transaciont container-->
            <div class="header">
                <span>{{$state}}<i class="fas fa-money-check-alt"></i> </span>
            </div>

            <div class="transactions-container">
                <table id="example" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>تاكيد</th>
                        <th>سبب الاسترجاع</th>
                        <th>تاريخ الاسترجاع</th>
                        <th>اسم العميل</th>
                        <th>رقم الفاتورة</th>
                        <th>الكمية</th>
                        <th>مقاس</th>
                        <th>اللون</th>
                        <th>الكود</th>
                        <th>الصنف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($exports as $export)
                        <tr>
                            <td><i class="fas fa-check-circle"></i>
                                <a class="link" href="{{route("confirm_restored",$restored->id)}}"> <span class="clickable"></span></a>
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
            </div>


            <!--End body container-->
        </div>
    </div>


    <!-- details popup -->

    <div class="alert-popup-container">
        <div class="alert-popup">
            <div class="alert-massage">
                <p>هل تريد تاكيد الارتجاع واستلام المنتج من شركة الشحن ؟</p>
            </div>
            <div class="alert-action">
                <button  class="confirm">تأكيد</button>
                <button class="cancel">إلغاء</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{asset("js/navbar.js")}}"></script>
    <script type="text/javascript" src="{{asset("plugins/DataTables/datatables.min.js")}}"></script>
    <script src="{{asset("js/transaction.js")}}"></script>
    <script type="text/javascript">
        $("td").click(function(){
            var temp=$(this);
            var expo = $(this).parent().parent();
            $(".alert-popup-container").addClass("show");
            $(".cancel").click(function(){
                $(".alert-popup-container").removeClass("show");
            });
            $(".confirm").click(function(){
                $(".alert-popup-container").removeClass("show");

                temp.find(".clickable").click();
            });

        });
    </script>
</body>
</html>
