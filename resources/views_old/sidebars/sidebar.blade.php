<style>ul::-webkit-scrollbar {
        display: none;
    }</style>
<nav id="sidebar" class="" style="width: 18%"  dir="rtl" >

    <div class="p-4 pt-5">

        <div class="user-info">
            <div class="user-img-container">
                <img style="width: 91%" src="{{asset("imges/mo2.jpg")}}" alt="user">
                <span></span>
            </div>
        </div>
        <ul class="list-unstyled components mb-5">
            <li class="active">
                <a href="{{route("home")}}" ><span>الصفحة الرئيسية</span>   <i class="fas fa-home fa-2x side_bar_icons"></i></a>
            </li>
            <li class="">
                <a href="#orders_menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed"><span >الاوردرات </span> <i class="fas fa-hand-holding-usd fa-2x side_bar_icons"></i></a>
                <ul class="list-unstyled collapse " id="orders_menu" style="">
                    <li>
                        @if(\Illuminate\Support\Facades\Auth::user()->canDo("orders.create"))
                        <a style="font-weight: 800;font-size: 20px;" href="{{route("orders.create")}}" ><span>اوردر جديد</span></a>
                        @endif
                    </li>
                    <li>
                        @if(\Illuminate\Support\Facades\Auth::user()->canDo("orders.index"))
                        <a style="font-weight: 800;font-size: 20px;" href="{{route("orders.index")}}" >عرض الاوردرات</a>
                        @endif
                    </li>
                    <li>
                        @if(\Illuminate\Support\Facades\Auth::user()->canDo("orders_table"))
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route("orders_table")}}">  جدول الاوردرات </a></li>
                        @endif
                    </li>



                </ul>
            </li>
            <li class="">
                <a href="#export_menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed"><span >المشتريات </span><i class="fas fa-money-bill-wave fa-2x side_bar_icons"></i></a>
                <ul class="list-unstyled collapse " id="export_menu" style="">
                    <li>
                        @if(\Illuminate\Support\Facades\Auth::user()->canDo("exports.create"))

                        <a style="font-weight: 800;font-size: 20px;"  href="{{route("exports.create")}}" ><span>فاتورة شراء</span></a>
                        @endif
                    </li>
                    <li>
                        @if(\Illuminate\Support\Facades\Auth::user()->canDo("exports.index"))

                        <a style="font-weight: 800;font-size: 20px;" href="{{route("exports.index")}}" >عرض المشتريات</a>
                        @endif
                    </li>

                </ul>
            </li>
            <li class="">
                <a href="#exporter_menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed"><span >الموردين </span> <i class="fas fa-industry fa-2x side_bar_icons "></i></a>
                <ul class="list-unstyled collapse " id="exporter_menu" style="">
                    <li>
                        @if(\Illuminate\Support\Facades\Auth::user()->canDo("paymentsview"))
                        <a style="font-weight: 800;font-size: 20px;"  href="{{route("paymentsview")}}" ><span>حسابات موردين</span></a>
                        @endif
                    </li>
                    <li>
                        @if(\Illuminate\Support\Facades\Auth::user()->canDo("exporters.index"))
                        <a style="font-weight: 800;font-size: 20px;"  href="{{route("exporters.index")}}" >عرض الموردين</a>
                        @endif
                    </li>

                </ul>
            </li>
            <li class="">
                <a href="#items_menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed"><span >المخزن </span><i class="fas fa-coins fa-2x side_bar_icons"></i></a>
                <ul class="list-unstyled collapse " id="items_menu" style="">
                    <li>
                        @if(\Illuminate\Support\Facades\Auth::user()->canDo("items.index"))
                        <a style="font-weight: 800;font-size: 20px;" href="{{route("items.index")}}" ><span>عرض المنتجات</span></a>
                        @endif
                    </li>
                    <li>
                        @if(\Illuminate\Support\Facades\Auth::user()->canDo("restoreds.index"))
                        <a style="font-weight: 800;font-size: 20px;" href="{{route("restoreds.index")}}" >عرض المرتجعات</a>
                        @endif
                    </li>
                    <li>
                        @if(\Illuminate\Support\Facades\Auth::user()->canDo("expireds.index"))
                        <a style="font-weight: 800;font-size: 20px;" href="{{route("expireds.index")}}" >عرض الاهلاك</a>
                        @endif
                    </li>

                </ul>
            </li>
            <li class="">
                @if(\Illuminate\Support\Facades\Auth::user()->canDo("customers.index"))
                <a href="{{route("customers.index")}}">العملاء<i class="fas fa-users fa-2x side_bar_icons"></i></a>
                @endif
            </li>

            <li class="">
                @if(\Illuminate\Support\Facades\Auth::user()->canDo("ships.index"))
                <a href="{{route("ships.index")}}">شركات الشحن <i class="fas fa-truck fa-2x side_bar_icons"></i></a>
                @endif
            </li>
            <li class="">
                @if(\Illuminate\Support\Facades\Auth::user()->canDo("setting"))
                <a href="{{route("setting")}}">الاعدادات <i class="fas fa-cog fa-2x side_bar_icons"></i></a>
                @endif
            </li>
            <li class="">
                @if(\Illuminate\Support\Facades\Auth::user()->canDo("caches.index"))
                <a href="{{route("caches.index")}}">الخزنة <i class="fas fa-wallet fa-2x side_bar_icons"></i></a>
                @endif
            </li>
            <li>
                @if(\Illuminate\Support\Facades\Auth::user()->canDo("most_paying_customers"))
                <a href="{{route("deliveryman.index")}}" ><i class="fas fa-truck-loading fa-2x side_bar_icons"></i>مناديب</a>
                @endif
            </li>
            <li>
                @if(\Illuminate\Support\Facades\Auth::user()->canDo("most_paying_customers"))
                <a href="{{route("most_paying_customers")}}" ><i class="fas fa-chart-line fa-2x side_bar_icons"></i>تقارير</a>
                @endif
            </li>

        </ul>
        <h2 style="margin-left: 80px; font-family: none"> اتصل بنا </h2>
        <h3 style="margin-left: 15px;">201122391144+ <i class="fas fa-phone-alt"></i></h3>
        <h4 style="">sales@queen-store.net</h4>



    </div>
</nav>
