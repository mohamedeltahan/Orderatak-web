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
    <title>خزنة</title>
    <style>
        .dataTables_filter{
            direction: rtl;
        }
    </style>
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
                <span> الخزنة</span>
            </div>
            <div class="user-info">
                <div class="user-img-container">
                    <img src="./imges/mo1.jpg" alt="user">
                    <span>Muhamed Reda</span>
                </div>
            </div>
            <div class="system-categories" id="menu-categories">
                <ul>
                    <li><a href="#"><i class="fas fa-sign-out-alt"></i>الصفحة الرئيسية</a></li>
                    <li><a href="clients.html"><i class="fas fa-sign-out-alt"></i>العملاء</a></li>
                    <li><a href="exporters.html"><i class="fas fa-sign-out-alt"></i>الموردين</a></li>
                    <li class="hover"><a href="export_reciept.html"><i class="fas fa-sign-out-alt"></i>فاتورة مورد</a></li>
                    <li><a href="#"><i class="fas fa-sign-out-alt"></i>الاعدادات</a></li>
                </ul>
            </div>
        </div>
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
            <div class="navbar-container col-12">
                <div class="nav-bar col-12">
                    <ul class="user-list">
                        <li class="user-img">
                            <img src="./imges/mo1.jpg" alt="">
                        </li>
                        <li class="notification">
                            <i class="fas fa-bell"></i>
                        </li>
                    </ul>
                </div>
                <!--=================================-->
                <!--=================================-->
                <!--Start user nav list-->
                <div class="user-nav-list">
                    <ul>
                        <li><i class="fas fa-sign-out-alt"></i><a href="#">الصفحة الرئيسية</a></li>
                        <li><i class="fas fa-sign-out-alt"></i><a href="#">الاعدادات</a></li>
                        <li><i class="fas fa-sign-out-alt"></i><a href="#">تسجيل الخروج</a></li>
                    </ul>
                </div>
                <!--End user nav list-->
                <!--=================================-->
                <!--=================================-->
                <!--Start user notification list-->
                <div class="user-notification-list">
                    <ul class="notification-list">
                        <!--=================================-->
                        <!--=================================-->
                        <li class="noti">
                            <ul>
                                <li class="noti-img">
                                    <img src="./imges/mo1.jpg" alt="">
                                </li>
                                <li class="noti-description">
                                    <p>قام محمد بإضافه 25 قطعه قام محمد بإضافه 25 قطعه قام محمد بإضافه 25 قطعه قام محمد بإضافه 25 قطعه قام محمد بإضافه 25 قطعه</p>
                                    <span>from 25m ago</span>
                                </li>
                            </ul>
                        </li>
                        <!--=================================-->
                        <!--=================================-->
                        <li class="noti">
                            <ul>
                                <li class="noti-img">
                                    <img src="./imges/mo1.jpg" alt="">
                                </li>
                                <li class="noti-description">
                                    <p>قام محمد بإضافه 25 قطعه قام محمد بإضافه 25 قطعه قام محمد بإضافه 25 قطعه قام محمد بإضافه 25 قطعه قام محمد بإضافه 25 قطعه</p>
                                    <span>from 25m ago</span>
                                </li>
                            </ul>
                        </li>
                        <!--=================================-->
                        <!--=================================-->
                    </ul>
                    <div class="noti-footer">
                        <a href="#">Show more</a>
                    </div>
                </div>
                <!--End user notification list-->
            </div>
            <!--End navbar component-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--============================================-->
            <!--system transaciont container-->
            <div class="header">
                <button class="add-transaction">إضافة عملية</button>
                <span>التعاملات المالية <i class="fas fa-money-check-alt"></i> </span>
            </div>
            <div class="transaction-form-container">
                <div class="transaction-form">
                    <form action="">
                        <div class="inp-cont">
                            <div class="inp-name">
                                <span> : نوع العمليه</span>
                            </div>
                            <select>
                                <option disabled selected>اختر نوع العمليه</option>
                                <option >سحب</option>
                                <option >إيداع</option>
                            </select>
                        </div>
                        <div class="inp-cont">
                            <div class="inp-name">
                                <span>: اسم المستلم</span>
                            </div>
                            <input type="text" placeholder="إدخل اسم المستلم">
                        </div>
                        <div class="inp-cont">
                            <div class="inp-name">
                                <span>: رقم الفاتوره</span>
                            </div>
                            <input type="number" placeholder="إدخل رقم الفاتورة">
                        </div>
                        <div class="inp-cont">
                            <div class="inp-name">
                                <span>: المبلغ</span>
                            </div>
                            <input type="number" placeholder="إدخل مبلغ الفاتورة">
                        </div>
                        <div class="inp-cont">
                            <div class="inp-name">
                                <span>: التاريخ</span>
                            </div>
                            <input type="date">
                        </div>
                        <div class="inp-cont">
                            <div class="inp-name">
                                <span>: ملاحظة</span>
                            </div>
                            <input type="text" placeholder="ملاحظة">
                        </div>
                        <button>تأكيد العمليه</button>
                    </form>
                </div>
            </div>
            <div class="transactions-container">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>اسم المستخدم</th>
                            <th>رقم الفاتورة / شيك</th>
                            <th>نوع العمليه</th>
                            <th>اسم المستلم</th>
                            <th>التاريخ</th>
                            <th>المبلغ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> احمد علي محمد</td>
                            <td>445588999</td>
                            <td>ايداع</td>
                            <td>محمد عبدالله</td>
                            <td>2019/04/25</td>
                            <td>1500</td>
                        </tr>
                        <tr>
                            <td> كريم مصطفى عبدالفتاح</td>
                            <td>5621878963</td>
                            <td>سحب</td>
                            <td> هلال الدسوقي</td>
                            <td>2019/11/01</td>
                            <td>1700</td>
                        </tr>
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
                <p style="margin: 0;">تم سحب 500 من دونجا بسبب مرتجعاتتم سحب 500 من دونجا بسبب مرتجعاتتم سحب 500 من دونجا بسبب مرتجعاتتم سحب 500 من دونجا بسبب مرتجعاتتم سحب 500 من دونجا بسبب مرتجعاتتم سحب 500 من دونجا بسبب مرتجعاتتم سحب 500 من دونجا بسبب مرتجعاتتم سحب 500 من دونجا بسبب مرتجعات</p>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="./js/navbar.js"></script>
    <script type="text/javascript" src="plugins/DataTables/datatables.min.js"></script>
    <script src="./js/transaction.js"></script>
</body>
</html>
