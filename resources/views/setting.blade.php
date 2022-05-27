
<!doctype html>
<html lang="en">
<head>
    <title>اعدادات</title>
    <meta name="csrf-token" content="{{csrf_token()}}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset("fontawesome-free-5.11.2-web/css/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" href="{{asset("css/semantic.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/dataTables.semanticui.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/bootstrap.css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

    <style>

        body{
            background: #f7f7f7;
            font-size: 20px;



        }
        
         .modal-body .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn){
            width:80%;
        }
      
        
        .row .btn-light{
            height: 40px;
        }
        #example tr:hover .hovered {
            background-color: #ffff99;
        }
        a{
            text-align: center;
        }
        .side_bar_icons{
            float: right;
        }
        /*span{
            margin-left: 7px;
        }
        .dropdown-toggle::after{
            margin-right: 10px;
        }*/
        
        input{
            border: 1px solid lightgrey;
            border-radius: 6px;
            padding: 4px;
            text-align: center;
            direction: rtl;
            font-weight: 600;

        }
        button{

            font-weight: 500;
            font-size: 20px;
            direction:rtl;

        }
        button:not(.close):hover{
            background-color: powderblue;
        }

        .headers{
            margin-right: -6px;
            border-color: none;
            background-color: white;


        }


        .clicked{
            background:powderblue;

        }
        .none{
            display:none;
        }
        .block{
            direction: ltr;
        }

        tr:hover {
            background-color: #ffff99;
        }


        .dataTables_wrapper:not(#users_wrapper) {
            display: none;
        }

        ul{
            text-align:right;
        }
        .dropdown-menu{
            text-align:right;
        }
        .error {
          background-color: #fce4e4;
          border: 1px solid #fcc2c3;
          padding: 20px 30px;
        }
        .error-text{
            text-align:center;
        }
        
        .filter-option-inner-inner{
            text-align:right;
        }
        



    </style>



</head>
<body>
<input style="display: none" value="{{route("get_user_permission","")}}" id="get_perm">
<input style="display: none" value="{{route("users.store")}}" id="users_store">
<input style="display: none" value="{{route("districts.store")}}" id="districts_store">
<input style="display: none" value="{{route("names.store","")}}" id="items_store">
<input style="display: none" value="" id="form_link">
<input id="tag" value="{{$tag}}" style="display: none">
<div class="d-none fa_icons">
  <div class="items_tag_button_icon"><i class="fas fa-boxes fa-2x " style="padding-right: 10px"></i> <span>اضافة صنف </span></div>  
  <div class="districts_tag_button_icon"><i class="fas fa-map-marked-alt fa-2x " style="padding-right: 10px"></i> <span>اضافة منطقة شحن </span></div>  
  <div class="stores_tag_button_icon"><i class="fas fa-store fa-2x " style="padding-right: 10px"></i> <span>اضافة مخزن </span></div>  

  <div class="users_tag_button_icon">   <i class="fas fa-user fa-2x " style="padding-right: 10px"></i> <span>اضافة مستخدم </span> </div>  

  
</div>
<div class="hidden_district form-group row" style="width: 100%; display: none" id="hidden_district">
    <label class="sr-only" >Username</label>
    <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
            <div class="input-group-text" style="font-weight: 700">المنطقة</div>
        </div>
         <input  name="districts[]" type="text" class="form-control"  placeholder="ادخل منطقة اخري" data-alertmessage="من فضلك ادخل اسم المنطقة"> 
         <span aria-hidden="true" style="color:red" class="remove_extra_district">&times;</span>


    </div>
</div>

<div class="wrapper d-flex align-items-stretch" dir="rtl">
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--============================================-->
        <!--start side menu component-->
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
            <li class="breadcrumb-item" aria-current="page"><a href="{{route("setting")}}"> اعدادات </a></li>

    @endsection
    @include("sidebars.navbar")
    <!---end of navbar !-->

        <div class="exports_cases" style="width: 90%; display: inline-flex;padding: 30px" >
            <div>
                <button id='users_tag_button' class="headers modal_tag" data-link="{{route("users.store")}}" data-table="users" style="border-top-right-radius: 22px;border-bottom-right-radius: 22px; height: 50px;width: 225px; color: steelblue; direction:ltr;">مستخدمين<i style="margin-left: 6px;" class="fas fa-user fa-2x"></i></button>
                <button id='districts_tag_button' class="headers modal_tag" data-link="{{route("districts.store")}}" data-table="districts" style=" height: 50px;width: 225px;  color: crimson; direction:ltr; /*border-top-left-radius: 6px;border-bottom-left-radius: 6px;border-top-right-radius: 6px;border-bottom-right-radius: 6px;*/">مناطق شحن  <i class="fas fa-map-marked-alt fa-2x" style="margin-left: 6px;"></i></button>
                <button id='stores_tag_button' class="headers modal_tag" data-link="{{route("stores.store")}}" data-table="stores" style="height: 50px;width: 225px; color: #41adad; direction:ltr; /*border-top-left-radius: 6px;border-bottom-left-radius: 6px;border-top-right-radius: 6px;  border-bottom-right-radius: 6px;  */"> مخازن  <i class="fas fa-store fa-2x" style="margin-left: 6px;"></i></button>

                <button id='items_tag_button' class="headers modal_tag" data-link="{{route("items.store")}}" data-table="items" style="border-top-left-radius: 22px;border-bottom-left-radius: 22px;height: 50px;width: 225px; color: forestgreen; direction:ltr;">اصناف<i style="margin-left: 6px;" class="fas fa-boxes fa-2x"></i></button></div>

        </div>
        <div>
                 @if($errors->any())
                            <div class="error">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="error-text">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                 @endif
        </div>
        <table id="users" class="ui celled table" style="text-align: center" dir="rtl"   >
            <thead >
            <tr >
                <th style="background: #5C71A3; color: white;" >المستخدم</th>
               
                <th style="background: #5C71A3; color: white;" >رقم الهاتف</th>
                <th style="background: #5C71A3; color: white;">الصلاحيات </th>
                <th style="background: #5C71A3; color: white;">كلمة السر</th>
                <th style="background: #5C71A3; color: white;">حفظ</th>
                <th style="background: #5C71A3; color: white;">حذف</th>

            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)

                <tr style="font-weight: 500">


                <td class="name" style="border-left: 1px solid rgba(34,36,38,.1);">
                    <div class="d-none"> {{$user->name}}</div>

                    <input style="" required form="user_form-{{$user->id}}" name="name"  value="{{$user->name}}" data-alertmessage="" >
                    
                </td>
                

                <td class="name" style="border-left: 1px solid rgba(34,36,38,.1);">
                    <div class="d-none"> {{$user->phone}}</div>

                    <input style="width:150px" required form="user_form-{{$user->id}}" type="number" name="phone" value="{{$user->phone}}">
                    
                </td>
                <td >
                    <select required  form="user_form-{{$user->id}}" name="permissions[]" id="perm-{{$user->id}}" name="" style="background: none; border: solid 1px #9ACD32;" class="selectpicker myselect" multiple title="حدد صلاحيات">


                    @foreach($permissions as $permission)
                            <option @if($user->hasPermission($permission)) sdsfsdf {{$user->name}}  selected @endif value="{{$permission->id}}" >{{$permission->label}}</option>
                        @endforeach
                    </select>
                </td>
                <td>

                    <input  style="width:150px" name="password" form="user_form-{{$user->id}}" value="" placeholder="اكتب كلمة السر الجديدة">

                </td>
                    <td>
                        <form  style="width:50px" method="post" id="user_form-{{$user->id}}"  action="{{route("roles.store",$user->id)}}">
                            @csrf

                            <button  class="i" type="submit"><i class="fas fa-check-circle"></i></button>
                        </form>

                    </td>

                    
                <td><form  method="post" action="{{route("users.destroy",$user->id)}}">
                    @csrf
                    @method("DELETE")
                    <button  ><i class="fas fa-trash-alt delete"></i></button>
                </form></td>
                </form>

            </tr>
            @endforeach


            </tbody>

        </table>


        <table id="districts" class="ui celled table" style="text-align: center" dir="rtl"   >
            <thead >
            <tr >
                <th style="background: #5C71A3; color: white;" >المنطقة</th>
                <th style="background: #5C71A3; color: white;">حفظ</th>
                <th style="background: #5C71A3; color: white;">حذف</th>

            </tr>
            </thead>
            <tbody>
            @foreach($districts as $Dist)

                <tr style="font-weight: 500">

                <form method="post" action="{{route("districts.update",$Dist->id)}}">
                    @csrf
                    @method("put")
                    <td class="name"> <div class="d-none">{{$Dist->name}}</div>  <input  name="name" value="{{$Dist->name}}"></td>

                    <td><button type="submit" class="submit d-none"></button>
                        <button type="button" class="submit_district_button"><i class="fas fa-check-circle"></i></button>
                    </td>

                </form>

                <td><form  method="post" action="{{route("districts.destroy",$Dist->id)}}">
                        @csrf
                        @method("DELETE")
                        <button  ><i class="fas fa-trash-alt delete"></i></button>
                    </form></td>

            </tr>
            @endforeach



            </tbody>

        </table>
        <table id="items" class="ui celled table" style="text-align: center" dir="rtl"   >
            <thead >
            <tr >
                <th style="background: #5C71A3; color: white;" >كود</th>
                <th style="background: #5C71A3; color: white;">صنف</th>
                <th style="background: #5C71A3; color: white;">لون</th>
                <th style="background: #5C71A3; color: white;">حفظ</th>
                <th style="background: #5C71A3; color: white;">حذف</th>

            </tr>
            </thead>
            <tbody>
            @foreach($names as $name)

                <tr style="font-weight: 500">
                    <form method="post" action="{{route("names.update",$name->id)}}">
                        @csrf
                        @method("put")
                <td><div class="d-none">{{$name->code}}</div> <input required name="code" value="{{$name->code}}" data-alertmessage="من فضلك ادخل كود الصنف"> </td>
                <td><div class="d-none">{{$name->name}}</div> <input required name="name" value="{{$name->name}}" data-alertmessage="من فضلك ادخل اسم الصنف">  </td>
                <td><div class="d-none">{{$name->color}}</div> <input required name="color" value="{{$name->color}}" data-alertmessage="من فضلك ادخل لون الصنف"> </td>



                <td>
                     <button type="submit" class="submit d-none"></button>
                     <button type="button" class="submit_item_button"><i class="fas fa-check-circle"></i></button>
                     
                </td>
                    </form>

                    <td class="co-1 ">
                    <form  method="post" action="{{route("names.destroy",$name->id)}}">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="delete_button"><i class="fas fa-trash-alt delete"></i></button>
                    </form>
                </td>


            </tr>
                @endforeach





            </tbody>

        </table>

        <table id="stores" class="ui celled table" style="text-align: center;" dir="rtl"   >
            <thead >
            <tr >
                

                <th style="background: #5C71A3; color: white;" >اسم</th>
                <th style="background: #5C71A3; color: white;" >عنوان</th>
                <th style="background: #5C71A3; color: white;" >رقم هاتف</th>

                <th style="background: #5C71A3; color: white;">حفظ</th>
                <th style="background: #5C71A3; color: white;">حذف</th>

            </tr>
            </thead>
            <tbody>
            @foreach($stores as $store)

                <tr style="font-weight: 500">

                <form method="post" action="{{route("stores.update",$store->id)}}">
                    @csrf
                    @method("put")

                    <td class="name"> <div class="none">{{$store->name}}</div>  <input required name="name" value="{{$store->name}}" data-alertmessage="من فضلك ادخل اسم المخزن"></td>
                    <td class="address"> <div class="none">{{$store->address}}</div>  <input required name="address" value="{{$store->address}}" data-alertmessage="من فضلك ادخل عنوان المخزن"></td>
                    <td class="phone"> <div class="none">{{$store->phone}}</div>  <input required name="phone" type="number" value="{{$store->phone}}" data-alertmessage="من فضلك ادخل رقم المخزن"></td>
                    <td>
                        <button type="submit" class="submit d-none"></button>
                        <button type="button" class="submit_store_button"><i class="fas fa-check-circle"></i></button>
                    </td>

                </form>

                <td><form  method="post" action="{{route("stores.destroy",$store->id)}}">
                        @csrf
                        @method("DELETE")
                        <button  ><i class="fas fa-trash-alt delete"></i></button>
                    </form></td>

            </tr>
            @endforeach



            </tbody>

        </table>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="    border: 4px solid gainsboro;  border-radius: 2.24rem;">
                    <div class="modal-header" dir="ltr">
                        <h5 class="modal-title" id="exampleModalLongTitle" style="margin-left: 37%;margin-top: 6%;direction:rtl;"> <i class="fas fa-user fa-2x" style="padding-right: 10px"></i> <span>اضافة مستخدم </span> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size: 30px">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="height: auto">
                        <form action="{{route("users.store")}}" method="post" class="user_form">
                            @csrf
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">الاسم</div>
                                    </div>
                                    <input name="name" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)" type="text" class="form-control users-all"  placeholder="" data-alertmessage="من فضلك ادخل اسم الحساب">
                                </div>
                            </div>
                             <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >phone</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">رقم الهاتف</div>
                                    </div>
                                    <input name="phone" type="number" class="form-control users-all"  placeholder="" data-alertmessage="من فضلك ادخل رقم الهاتف">
                                </div>
                            </div>
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">كلمة السر</div>
                                    </div>
                                    <input name="password" type="text" class="form-control users-all"  placeholder="" data-alertmessage="من فضلك ادخل كلمة سر صحيحة">
                                </div>
                            </div>
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">شركة شحن</div>
                                    </div>
                                    <select  name="ship_id" style="background: none; border: solid 1px #9ACD32;" class="selectpicker myselect users-all">
                                        <option value="0"> مستخدم عادي </option>

                                        @foreach($ships as $ship)
                                            <option value="{{$ship->id}}">{{$ship->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">الصلاحيات</div>
                                    </div>
                                    <select required  name="permissions[]" style="background: none; border: solid 1px #9ACD32;" class="selectpicker myselect permissions_picker users-all" data-var="permissions_picker" multiple title="حدد صلاحيات">
                                        @foreach($permissions as $permission)
                                            <option value="{{$permission->id}}"> </span>{{$permission->label}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="submit d-none"></button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
                                <button type="button"  class="btn btn-primary validate_and_submit add_user_button" >اضافة</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>


</div>
<div class="districts_tag_button" style="display: none">
    <form action="{{route("districts.store")}}" method="post" class="district_form">
        @csrf
        <div class="form-group row" style="width: 100%">
            <label class="sr-only" >Username</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-weight: 700">المنطقة</div>
                </div>
                <input name="districts[]" type="text" class="form-control inputs"  placeholder="" data-alertmessage="من فضلك ادخل اسم المنطقة">
            </div>
        </div>
        <div class="form-group row last" style="width: 100%">
            <button type="button" class="btn btn-success add_another_district" style="margin-right: 7px"><span>إضافة  منطقة اخري<i class="fas fa-plus"></i></span></button>
        </div>
  

        <div class="modal-footer">
            <button type="submit" class="submit d-none"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
            <button type="button" class="btn btn-primary validate_and_submit" >اضافة</button>
        </div>
    </form>
</div>
<div class="stores_tag_button" style="display: none">
    <form action="{{route("stores.store")}}" method="post" class="stores_form">
        @csrf
        <div class="form-group row" style="width: 100%">
            <label class="sr-only" >Username</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-weight: 700">اسم المخزن</div>
                </div>
                <input required name="name" type="text" class="form-control inputs"  placeholder="" data-alertmessage="من فضلك ادخل اسم المخزن">
            </div>
        </div>
        <div class="form-group row" style="width: 100%">
            <label class="sr-only" >Username</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-weight: 700"> عنوان</div>
                </div>
                <input required name="address" type="text" class="form-control inputs"  placeholder="" data-alertmessage="من فضلك ادخل عنوان المخزن">
            </div>
        </div>
        <div class="form-group row" style="width: 100%">
            <label class="sr-only" >Username</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-weight: 700"> رقم هاتف</div>
                </div>
                <input required name="phone" type="number" class="form-control inputs"  placeholder="" data-alertmessage="من فضلك ادخل رقم هاتف المخزن">
            </div>
        </div>
  

        <div class="modal-footer">
            <button type="submit" class="submit d-none"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
            <button type="button" class="btn btn-primary validate_and_submit" >اضافة</button>
        </div>
    </form>
</div>
<div class="items_tag_button" style="display: none">
    <form action="{{route("names.store")}}" method="post" class="items_form">
        @csrf
        <div class="form-group row" style="width: 100%">
            <label class="sr-only" >Username</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-weight: 700">الصنف</div>
                </div>
                <input required name="name" type="text" class="form-control inputs"  placeholder="" data-alertmessage="من فضلك ادخل اسم الصنف">
            </div>
        </div>
        <div class="form-group row" style="width: 100%">
            <label class="sr-only" >Username</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-weight: 700">اللون</div>
                </div>
                <input required name="color" type="text" class="form-control inputs"  placeholder="" data-alertmessage="من فضلك ادخل لون الصنف">
            </div>
        </div>
        <div class="form-group row" style="width: 100%">
            <label class="sr-only" >Username</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-weight: 700">الكود</div>
                </div>
                <input required name="code" type="text" class="form-control inputs"  placeholder="" data-alertmessage="من فضلك ادخل الكود">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="submit d-none"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
            <button type="button" class="btn btn-primary validate_and_submit" >اضافة</button>
        </div>
    </form>
</div>
<div class="users_tag_button" style="display: none">
    <form action="{{route("users.store")}}" method="post" class="user2_form">
        @csrf
        <div class="form-group row" style="width: 100%">
            <label class="sr-only" >Username</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-weight: 700">الاسم</div>
                </div>
                <input name="name" type="text" class="form-control inputs user_name"  placeholder="" data-alertmessage="من فضلك ادخل اسم الحساب">
            </div>
        </div>
             <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >phone</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">رقم الهاتف</div>
                                    </div>
                                    <input name="phone" type="number" class="form-control inputs"  placeholder="" data-alertmessage="من فضلك ادخل رقم الهاتف">
                                </div>
                            </div>
        <div class="form-group row" style="width: 100%">
            <label class="sr-only" >Username</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-weight: 700">كلمة السر</div>
                </div>
                <input name="password" type="text" class="form-control inputs"  placeholder="" data-alertmessage="من فضلك ادخل كلمة سر مناسبة">
            </div>
        </div>
                        <div class="form-group row" style="width: 100%">
                                <label class="sr-only" >Username</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style="font-weight: 700">شركة شحن</div>
                                    </div>
                                    <select  name="ship_id" style="background: none; border: solid 1px #9ACD32;" class="myselect2 inputs">
                                        <option value="0"> مستخدم عادي </option>

                                        @foreach($ships as $ship)
                                            <option value="{{$ship->id}}">{{$ship->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        <div class="form-group row" style="width: 100%">
            <label class="sr-only" >Username</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-weight: 700">الصلاحيات</div>
                </div>
                <select required name="permissions[]" style="background: none; border: solid 1px #9ACD32;" class="myselect2 permissions_picker2 inputs" data-var="permissions_picker2" multiple title="حدد صلاحيات">
                    @foreach($permissions as $permission)
                        <option value="{{$permission->id}}">{{$permission->label}} </span></option>
                    @endforeach
                </select>
            </div>
        </div>
            <div class="modal-footer">
                                <button type="submit" class="submit2 d-none"></button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" style="position: absolute;right: 11px">الغاء</button>
                                <button type="button"  class="btn btn-primary i validate_and_submit2 add_user_button" >اضافة</button>
                            </div>

    </form>
</div>
<div class="permissions_tag_button" style="display: none">
    <form>
        <div class="form-group row" style="width: 100%">
            <label class="sr-only" >Username</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-weight: 700">الصنف</div>
                </div>
                <input id="name" type="text" class="form-control"  placeholder="">
            </div>
        </div>
        <div class="form-group row" style="width: 100%">
            <label class="sr-only" >Username</label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text" style="font-weight: 700">اللون</div>
                </div>
                <select id="governorate" type="text" class="form-control"  placeholder="">
                    <option>asdasd</option>
                </select>
            </div>
        </div>

        <div class="form-group row last" style="width: 100%">
            <button class="btn btn-success" style="margin-right: 7px"><span>إضافة رقم اخر <i class="fas fa-plus"></i></span></button>
        </div>
    </form>
</div>






<script  src="{{asset("js/jquery-3.4.1.min.js")}}"></script>
<script src="{{asset("js/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("js/dataTables.semanticui.min.js")}}"></script>
<script src="{{asset("js/semantic.min.js")}}"></script>

<script src="{{asset("js/popper.js")}}"></script>

<script src="{{asset("js/bootstrap.min.js")}}"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>







<script >
    $(document).ready(function() {
      var table=  $('#users').DataTable({
            "paging":   true,

            aaSorting: [],
            "language": {
                "lengthMenu":  "",
                "zeroRecords": "لا يوجد نتيجة بحث مطابقة",
                "info":  "",
                "infoEmpty": "",
                "infoFiltered": "",
                "oPaginate": {
                    "sNext":    "التالي",
                    "sPrevious": "السابق"
                },
            }

        });
$(document).on("click",".paginate_button", function() {
    $('.selectpicker').selectpicker('refresh');

});



        $('#districts').DataTable({
            "paging":   true,

            aaSorting: [],
            "language": {
                "lengthMenu":  "",
                "zeroRecords": "لا يوجد نتيجة بحث مطابقة",
                "info":  "",
                "infoEmpty": "",
                "infoFiltered": "",
                "oPaginate": {
                    "sNext":    "التالي",
                    "sPrevious": "السابق"
                },
            }

        });
        $('#stores').DataTable({
            "paging":   true,

            aaSorting: [],
            "language": {
                "lengthMenu":  "",
                "zeroRecords": "لا يوجد نتيجة بحث مطابقة",
                "info":  "",
                "infoEmpty": "",
                "infoFiltered": "",
                "oPaginate": {
                    "sNext":    "التالي",
                    "sPrevious": "السابق"
                },
            }

        });
        $('#items').DataTable({
            "paging":   true,

            aaSorting: [],
            "language": {
                "lengthMenu":  "",
                "zeroRecords": "لا يوجد نتيجة بحث مطابقة",
                "info":  "",
                "infoEmpty": "",
                "infoFiltered": "",
                "oPaginate": {
                    "sNext":    "التالي",
                    "sPrevious": "السابق"
                },
            }

        });
        /*   var temp=$(".grid .row:last");
           var x=$("<button  style='position: absolute;right: 50%;background: #5C71A3;border: none;border-radius: 1.24rem;' class='btn btn-primary'>عرض المزيد</button>");

           temp.html(x);*/

        $("#users_wrapper").css("padding","43px");
        $("#users_wrapper").attr("dir","ltr");
        $("#users_filter").attr("dir","rtl");

        $("#items_filter").attr("dir","rtl");

        $("#items_wrapper").css("padding","43px");
        $("#items_wrapper").attr("dir","ltr");



        $("#districts_filter").attr("dir","rtl");
        $("#districts_wrapper").css("padding","43px");
        $("#districts_wrapper").attr("dir","ltr");

        $("#stores_filter").attr("dir","rtl");
        $("#stores_wrapper").css("padding","43px");
        $("#stores_wrapper").attr("dir","ltr");

        var x1=$("<button id='users_modal_button'    data-target='#exampleModalCenter' data-toggle='modal' class='btn btn-primary' style='border: none; background: #5C71A3;border-radius: 1.24rem;'><i class='fas fa-user-plus fa-2x' ><span style='padding: 14px;font-size: 17px'>اضافة مستخدم</span></i></button>");
        var x3=$("<button id='districts_modal_button'   data-target='#exampleModalCenter' data-toggle='modal' class='btn btn-primary' style='border: none; background: #5C71A3;border-radius: 1.24rem;'><i class='fas fa-map-marked-alt fa-2x' ><span style='padding: 14px;font-size: 17px'>اضافة منطقة شحن</span></i></button>");
        var x4=$("<button id='items_modal_button'   data-target='#exampleModalCenter' data-toggle='modal' class='btn btn-primary' style='border: none; background: #5C71A3;border-radius: 1.24rem;'><i class='fas fa-boxes fa-2x' ><span style='padding: 14px;font-size: 17px'>اضافة صنف</span></i></button>");
        var x5=$("<button id='stores_modal_button'   data-target='#exampleModalCenter' data-toggle='modal' class='btn btn-primary' style='border: none; background: #5C71A3;border-radius: 1.24rem;'><i class='fas fa-store fa-2x' ><span style='padding: 14px;font-size: 17px'>اضافة مخزن</span></i></button>");


        var arr=[x1,x3,x4,x5];
        var counter=0;
        $(".grid").each(function () {

            $(this).find(".row:first .eight:first").html(arr[counter]);
            counter++;
        })
        // $(".ui .row:first .eight:first ").html(x);
          var y=$("#tag").val();
          if(y!==""){
                $("#"+y).click();
 
          }
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
        $("#users_modal_button").click();
    });
    $('#exampleModalCenter').on('hidden.bs.modal', function () {
        $(".modal-body .myselect").removeClass("cl");
        $(".modal-body .myselect2").removeClass("cl2");

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


    $(".headers").click(function () {
        $(".dataTables_wrapper").css("display","none");
        $("#"+$(this).attr("data-table")).parent().parent().parent().parent().css("display","block");
        $(".modal_tag").removeClass("clicked");
        $(this).addClass("clicked");
    });
    $(document).on("click",".modal_tag",function () {
        var id=$(this).attr("id");
        var x=$("."+$(this).attr("id")).html();
        $(".modal-body").html(x);
        if(id==="users_tag_button"){
            $(".modal-body").find(".inputs").addClass("users-all2");
        }
        if(id==="districts_tag_button"){
            $(".modal-body").find(".inputs").addClass("districts-all");
        }
        if(id==="items_tag_button"){
            $(".modal-body").find(".inputs").addClass("items-all");
        }
        if(id==="stores_tag_button"){
            $(".modal-body").find(".inputs").addClass("stores-all");
        }


        $(".modal-title").html($(".fa_icons").find($("."+$(this).attr("id")+"_icon")).html());
 


    });
    $(document).on("click","#users_modal_button",function(){
        $(".modal-body .myselect").addClass("cl");
    
        $('.modal-body .cl').selectpicker();
        $(".modal-body .myselect2").addClass("cl2");
       $('.modal-body .cl2').selectpicker();
        
//       $('.modal-body .myselect').selectpicker('refresh');
    })
    $(document).on("change",".dropdown-item",function () {
        alert($(this).text());



    })
    $(".i").click(function () {
       /* $(".dropdown-item").each(function () {
            if($(this).hasClass("selected")){

               var val=$(this).text();
                $("#perm option").each(function (){
                    if($(this).text()===val){
                        $("#d").append("<input name='p' value='"+$(this).val()+"'>");
                    }
                })


            }
        })*/
       // $("#i").click();
    })



    $(document).on("click",".add_another_district",function () {
        var temp=$("#hidden_district").clone();
        temp.find("input").addClass("districts-all");
        temp.css("display","");
        temp.attr("id","");

        $(".modal-body form .last").before(temp);
    });
     var $bool=true;
 function null_input(input) {
     $("."+input).each(function () {

     if($(this).hasClass("user_name") &&!isNaN($(this).val())){
               
                $bool=false;
                alert("من فضلك ادخل اسم حساب مناسب");
                return false;
     }
    if($(this).hasClass("myselect") && $("."+$(this).attr("data-var")).find(".filter-option-inner-inner").html()=="حدد صلاحيات"){
           //      alert($(this).attr("data-var"));

           //alert(1);
                 $bool=false;
                 alert("من فضلك حدد الصلاحيات");
                 return false; 
     }; 
     
    


          if($(this).is("select") && !$(this).hasClass("myselect")){
             if($(this).find("option:selected").val()==0){
                 $(this).css("background-color","#fce4e4");
                 $bool=false;
                 alert("من فضلك اختر نوع الحساب ");

             }
             
          // alert(2);
                   return false;

         }

         if($(this).val().length===0 && !$(this).hasClass("myselect")){
              //alert($(this).val());
             $bool=false;
             var alert_message=$(this).attr("data-alertmessage");
             $(this).css("background-color","#fce4e4");
           //  $(this).attr("placeholder",alert_message);
                            alert(alert_message);

          //   $(this).val("");
          return false;


         }
     })

 }
 function null_input_2(input) {
    $("."+input).each(function () {
        if($(this).attr("name")==="name" &&!isNaN($(this).val())){
               
                $bool=false;
                alert("من فضلك ادخل اسم حساب مناسب");
                return false;
     }
        

   if($(this).hasClass("myselect2") && $("."+$(this).attr("data-var")).find(".filter-option-inner-inner").html()=="حدد صلاحيات"){
          //      alert($(this).attr("data-var"));

                $bool=false;
                 alert("من فضلك حدد الصلاحيات");
                return false; 
    }; 
    
   


         if($(this).is("select") && !$(this).hasClass("myselect2")){
            if($(this).find("option:selected").val()==0){
                $(this).css("background-color","#fce4e4");
                $bool=false;
                 alert("من فضلك اختر نوع الحساب ");
                  return false;


            }

        }

        if($(this).val().length===0 && !$(this).hasClass("myselect2")){
            
            $bool=false;
            var alert_message=$(this).attr("data-alertmessage");
            $(this).css("background-color","#fce4e4");
          //  $(this).attr("placeholder",alert_message);
            alert(alert_message);
                  return false;

           // $(this).val("");


        }
    })

}

     function validate(input_array,input_condition_array) {
 
     $bool=true;
     for(var i=0;i<input_array.length;i++){
        
         for(var j=0;j<input_condition_array[i].length;j++){

             if (input_condition_array[i][j]==="null_input"){null_input(input_array[i])}
             if (input_condition_array[i][j]==="null_input2"){null_input_2(input_array[i])}

           //  if (input_condition_array[i][j]==="wrong_length_input"){wrong_length_input(input_array[i])}
           //  if (input_condition_array[i][j]==="arabic_input"){arabic_input(input_array[i])}
              
            if($bool===false){return false;}
         }



     }
     return $bool;


 }

    function validate2(input_array,input_condition_array) {

     $bool=true;
     for(var i=0;i<input_array.length;i++){
        
         for(var j=0;j<input_condition_array[i].length;j++){

             if (input_condition_array[i][j]==="null_input"){null_input_2(input_array[i])}
             
           //  if (input_condition_array[i][j]==="wrong_length_input"){wrong_length_input(input_array[i])}
           //  if (input_condition_array[i][j]==="arabic_input"){arabic_input(input_array[i])}

            if($bool===false){return false;}
         }



     }
     return $bool;


 }
    
    
    
   //users validate & submit Form
   $(document).on("click",".user_form .validate_and_submit",function(){
       
    if( validate(["users-all"],[["null_input"]])){
       $(this).parent().find(".submit").click();
   }
   else{
      // alert("من فضلك راجع الخانات باللون الاحمر");
   }
       
   });
   
   $(document).on("click",".district_form .validate_and_submit",function(){
    if( validate(["districts-all"],[["null_input"]])){
       $(this).parent().find(".submit").click();
    }
   else{
      // alert("من فضلك راجع الخانات باللون الاحمر");
   }
       
   });
   
   
   
   $(document).on("click",".items_form .validate_and_submit",function(){
    if( validate(["items-all"],[["null_input"]])){
       $(this).parent().find(".submit").click();
    }
   else{
      // alert("من فضلك راجع الخانات باللون الاحمر");
   }
       
   });

   
   $(document).on("click",".user2_form .validate_and_submit2",function(){
    if(validate(["users-all2"],[["null_input2"]])){
       $(this).parent().find(".submit2").click();
   }
   else{
      
   }
       
   });
   
    $(document).on("click",".stores_form .validate_and_submit",function(){
       
    if( validate(["stores-all"],[["null_input"]])){
       $(this).parent().find(".submit").click();
   }
   else{
      // alert("من فضلك راجع الخانات باللون الاحمر");
   }
       
   });
   
   $(document).on("click",".remove_extra_district",function(){
      $(this).parent().remove(); 
   });

   $(document).on("click",".submit_district_button",function(){
       var inputs=$(this).parent().parent().find("input");
       var state=true;
       inputs.each(function(){
           if($(this).val().length===0){
               alert("من فضلك ادخل اسم المنطقة");
               state=false;
               return;
           }
       });
       if(state==true){
          $(this).parent().find(".submit").click();
       }
   });
   
   
   $(document).on("click",".submit_item_button",function(){
       var inputs=$(this).parent().parent().find("input");
       var state=true;
       inputs.each(function(){
           if($(this).val().length===0){
               alert($(this).attr("data-alertmessage"));
               state=false;
               return;
           }
       });
       if(state==true){
          $(this).parent().find(".submit").click();
       }
   });
   
   $(document).on("click",".submit_store_button",function(){
       var inputs=$(this).parent().parent().find("input");
       var state=true;
       inputs.each(function(){
           if($(this).val().length===0){
               alert($(this).attr("data-alertmessage"));
               state=false;
               return;
           }
       });
       if(state==true){
          $(this).parent().find(".submit").click();
       }
   });
   
   
      $(document).on("click",".paginate_button",function(event){
        $('html, body').animate({
             scrollTop: $("#example").offset().top
        }, 200);
    
});
</script>



</body>
</html>
