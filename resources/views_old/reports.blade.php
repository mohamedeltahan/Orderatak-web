<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("plugins/bootstrap-4.3.1-dist/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("plugins/fontawesome-free-5.11.2-web/css/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/component/navbar.css")}}">
    <link rel="stylesheet" href="{{asset("css/notification/noti.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/DataTables/datatables.min.css")}}"/>
    <link rel="stylesheet" href="{{asset("css/reports/reports.css")}}">
    <title> التقارير </title>
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
            <span> تقارير </span>
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
                <select id="select-report" style="float: right; width: 200px; padding: 5px;">
                    <option value="clients-reports">تقارير عملاء</option>
                    <option value="item-reports">تقارير المنتجات</option>
                    <option value="reciepts-reports">تقارير الفواتير</option>
                </select>
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
        <div class="reports-container">
            <!-- clients-reports container-->
            <div class="clients-reports report" id="clients-reports">
                <div class="header">
                    تقارير العملاء
                </div>
                <div class="reports">
                    <div id="heights-clients-chartContainer" style="height: 370px; width: 50%; float: left;"></div>
                    <div id="lowst-clients-chartContainer" style="height: 370px; width: 50%; float: right;"></div>
                </div>
                <div class="data-container">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>عدد الاوردرات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td> محمد </td>
                            <td>105</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- item-reports container-->
            <div class="item-reports report" id="item-reports" style="height: 0px; overflow: hidden;">
                <div class="header">
                    تقارير المنتجات
                </div>
                <div class="reports">
                    <div id="heighestpay-item-chartContainer" style="height: 370px; width: 50%; float: left;"></div>
                    <div id="heighestfounded-item-chartContainer" style="height: 370px; width: 50%; float: right;"></div>
                </div>
                <div class="data-container">
                    <table id="example2" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>عدد المبيعات</th>
                            <th> نسبة التوافر </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td> محمد </td>
                            <td>105</td>
                            <td>10%</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- item-reports container-->
            <div class="reciepts-reports report" id="reciepts-reports" style="height: 0px; overflow: hidden;">
                <div class="header">
                    تقارير المنتجات
                </div>
                <div class="reports">
                    <div id="reciept-state-chartContainer" style="height: 370px; width: 50%; float: left;"></div>
                    <div id="reciept-state-graph" style="height: 370px; width: 50%; float: right;"></div>
                </div>
                <div class="data-container">
                    <table id="example3" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>الحالة</th>
                            <th>عدد الفاوتير</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td> تم التأكيد </td>
                            <td>105</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--End body container-->
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="./js/canvasjs.min.js"></script>
<script src="./js/navbar.js"></script>
<script type="text/javascript" src="plugins/DataTables/datatables.min.js"></script>
<script src="./js/reports.js"></script>
</body>
</html>
