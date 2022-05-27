<input id="currency" value="{{\Illuminate\Support\Facades\Auth::user()->currency}}" style="display: none">

<nav class="navbar navbar-expand-lg navbar-light bg-light"   >
    <div class="custom-menu" >
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
        </button>
    </div>
    <nav aria-label="breadcrumb" style="margin-top: 10px">
        <ol class="breadcrumb" style="  background: none; font-size: 21px;">
            @yield('content')
        </ol>
    </nav>

    <div class="collapse navbar-collapse" id="navbarSupportedContent"  >
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!-- Single button -->
                        <div class="btn-group pull-right top-head-dropdown">

                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link  my_icons" href="#" id=""  style="color: white;"  >
                                    <i class="far fa-bell fa-2x" ></i>
                                </a> <span class="caret"></span>

                            <ul class="dropdown-menu dropdown-menu-left" style="width: 322px;background: #f7f7f7;">
                                @foreach(\Illuminate\Support\Facades\Auth::user()->alerts as $alert)
                                    <li>
                                        <a href="#" class="top-text-block">
                                            <div class="top-text-heading">      <p style="font-size: 16px" dir="ltr" data-id="{{$alert->id}}">  لقد اوشك المنتج علي النفاذ  {{$alert->item->name->name. " - ".$alert->item->name->code}}</p></div>

                                        </a>
                                    </li>
                                @endforeach

                                    @foreach(\Illuminate\Support\Facades\Auth::user()->unavailabel_alert as $alert)
                                        <li>
                                            <a href="#" class="top-text-block">
                                                <div class="top-text-heading">  <p style="font-size: 16px">لقد تم توافر المنتج {{\App\Name::find($alert->name_id)->name}} مقاس {{$alert->size}}  المطلوب في الفاتورة {{$alert->order_id}}</p></div>

                                            </a>
                                        </li>

                                    @endforeach






                            </ul>
                        </div>
                    </div>
                </div>



            </li>
            <li class="nav-item dropdown">
                <a style="color: white;"  class="nav-link  my_icons" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user fa-2x"></i>
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="width: 200px !important; padding: 0px">
                    <a class="dropdown-item" href="" style="font-size:21px;border: 1px solid lightgray;" >  مرحبا       {{\Illuminate\Support\Facades\Auth::user()->name}}       </a>

                    <a class="dropdown-item" href="{{route("logout")}}" style="font-size:21px; border: 1px solid lightgray;">   تسجيل خروج   </a>

                </div>
            </li>

        </ul>

    </div>


</nav>
