<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orderatak - اوردراتك</title>
    <link rel="stylesheet" href="{{asset("css/login/style.css")}}">
    <link rel="preload" as="style" onload="this.rel='stylesheet'"
        href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="form">
                <div class="logo"><img src="{{asset("css/login/logo.jpg")}}" alt=""></div>
                <h1>تسجيل الدخول</h1>

                <form  method="post" action="{{route("login")}}">
                    @csrf
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="email" placeholder="اسم الحساب" />
                    </div>
               @if($errors->any())
                   <div style="color:red">يرجي مراجعة الحساب وكلمة المرور</div>
                @endif
                
  
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="كلمة السر" />
                    </div>
                    <button class="btn">دخول</button>
                </form>

            </div>
            <div class="contact">
                <p>في حالة مواجهة اي مشكلة يرجي التواصل معنا في اي وقت</p>
                <a href="tel:00201013917487"> </i> <strong> 00201013917487</strong> </a> |
                <a href="https://wa.me/+2001013917487" target="blank"><i class="fab fa-whatsapp w-icon"></i></a>
            </div>
        </div>

        <div class="form-txt">
            <div class="left">
                <div class="content">
                    <img src="{{asset("css/login/logo.jpg")}}" alt="">
                </div>
            </div>
        </div>
    </div>
</body>

</html>