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
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/DataTables/datatables.min.css")}}"/>
    <style>
        .dataTables_filter{
            direction: rtl;
        }
    </style>
    <title>خزنة</title>
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
            <span>الخزنة</span>
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
                <button class="add-transaction">إضافة عملية</button>
                <span>التعاملات المالية لفاتورة رقم {{$export->id}} للمورد {{$export->exporter->name}}<i class="fas fa-money-check-alt"></i> </span>
            </div>
            <div class="transaction-form-container">
                <div class="transaction-form">
                    <form method="post" action="{{route("exporter_transactions.store")}}">
                        @csrf

                         <input name="export_id" style="display: none"  value="{{$export->id}}">
                        <div class="inp-cont">
                            <div class="inp-name">
                                <span>: رقم الفاتوره</span>
                            </div>
                            <input name="receipt_id" type="number" placeholder="إدخل رقم الفاتورة">
                        </div>
                        <div class="inp-cont">
                            <div class="inp-name">
                                <span>: المبلغ</span>
                            </div>
                            <input name="paid" type="number" placeholder="إدخل مبلغ الفاتورة">
                        </div>
                        <div class="inp-cont">
                            <div class="inp-name">
                                <span>: التاريخ</span>
                            </div>
                            <input name="paid_at" type="date">
                        </div>
                        <div class="inp-cont">
                            <div class="inp-name">
                                <span>: ملاحظة</span>
                            </div>
                            <input name="details" type="text" placeholder="ملاحظة">
                        </div>
                        <button>تأكيد العمليه</button>
                    </form>
                </div>
            </div>
            <div class="transactions-container">
                <table id="example" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>تفاصيل</th>
                        <th>اسم المستخدم</th>
                        <th>رقم الفاتورة / شيك</th>
                        <th>التاريخ</th>
                        <th>المبلغ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($export->exporter_transactions as $cache)
                        <tr data-details="{{$cache->details}}">
                            <td>سسسس</td>
                            <td> {{$cache->user_id}}</td>
                            <td>{{$cache->receipt_id}}</td>
                            <td>{{$cache->paid_at}}</td>
                            <td>{{$cache->paid}}</td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


            <!--End body container-->
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


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{asset("js/navbar.js")}}"></script>
    <script type="text/javascript" src="{{asset("plugins/DataTables/datatables.min.js")}}"></script>
    <script src="{{asset("js/transaction.js")}}"></script>
</body>
</html>
