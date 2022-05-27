<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>طلب نسخة تجريبية</title>


<style type="text/css">
    input{
        font-size: 15px;
    }
    .form-style-1 {
        margin:10px auto;
        max-width: 400px;
        padding: 20px 12px 10px 20px;
        font: 20px "Lucida Sans Unicode", "Lucida Grande", sans-serif;
        direction: rtl;
    }
    .form-style-1 li {
        padding: 0;
        display: block;
        list-style: none;
        margin: 10px 0 0 0;
    }
    .form-style-1 label{
        margin:0 0 3px 0;
        padding:0px;
        display:block;
        font-weight: bold;
    }
    .form-style-1 input[type=text],
    .form-style-1 input[type=date],
    .form-style-1 input[type=datetime],
    .form-style-1 input[type=number],
    .form-style-1 input[type=search],
    .form-style-1 input[type=time],
    .form-style-1 input[type=url],
    .form-style-1 input[type=email],
    textarea,
    select{
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        border:1px solid #BEBEBE;
        padding: 7px;
        margin:0px;
        -webkit-transition: all 0.30s ease-in-out;
        -moz-transition: all 0.30s ease-in-out;
        -ms-transition: all 0.30s ease-in-out;
        -o-transition: all 0.30s ease-in-out;
        outline: none;
    }
    .form-style-1 input[type=text]:focus,
    .form-style-1 input[type=date]:focus,
    .form-style-1 input[type=datetime]:focus,
    .form-style-1 input[type=number]:focus,
    .form-style-1 input[type=search]:focus,
    .form-style-1 input[type=time]:focus,
    .form-style-1 input[type=url]:focus,
    .form-style-1 input[type=email]:focus,
    .form-style-1 textarea:focus,
    .form-style-1 select:focus{
        -moz-box-shadow: 0 0 8px #88D5E9;
        -webkit-box-shadow: 0 0 8px #88D5E9;
        box-shadow: 0 0 8px #88D5E9;
        border: 1px solid #88D5E9;
    }
    .form-style-1 .field-divided{
        width: 49%;
    }

    .form-style-1 .field-long{
        width: 100%;
    }
    .form-style-1 .field-select{
        width: 100%;
    }
    .form-style-1 .field-textarea{
        height: 100px;
    }
    .form-style-1 input[type=submit], .form-style-1 input[type=button]{
        background: #4B99AD;
        padding: 8px 15px 8px 15px;
        border: none;
        color: #fff;
    }
    .form-style-1 input[type=submit]:hover, .form-style-1 input[type=button]:hover{
        background: #4691A4;
        box-shadow:none;
        -moz-box-shadow:none;
        -webkit-box-shadow:none;
    }
    .form-style-1 .required{
        color:red;
    }
</style>
<body>
<form method="post" action="{{route("forms.store")}}">
    @csrf
    <ul class="form-style-1">
        <li><label>النشاط<span class="required">*</span></label><input type="text" name="activity" class="field-divided" placeholder="النشاط التجاري" /> </li>
        <li>
            <label>لينك صفحة الفيسبوك </label>
            <input  type="text" name="facebook" class="field-long" />
        </li>
        <li>
            <label>لينك صفحة الانستجرام </label>
            <input type="text" name="instagram" class="field-long" />
        </li>
        <li>
            <label>لينك صفحة التويتر </label>
            <input type="text" name="twitter" class="field-long" />
        </li>
        <li>
            <label>لينك حساب سوق.كوم </label>
            <input type="text" name="souq" class="field-long" />
        </li>
        <li>
            <label>المدينة</label>
            <input type="text" name="country" class="field-long" />
        </li>
        <li>
            <label>رقم الهاتف </label>
            <input type="text" name="phone" class="field-long" />
        </li>
        <li>
            <label>الباقة المطلوبة </label>
             <select name="range" style="font-size: 20px">
                 <option value="مجانية">مجانية</option>
                 <option value="متوسطة" >متوسطة</option>
                 <option value="كبيرة">كبيرة</option>
             </select>

        </li>
        <li>
            <input style="margin-right: 179px; width: 88px; font-size: 25px;" type="submit" value="تسجيل" />
        </li>
    </ul>
</form>
</body>
</html>
