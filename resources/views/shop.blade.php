<!doctype html>
<html >
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ezone - eCommerce HTML5 Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- all css here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <script src="https://use.fontawesome.com/c560c025cf.js"></script>

    <!-- Latest compiled and minified JavaScript -->

</head>
<style>
    .mylink{
        padding: 11px;
        font-size: 17px;
        background: darkred;
    }
    .pages{
        padding: 0;
    }
    .nav-link{
        font-size: 20px;
    }
    .badge{
        padding: 10px;
    }
    .product-img{
        height: 70%;
    }
    .product-content{
        height: 30%;
    }
    .product-wrapper{
        height: 100%;
    }
    .nav-tabs .nav-link{
        font-size: 29px;
    }
    .sidebar-search form > button{
        right: 205px;
    }
   /* .bootstrap-select .dropdown-menu li a span.text {
     padding-left: 38%;
    }*/
    img{
        max-height: 100%;
    }
    .dropdown-item{
        text-align: center;
    }
    .dropdown-header{
        padding-left: 40%;
        font-size: 25px;
    }
    .bootstrap-select .dropdown-toggle .filter-option-inner-inner{
        text-align: center;
    }

    .table tr {
        cursor: pointer;
        font-size: 20px;
    }
    .table{
        background-color: #fff !important;
    }
    .hedding h1{
        color:#fff;
        font-size:25px;
    }
    .main-section{
        margin-top: 120px;
    }
    .hiddenRow {
        padding: 0 4px !important;
        background-color: #eeeeee;
        font-size: 13px;
    }
    .accordian-body span{
        color:#a2a2a2 !important;
    }
    label{
        text-align: center;
    font-size: 18px;
    font-family: inherit;
    font-weight: 600;
    }


.quantity {
    float: left;
    margin-right: 15px;
    background-color: #eee;
    position: relative;
    width: 80px;
    overflow: hidden
}

.quantity input {
    margin: 0;
    text-align: center;
    width: 15px;
    height: 15px;
    padding: 0;
    float: right;
    color: #000;
    font-size: 20px;
    border: 0;
    outline: 0;
    background-color: #F6F6F6
}

.quantity input.qty {
    position: relative;
    border: 0;
    width: 100%;
    height: 40px;
    padding: 10px 25px 10px 10px;
    text-align: center;
    font-weight: 400;
    font-size: 15px;
    border-radius: 0;
    background-clip: padding-box
}

.quantity .minus, .quantity .plus {
    line-height: 0;
    background-clip: padding-box;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
    -webkit-background-size: 6px 30px;
    -moz-background-size: 6px 30px;
    color: #bbb;
    font-size: 20px;
    position: absolute;
    height: 50%;
    border: 0a
    right: 0;
    padding: 0;
    width: 25px;
    z-index: 3
}

.quantity .minus:hover, .quantity .plus:hover {
    background-color: #dad8da
}

.quantity .minus {
    bottom: 0
}
.shopping-cart {
    margin-top: 20px;
}
.bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn){
    width: 162px;
}
.modal_image{
    max-width: 100px;
    max-height: 150px;
}
.large_modal_image{
    max-width: 320px;
    max-height: 380px;
}

.qwick-view-content{
    font-size: 18px;
    text-align: right;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
   opacity: 1;
}

</style>
<body>
    <div class="row temp_product d-none">
        <div class="hidden_input">
          <input name="colors[]" value="" class="color d-none">
          <input name="sizes[]" value="" class="size d-none">
          <input name="names[]" value="" class="name d-none">

        </div>
        <div class="col-12 col-sm-12 col-md-2 text-center">
                <img class="img-responsive" src="http://placehold.it/120x80" alt="prewiew" width="120" height="80">
        </div>
        <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-3">
            <h4 class="product-name"><strong>Product Name</strong></h4>
            <h4>
                <small>Product description</small>
            </h4>
        </div>
        <div class="col-12 col-sm-12 col-md-3 text-sm-left text-md-center">
            <select class="cl" data-style="btn-info" style="width: 50%;">
                <optgroup label="">
                    <option selected>الالوان و المقاسات</option>
                </optgroup>
                <optgroup class="second_optgroup" label="">
                    <option  disabled ></option>
                </optgroup>
            </select>

        </div>
    
        <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row" style="margin: 0;">
            <div class="col-sm-6 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px;">
                <h6><strong class="product_price">25.00 <span class="text-muted">x</span></strong></h6>
            </div>
            <div class="col-sm-4 col-sm-4 col-md-4">
                <div class="quantity">
                    <input name="quantity[]" type="number" step="1" max="99" min="1" value="1" title="Qty" class="qty form_quantity" size="4">
                </div>
            </div>
            <div class="col-sm-2 col-sm-2 col-md-2 text-right">
                <button type="button" class="btn btn-outline-danger btn-xs delete">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- header start -->
<header style="
    /* padding: 0px; */
    padding-bottom: 21px;
">
    <div class="header-top-furniture wrapper-padding-2 res-header-sm" style="

background-image: url(&quot;img_girl.jpg&quot;);

  /* Full height */

height: 100%;

  /* Center and scale the image nicely */

background-position: center;

background-repeat: no-repeat;

background-size: cover;

background: darkblue;

">
        <div class="container-fluid" style="
    background: #b19f97;
    border: 1px solid;
    border-radius: 0.24rem;
    background-image: url(&quot;1.png&quot;);
    background-image: url(&quot;photo.jpg&quot;);

  /* Full height */
    height: 100%;

  /* Center and scale the image nicely */
    background-position: right;
    background-repeat: no-repeat;
    /* background-size: cover; */
">
            <div class="header-bottom-wrapper">
                <div class="logo-2 furniture-logo ptb-30">
                    <a href="index.html">
                        <img src="assets/img/logo/2.png" alt="">
                    </a>
    </div>
                <div class="menu-style-2 furniture-menu menu-hover">
                    
                </div>
                <div class="header-cart">
                    <a class="icon-cart-furniture" href="#">
                        <i class="ti-shopping-cart"></i>
                        <span class="shop-count-furniture green">02</span>
                    </a>
                    <ul class="cart-dropdown">
                        <li class="single-product-cart">
                            <div class="cart-img">
                                <a href="#"><img src="assets/img/cart/1.jpg" alt=""></a>
                            </div>
                            <div class="cart-title">
                                <h5><a href="#"> Bits Headphone</a></h5>
                                <h6><a href="#">Black</a></h6>
                                <span>$80.00 x 1</span>
                            </div>
                            <div class="cart-delete">
                                <a href="#"><i class="ti-trash"></i></a>
                            </div>
                        </li>
                        <li class="single-product-cart">
                            <div class="cart-img">
                                <a href="#"><img src="assets/img/cart/2.jpg" alt=""></a>
                            </div>
                            <div class="cart-title">
                                <h5><a href="#"> Bits Headphone</a></h5>
                                <h6><a href="#">Black</a></h6>
                                <span>$80.00 x 1</span>
                            </div>
                            <div class="cart-delete">
                                <a href="#"><i class="ti-trash"></i></a>
                            </div>
                        </li>
                        <li class="single-product-cart">
                            <div class="cart-img">
                                <a href="#"><img src="assets/img/cart/3.jpg" alt=""></a>
                            </div>
                            <div class="cart-title">
                                <h5><a href="#"> Bits Headphone</a></h5>
                                <h6><a href="#">Black</a></h6>
                                <span>$80.00 x 1</span>
                            </div>
                            <div class="cart-delete">
                                <a href="#"><i class="ti-trash"></i></a>
                            </div>
                        </li>
                        <li class="cart-space">
                            <div class="cart-sub">
                                <h4>Subtotal</h4>
                            </div>
                            <div class="cart-price">
                                <h4>$240.00</h4>
                            </div>
                        </li>
                        <li class="cart-btn-wrapper">
                            <a class="cart-btn btn-hover" href="#">view cart</a>
                            <a class="cart-btn btn-hover" href="#">checkout</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="mobile-menu-area d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none">
                    <div class="mobile-menu">
                        <nav id="mobile-menu-active" style="display: block;">
                            <ul class="menu-overflow">
                                <li><a href="#">HOME</a>
                                    <ul>
                                        <li><a href="index.html">Fashion</a></li>
                                        <li><a href="index-fashion-2.html">Fashion style 2</a></li>
                                        <li><a href="index-fruits.html">Fruits</a></li>
                                        <li><a href="index-book.html">book</a></li>
                                        <li><a href="index-electronics.html">electronics</a></li>
                                        <li><a href="index-electronics-2.html">electronics style 2</a></li>
                                        <li><a href="index-food.html">food &amp; drink</a></li>
                                        <li><a href="index-furniture.html">furniture</a></li>
                                        <li><a href="index-handicraft.html">handicraft</a></li>
                                        <li><a href="index-smart-watch.html">smart watch</a></li>
                                        <li><a href="index-sports.html">sports</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">pages</a>
                                    <ul>
                                        <li><a href="about-us.html">about us</a></li>
                                        <li><a href="menu-list.html">menu list</a></li>
                                        <li><a href="login.html">login</a></li>
                                        <li><a href="register.html">register</a></li>
                                        <li><a href="cart.html">cart page</a></li>
                                        <li><a href="checkout.html">checkout</a></li>
                                        <li><a href="wishlist.html">wishlist</a></li>
                                        <li><a href="contact.html">contact</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">shop</a>
                                    <ul>
                                        <li><a href="shop-grid-2-col.html"> grid 2 column</a></li>
                                        <li><a href="shop-grid-3-col.html"> grid 3 column</a></li>
                                        <li><a href="shop.html">grid 4 column</a></li>
                                        <li><a href="shop-grid-box.html">grid box style</a></li>
                                        <li><a href="shop-list-1-col.html"> list 1 column</a></li>
                                        <li><a href="shop-list-2-col.html">list 2 column</a></li>
                                        <li><a href="shop-list-box.html">list box style</a></li>
                                        <li><a href="product-details.html">tab style 1</a></li>
                                        <li><a href="product-details-2.html">tab style 2</a></li>
                                        <li><a href="product-details-3.html"> tab style 3</a></li>
                                        <li><a href="product-details-4.html">sticky style</a></li>
                                        <li><a href="product-details-5.html">sticky style 2</a></li>
                                        <li><a href="product-details-6.html">gallery style</a></li>
                                        <li><a href="product-details-7.html">gallery style 2</a></li>
                                        <li><a href="product-details-8.html">fixed image style</a></li>
                                        <li><a href="product-details-9.html">fixed image style 2</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">BLOG</a>
                                    <ul>
                                        <li><a href="blog.html">blog 3 colunm</a></li>
                                        <li><a href="blog-2-col.html">blog 2 colunm</a></li>
                                        <li><a href="blog-sidebar.html">blog sidebar</a></li>
                                        <li><a href="blog-details.html">blog details</a></li>
                                        <li><a href="blog-details-sidebar.html">blog details 2</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact.html"> Contact  </a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
<!-- header end -->
<div style="">
    <div class="container" style="
    border: 1px solid;
    border-radius: 3.24rem;
    background: #f7f7f3;
    /* max-height: 379px; */
">
        <div class="row my-2" style="direction: rtl;">


            <div class="col-lg-12 order-lg-2">
                <ul class="nav nav-tabs" style="
    font-size: 32px;
">
                    <li class="nav-item">
                        <a href="" data-target="#profile" data-toggle="tab" class="nav-link active"> عنا </a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#messages" data-toggle="tab" class="nav-link">طلباتك</a>
                    </li>
                    <li class="nav-item">
                        <a href="" id="make_order" data-target="#edit" data-toggle="tab" class="nav-link">طلب اوردر</a>
                    </li>
                </ul>
                <div class="tab-content py-4">
                    <div class="tab-pane active" id="profile">
                        <div class="row">
                            <div class="col-md-6" style="display: none">
                                <h6>About</h6>
                                <p>
                                    Web Designer, UI/UX Engineer
                                </p>
                                <h6>Hobbies</h6>
                                <p>
                                    Indie music, skiing and hiking. I love the great outdoors.
                                </p>
                            </div>
                            <div class="col-md-12">
                                <h5 class="col-md-12" style="text-align: right;font-size: 29px;">لدينا شغف بصناعة أحذية الأطفال على مدار 40 عامًا ونصنع بحب أحذية أطفال مناسبة لتلك الأقدام التي تكبر يومًا بعد يوم.

                                </h5>
                                <h6 style="text-align: right;color: blue;padding: 19px;/* background: skyblue; */font-size: 29px;font-family: fantasy;font-weight: 800;letter-spacing: 0.01rem;">منتجات :</h6>
                                <div style="text-align: right;">
                                    <a href="#" class="badge badge-dark badge-pill mylink">احذية</a>
                                    <a href="#" class="badge badge-dark badge-pill mylink">ملابس</a>
                                    <a href="#" class="badge badge-dark badge-pill mylink">لانجري</a>
                                    <a href="#" class="badge badge-dark badge-pill mylink">ادوات منزل</a>
                                    <a href="#" class="badge badge-dark badge-pill mylink">ملابس اطفال</a>
                                </div>

                                <hr>
                                <span class="badge badge-primary" style="font-size: 20px;"><i class="fa fa-user"></i> 900 متابع</span>
                                <span class="badge badge-success" style="font-size: 20px;"><i class="fa fa-cog"></i> 1000 اوردر</span>
                                <span class="badge badge-danger" style="font-size: 20px;"><i class="fa fa-eye"></i> 245 منتج</span>
                            </div>
                            <div class="col-md-12" style="display: none">
                                <h5 class="mt-2"><span class="fa fa-clock-o ion-clock float-right"></span> Recent Activity</h5>
                                <table class="table table-sm table-hover table-striped">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <strong>Abby</strong> joined ACME Project Team in <strong>`Collaboration`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Gary</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Kensington</strong> deleted MyBoard3 in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>John</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Skell</strong> deleted his post Look at Why this is.. in <strong>`Discussions`</strong>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                    <div class="tab-pane" id="messages">
                        <div class="container">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label form-control-label" style="text-align: center">رقم الهاتف </label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" placeholder="ادخل رقم الهاتف الخاص بالاوردر">
                                </div>
                                <div class="col-lg-2">
                                    <button style="width: 100%;" class="btn btn-primary">تاكيد</button>
                                </div>
                            </div>
                            <div class="col-lg-12">    
                                <table class="table table-bordered" style="border-collapse:collapse; text-align: center">
                                    <thead>
                                    <tr>
                                        <th>الاسم</th>
                                        <th>العنوان</th>
                                        <th>رقم التليفون</th>
                                        <th> الحالة</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
                                        <th>محمد احمد</th>
                                        <th>العباسية الظاهر</th>
                                        <th> 01013917487</th>
                                        <th> تم الشحن</th>

                                    </tr>
                                    </tbody><tbody class="accordian-body collapse p-3 hiddenRow" id="demo1">
                                    <tr style="background: aliceblue;">
                                        <th>المنتج</th>
                                        <th>السعر</th>
                                        <th>الكمية</th>

                                    </tr>

                                    <tr style="background: white">
                                        <td>شوز</td>
                                        <td>250 ج.م</td>
                                        <td>2</td>
                                    </tr>

                                    <tr style="background: white">
                                        <td>شوز</td>
                                        <td>250 ج.م</td>
                                        <td>2</td>
                                    </tr>
                                   </tbody>
                                    <tbody>
                                    <tr data-toggle="collapse" data-target="#demo2" class="accordion-toggle">
                                        <th>محمد احمد</th>
                                        <th>العباسية الظاهر</th>
                                        <th> 01013917487</th>
                                        <th> تم التاكيد</th>

                                    </tr>
                                    </tbody><tbody class="accordian-body collapse p-3 hiddenRow" id="demo2">
                                    <tr style="background: white">
                                        <th>المنتج</th>
                                        <th>السعر</th>
                                        <th>الكمية</th>
                                    </tr>

                                    <tr style="background: white">
                                        <td>شوز</td>
                                        <td>250 ج.م</td>
                                        <td>2</td>
                                    </tr>

                                    <tr style="background: white">
                                        <td>شوز</td>
                                        <td>250 ج.م</td>
                                        <td>2</td>
                                    </tr>
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="edit">
                        <form role="form" method="post" action="{{route("online_orders.store")}}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" style="text-align: center">الاسم بالكامل </label>
                                <div class="col-lg-9">
                                    <input name="customer_name" class="form-control" type="text" placeholder="ادخل الاسم">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" style="text-align: center">العنوان</label>
                                <div class="col-lg-9">
                                    <input name="customer_address" class="form-control" type="text" placeholder="ادخل العنوان كاملا">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" style="text-align: center">رقم التليفون</label>
                                <div class="col-lg-9">
                                    <input name="customer_phone" class="form-control"  placeholder="رقم موبايل او اكثر للتواصل">
                                </div>
                            </div>
                            <div class="card shopping-cart">
                                <div class="card-header bg-dark text-light">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                       عربة التسوق
                                    <a href="" class="btn btn-outline-info btn-sm pull-right"> اكمل التسوق</a>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="card-body">
                                        <!-- PRODUCT -->
                                       
                                        
                                        <hr>
                                        <!-- END PRODUCT -->
                                      
                                  
                                </div>
                                <div class="card-footer">
                                    <div class="pull-right" style="margin: 10px">
                                        <div class="pull-right" style="margin: 5px">
                                            اجمالي : <b>50.00€</b>
                                            <input name="total_price" value="" class="total_price d-none">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-9">
                                            <input type="reset" class="btn btn-danger" value="الغاء">
                                            <input type="submit" class="btn btn-primary" value="تاكيد">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                       
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="shop-page-wrapper shop-page-padding ptb-100">
        <div class="container-fluid" style="direction: rtl;">
            <div class="row">
                <div class="col-lg-3" style=" display: none; background: #f9f9f9; padding: 29px; text-align: right; border: 1px solid; border-radius: 1.34rem">
                    <div class="shop-sidebar mr-50" style="">
                        <div class="sidebar-widget mb-50">
                            <h3 class="sidebar-title">ابحث غن منتج</h3>
                            <div class="sidebar-search">
                                <form action="#">
                                    <input style="padding: 13px;width: 83%;" placeholder="Search Products..." type="text">
                                    <button><i class="ti-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-40" style="display: none">
                            <h3 class="sidebar-title">Filter by Price</h3>
                            <div class="price_filter">
                                <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 0%;"></span><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 100%;"></span><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div></div>
                                <div class="price_slider_amount">
                                    <div class="label-input">
                                        <label>price : </label>
                                        <input type="text" id="amount" name="price" placeholder="Add Your Price">
                                    </div>
                                    <button type="button">Filter</button>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-45" style="display: none">
                            <h3 class="sidebar-title">Categories</h3>
                            <div class="sidebar-categories">
                                <ul>
                                    <li><a href="#">Accessories <span>4</span></a></li>
                                    <li><a href="#">Book <span>9</span></a></li>
                                    <li><a href="#">Clothing <span>5</span> </a></li>
                                    <li><a href="#">Homelife <span>3</span></a></li>
                                    <li><a href="#">Kids &amp; Baby <span>4</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget sidebar-overflow mb-45">
                            <h3 class="sidebar-title">color</h3>
                            <div class="product-color">
                                <ul>
                                    <li class="red">b</li>
                                    <li class="pink">p</li>
                                    <li class="blue">b</li>
                                    <li class="sky">b</li>
                                    <li class="green">y</li>
                                    <li class="purple">g</li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-40">
                            <h3 class="sidebar-title">size</h3>
                            <div class="product-size">
                                <ul>
                                    <li><a href="#">xl</a></li>
                                    <li><a href="#">m</a></li>
                                    <li><a href="#">l</a></li>
                                    <li><a href="#">ml</a></li>
                                    <li><a href="#">lm</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-40" style="display: none">
                            <h3 class="sidebar-title">tag</h3>
                            <div class="product-tags">
                                <ul>
                                    <li><a href="#">Clothing</a></li>
                                    <li><a href="#">Bag</a></li>
                                    <li><a href="#">Women</a></li>
                                    <li><a href="#">Tie</a></li>
                                    <li><a href="#">Women</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-50" style="display: none">
                            <h3 class="sidebar-title">Top rated products</h3>
                            <div class="sidebar-top-rated-all">
                                <div class="sidebar-top-rated mb-30">
                                    <div class="single-top-rated">
                                        <div class="top-rated-img">
                                            <a href="#"><img src="assets/img/product/sidebar-product/1.jpg" alt=""></a>
                                        </div>
                                        <div class="top-rated-text">
                                            <h4><a href="#">Flying Drone</a></h4>
                                            <div class="top-rated-rating">
                                                <ul>
                                                    <li><i class="pe-7s-star"></i></li>
                                                    <li><i class="pe-7s-star"></i></li>
                                                    <li><i class="pe-7s-star"></i></li>
                                                    <li><i class="pe-7s-star"></i></li>
                                                    <li><i class="pe-7s-star"></i></li>
                                                </ul>
                                            </div>
                                            <span>$140.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="sidebar-top-rated mb-30">
                                    <div class="single-top-rated">
                                        <div class="top-rated-img">
                                            <a href="#"><img src="assets/img/product/sidebar-product/2.jpg" alt=""></a>
                                        </div>
                                        <div class="top-rated-text">
                                            <h4><a href="#">Flying Drone</a></h4>
                                            <div class="top-rated-rating">
                                                <ul>
                                                    <li><i class="pe-7s-star"></i></li>
                                                    <li><i class="pe-7s-star"></i></li>
                                                    <li><i class="pe-7s-star"></i></li>
                                                    <li><i class="pe-7s-star"></i></li>
                                                    <li><i class="pe-7s-star"></i></li>
                                                </ul>
                                            </div>
                                            <span>$140.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="sidebar-top-rated mb-30">
                                    <div class="single-top-rated">
                                        <div class="top-rated-img">
                                            <a href="#"><img src="assets/img/product/sidebar-product/3.jpg" alt=""></a>
                                        </div>
                                        <div class="top-rated-text">
                                            <h4><a href="#">Flying Drone</a></h4>
                                            <div class="top-rated-rating">
                                                <ul>
                                                    <li><i class="pe-7s-star"></i></li>
                                                    <li><i class="pe-7s-star"></i></li>
                                                    <li><i class="pe-7s-star"></i></li>
                                                    <li><i class="pe-7s-star"></i></li>
                                                    <li><i class="pe-7s-star"></i></li>
                                                </ul>
                                            </div>
                                            <span>$140.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="sidebar-top-rated mb-30">
                                    <div class="single-top-rated">
                                        <div class="top-rated-img">
                                            <a href="#"><img src="assets/img/product/sidebar-product/4.jpg" alt=""></a>
                                        </div>
                                        <div class="top-rated-text">
                                            <h4><a href="#">Flying Drone</a></h4>
                                            <div class="top-rated-rating">
                                                <ul>
                                                    <li><i class="pe-7s-star"></i></li>
                                                    <li><i class="pe-7s-star"></i></li>
                                                    <li><i class="pe-7s-star"></i></li>
                                                    <li><i class="pe-7s-star"></i></li>
                                                    <li><i class="pe-7s-star"></i></li>
                                                </ul>
                                            </div>
                                            <span>$140.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="shop-product-wrapper res-xl res-xl-btn">
                        <div class="shop-bar-area">
                            <div class="shop-bar pb-60" style="padding: 20px">
                                <div class="shop-found-selector" style="display: none">
                                    <div class="shop-found">
                                        <p><span>23</span> Product Found of <span>50</span></p>
                                    </div>
                                    <div class="shop-selector">
                                        <label>Sort By : </label>
                                        <select name="select">
                                            <option value="">Default</option>
                                            <option value="">A to Z</option>
                                            <option value=""> Z to A</option>
                                            <option value="">In stock</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="shop-filter-tab">
                                    <div class="shop-tab nav" role="tablist">
                                        <a class="active" href="#grid-sidebar1" data-toggle="tab" role="tab" aria-selected="false">
                                            <i class="ti-layout-grid4-alt"></i>
                                        </a>
                                        <a href="#grid-sidebar2" data-toggle="tab" role="tab" aria-selected="true">
                                            <i class="ti-menu"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="shop-product-content tab-content">
                                @foreach($pages as $index=>$items)
                                <div id="{{$index}}" class="tab-pane fade @if($index==1)active show @endif">
                                   
                                    <div class="row">
                                        @foreach($items as $item)
                                        <div class="col-lg-6 col-md-6 col-xl-3 col-sm-12" style="margin-top: 40px">
                                            <div class="product-wrapper mb-30" style="overflow: visible;">
                                                <div class="product-img">
                                                    <div class="d-none description" > تيشريت بولو اصلي قطن 100% قابل للغسيل والمكوي والتطبيق </div>

                                                    <a href="#">
                                                        <img class="item_photo" src="{{asset("$item->id.jpg")}}" alt="assets/img/product/fashion-2/download2.jpg" alt="">
                                                        <img class="item_photo d-none" data-id="first_image" src="{{asset("$item->id.jpg")}}" alt="assets/img/product/fashion-2/download2.jpg" alt="" >
                                                        <img class="item_photo d-none" data-id="second_image" src="{{asset("$item->id.jpg")}}" alt="assets/img/product/fashion-2/download2.jpg" alt="">
                                                        <img class="item_photo d-none" data-id="third_image" src="{{asset("$item->id.jpg")}}" alt="assets/img/product/fashion-2/download2.jpg" alt="">
 
                                                    </a>
                                                    <div class="product-action">
                                                        <a class="animate-left" title="Wishlist" href="#">
                                                            <i class="pe-7s-like"></i>
                                                        </a>
                                                        <a class="animate-top" title="Add To Cart" href="#">
                                                            <i class="pe-7s-cart"></i>
                                                        </a>
                                                        <a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                                                            <i class="pe-7s-look"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-content" style="text-align: center">
                                                    <h4><a href="#" class="item_name">{{$item->name->name}}</a> </h4>
                                                    <span class="badge " ><s style="color: #e51c1c" class="price_before_discount">{{$item->buying_price}}</s></span>                                      

                                                    <span class="price_after_discount"> {{$item->selling_price}}  </span> <span>جنيه </span>
                                                    
                                                    <div>
                                                        <span style=" display:none; padding: 14px; font-size: 18px" class="badge badge-primary"><i class="fa fa-user"></i>الوان</span>
                                                        <span style="display: none; padding: 14px; font-size: 18px" class="badge badge-success"><i class="fa fa-user"></i> مقاسات</span>
                                                        <select class="selectpicker" data-style="btn-info">
                                                            <optgroup label="">
                                                                <option selected>الالوان و المقاسات</option>
                                                            </optgroup>
                                                            
                                                            @foreach($item->available_colors_and_sizes() as $color=>$sizes)
                                                            
                                                            <optgroup label="{{$color}}" >
                                                                <option disabled>
                                                                    @for($x=0; $x<sizeof($sizes);$x++)
                                                                     {{$sizes[$x]}}@if($x!=sizeof($sizes)-1 && $sizes[$x]!=null) - @endif
                                                                    @endfor

                                                                </option>

                                                            </optgroup>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="pagination-style mt-30 text-center" style="padding: 50px">
                        
                        <ul class="nav nav-tabs" role="tablist"  style="display: block">
                            <li class="av-item nav-link pages"><a href="#" class="nav-link pages"><i class="ti-angle-left"></i></a></li>
                            @for($i=0;$i<$no_of_pages;$i++)
                            <li class="nav-item nav-link pages"><a href="#" data-target="#{{$i+1}}" data-toggle="tab" class="nav-link pages" >{{$i+1}}</a></li>
                            

                            @endfor
        
                            <li class="nav-item nav-link pages"><a href="#" class="nav-link pages"><i class="ti-angle-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer-area" style="display: none">
        <div class="footer-top-area bg-img pt-105 pb-65" style="background-image: url(assets/img/bg/1.jpg)" data-overlay="9">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-3">
                        <div class="footer-widget mb-40">
                            <h3 class="footer-widget-title">Custom Service</h3>
                            <div class="footer-widget-content">
                                <ul>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="register.html">My Account</a></li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="register.html">Register</a></li>
                                    <li><a href="#">Support</a></li>
                                    <li><a href="#">Track</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-3">
                        <div class="footer-widget mb-40">
                            <h3 class="footer-widget-title">Categories</h3>
                            <div class="footer-widget-content">
                                <ul>
                                    <li><a href="shop.html">Dress</a></li>
                                    <li><a href="shop.html">Shoes</a></li>
                                    <li><a href="shop.html">Shirt</a></li>
                                    <li><a href="shop.html">Baby Product</a></li>
                                    <li><a href="shop.html">Mans Product</a></li>
                                    <li><a href="shop.html">Leather</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="footer-widget mb-40">
                            <h3 class="footer-widget-title">Contact</h3>
                            <div class="footer-newsletter">
                                <p>تيشريت بولو اصلي قطن 100% قابل للغسيل والمكوي والتطبيق</p>
                                <div id="mc_embed_signup" class="subscribe-form pr-40">
                                    <form action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="">
                                        <div id="mc_embed_signup_scroll" class="mc-form">
                                            <input type="email" value="" name="EMAIL" class="email" placeholder="Enter Your E-mail" required="">
                                            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                            <div class="mc-news" aria-hidden="true">
                                                <input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value="">
                                            </div>
                                            <div class="clear">
                                                <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="footer-contact">
                                    <p><span><i class="ti-location-pin"></i></span> 77 Seventh avenue USA 12555. </p>
                                    <p><span><i class=" ti-headphone-alt "></i></span> +88 (015) 609735 or +88 (012) 112266</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom black-bg ptb-20">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="copyright">
                            <p>
                                Copyright ©
                                <a href="https://hastech.company/">HasTech</a> 2018 . All Right Reserved.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="pe-7s-close" aria-hidden="true"></span>
        </button>
        <div class="modal-dialog modal-quickview-width" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="qwick-view-left">
                        <div class="quick-view-learg-img">
                            <div class="quick-view-tab-content tab-content">
                                <div class="tab-pane active show fade" id="modal1" role="tabpanel">
                                    <img  class="first_image large_modal_image" src="assets/img/quick-view/l1.jpg" alt="">
                                </div>
                                <div class="tab-pane fade" id="modal2" role="tabpanel">
                                    <img class="second_image large_modal_image" src="assets/img/quick-view/l2.jpg" alt="">
                                </div>
                                <div class="tab-pane fade" id="modal3" role="tabpanel">
                                    <img class="third_image large_modal_image" src="assets/img/quick-view/l3.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="quick-view-list nav" role="tablist">
                            <a class="active" href="#modal1" data-toggle="tab" role="tab">
                                <img class="modal_image first_image" src="assets/img/quick-view/s1.jpg" alt="">
                            </a>
                            <a href="#modal2" data-toggle="tab" role="tab">
                                <img class="modal_image second_image" src="assets/img/quick-view/s2.jpg" alt="">
                            </a>
                            <a href="#modal3" data-toggle="tab" role="tab">
                                <img class="modal_image third_image"  src="assets/img/quick-view/s3.jpg" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="qwick-view-right">
                        <div class="qwick-view-content">
                            <h3>Handcrafted Supper Mug</h3>
                            <div class="price" style="direction: rtl">
                                <s style="color: #e51c1c" class="old">$120.00  </s>
                               <span class="new"></span>
                               <span>جنيه</span> 

                            </div>
                            <div class="rating-number d-none">
                                <div class="quick-view-rating">
                                    <i class="pe-7s-star"></i>
                                    <i class="pe-7s-star"></i>
                                    <i class="pe-7s-star"></i>
                                    <i class="pe-7s-star"></i>
                                    <i class="pe-7s-star"></i>
                                </div>
                                <div class="quick-view-number ">
                                    <span>2 Ratting (S)</span>
                                </div>
                            </div>
                            <p class="modal_description" style="text-align: right">Lorem ipsum dolor sit amet, consectetur adip elit, sed do tempor incididun ut labore et dolore magna aliqua. Ut enim ad mi , quis nostrud veniam exercitation .</p>
                            <div class="quick-view-select">
                                <div class="select-option-part ">
                                    <label>Color*</label>
                                    <select class="select modal_color">
                                 
                                    </select>
                                </div>
                                <div class="select-option-part">
                                    <label>Size*</label>
                                    <select class="select modal_size">
                                    
                                    </select>
                                </div>
                            </div>
                            <div class="quickview-plus-minus">
                                <div class="cart-plus-minus" style="width: 39%; direction: rtl">
                                    <label>الكمية*</label>

                                    <input type="number" value="1" name="qtybutton" class="modal_quantity"  style=" width: 48%;text-align: center;">
                                </div>
                                <div class="quickview-btn-cart">
                                    <a class="btn-hover-black" href="#">add to cart</a>
                                </div>
                                <div class="quickview-btn-wishlist d-none">
                                    <a class="btn-hover" href="#"><i class="pe-7s-like"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <div class="modal fade" id="exampleCompare" tabindex="-1" role="dialog" aria-hidden="true">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="pe-7s-close" aria-hidden="true"></span>
        </button>
        <div class="modal-dialog modal-compare-width" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="#">
                        <div class="table-content compare-style table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>
                                        <a href="#">Remove <span>x</span></a>
                                        <img src="assets/img/cart/4.jpg" alt="">
                                        <p>Blush Sequin Top </p>
                                        <span>$75.99</span>
                                        <a class="compare-btn" href="#">Add to cart</a>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="compare-title"><h4>Description </h4></td>
                                    <td class="compare-dec compare-common">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has beenin the stand ard dummy text ever since the 1500s, when an unknown printer took a galley</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="compare-title"><h4>Sku </h4></td>
                                    <td class="product-none compare-common">
                                        <p>-</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="compare-title"><h4>Availability  </h4></td>
                                    <td class="compare-stock compare-common">
                                        <p>In stock</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="compare-title"><h4>Weight   </h4></td>
                                    <td class="compare-none compare-common">
                                        <p>-</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="compare-title"><h4>Dimensions   </h4></td>
                                    <td class="compare-stock compare-common">
                                        <p>N/A</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="compare-title"><h4>brand   </h4></td>
                                    <td class="compare-brand compare-common">
                                        <p>HasTech</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="compare-title"><h4>color   </h4></td>
                                    <td class="compare-color compare-common">
                                        <p>Grey, Light Yellow, Green, Blue, Purple, Black </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="compare-title"><h4>size    </h4></td>
                                    <td class="compare-size compare-common">
                                        <p>XS, S, M, L, XL, XXL </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="compare-title"></td>
                                    <td class="compare-price compare-common">
                                        <p>$75.99 </p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- all js here -->
<script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function() {
        //Fixing jQuery Click Events for the iPad
        var ua = navigator.userAgent,
            event = (ua.match(/iPad/i)) ? "touchstart" : "click";
        if ($('.table').length > 0) {
            $('.table .header').on(event, function() {
                $(this).toggleClass("active", "").nextUntil('.header').css('display', function(i, v) {
                    return this.style.display === 'table-row' ? 'none' : 'table-row';
                });
            });
        }
    })

      $(".animate-right").click(function(){
        $('.modal_color').empty();
        $('.modal_size').empty();

        var parent=$(this).parent().parent().parent();

         $(".qwick-view-content h3").text(parent.find(".item_name").text());
       //  $("#modal1 img").attr("src",parent.find(".item_photo:first").attr("src"))
         var images=$(this).parent().parent().find(".item_photo");
          

         images.each(function(){  
             var im=$(this).attr("src");
             $("."+$(this).attr("data-id")).attr("src",im);
        
        });
      
        parent.find(".selectpicker").find("optgroup").each(function(){
            var $colors=[];
            var $sizes=[];
           if($(this).prop("label")!="" ){ 
            $colors.push($(this).prop("label"));
            $(this).find("option").each(function() {
                var l=$(this).text().split("-");
                for(var i=0;i<l.length;i++){
                 $sizes.push(l[i].trim());

                }


            });

            $.each($colors, function (i, item) {
                $('.modal_color').append($('<option>', { 
                    value: item,
                    text : item 
                }));
            });

            $.each($sizes, function (i, item) {
                $('.modal_size').append($('<option>', { 
                    value: item,
                    text : item,
                    class :$colors[$colors.length-1] 

                }));
            });
            
           
        }
        

            
           // alert($(this).prop("label"));
        });

        
    

        $(".modal_description").text(parent.find(".description").text());
           
          $(".old").text(parent.find(".price_before_discount").text());

          $(".new").text(parent.find(".price_after_discount").text());

          $(".modal_size option").addClass("d-none");
          $("."+$(".modal_color").val()).removeClass("d-none");
          $(".modal_size").val($("."+$(".modal_color").val()).val());
      

      })
$(document).on("change",".modal_color",function(){
           
    $(".modal_size option").addClass("d-none");
    $("."+$(this).val()).removeClass("d-none");
    $(".modal_size").val($("."+$(this).val()).val());

})

$(".quickview-btn-cart").click(function(){

  var temp =$(".temp_product").clone();
  temp.removeClass("temp_product");
  temp.removeClass("d-none");
  temp.find(".img-responsive").attr("src",$(".first_image").attr("src"));
  temp.find(".product-name strong").text($(".qwick-view-content h3").text());
  temp.find(".name").val($(".qwick-view-content h3").text());

  temp.find("small").text($(".modal_description").text());
  temp.find(".color").val($(".modal_color").val());
  temp.find(".size").val($(".modal_size").val());
  var quantity=$(".modal_quantity").val();
  temp.find(".form_quantity").val(quantity);

  temp.find(".product_price").text($(".new").text()*quantity);
  temp.find(".product_price").attr("data-price",$(".new").text().trim());

  temp.find(".second_optgroup").attr("label",$(".modal_color").val());
  temp.find(".second_optgroup").find("option").text($(".modal_size").val());
  temp.find(".second_optgroup").find("option").attr("value",$(".modal_size").val());

  $(".card-body").append(temp);
  $(".close").click();
  temp.find('.cl').selectpicker('refresh');
  $("#make_order").click();
  //$('body').scrollTo('#edit'); // Scroll screen to target element







})

$(document).on("click",".delete",function(){
    $(this).parent().parent().parent().remove();
})
$(document).on("change",".form_quantity",function(){
    
     var parent=$(this).parent().parent().parent();
     var price= parent.find(".product_price").attr("data-price");
     parent.find(".product_price").text($(this).val()*price);

});


      

</script>


</body>
</html>
